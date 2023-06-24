<?php

namespace PalaganTeam\MuhKansai\Service;

use Exception;
use PalaganTeam\MuhKansai\App\DotEnv;
use PalaganTeam\MuhKansai\App\EmailSend;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Domain\User;
use PalaganTeam\MuhKansai\Model\User\UserLoginRequest;
use PalaganTeam\MuhKansai\Model\User\UserLoginResponse;
use PalaganTeam\MuhKansai\Model\User\UserPasswordResetRequest;
use PalaganTeam\MuhKansai\Model\User\UserRegisterRequest;
use PalaganTeam\MuhKansai\Repository\UserRepository;

/**
 * Class User Service
 * 
 * Semua bagian mengelola data diolah disini
 * @requires Class UserRepository
 */
class UserService{
    private UserRepository $userRepository;
    public function __construct($userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Login Service
     * 
     * Mengelola login page saat POST
     */
    public function login(UserLoginRequest $req): UserLoginResponse{
        // validation input
        $this->loginValidation($req);
        $user = $this->userRepository->findByEmail($req->email);

        // jika dicari null
        if($user == null){
            throw new Exception('Email or Password is wrong');
        }
        
        if($user->userData == 0){
            throw new Exception('Account not verified');
        }

        // check password
        if(password_verify($req->password, $user->userPassw)){
            $response = new UserLoginResponse;
            $response->username = $user->userEmail;
            $response->level = $user->userLevel;

            return $response;
        }else{
            throw new Exception('Email or Password is wrong');
        }

    }

    /**
     * Login Validation
     */
    private function loginValidation(UserLoginRequest $req): void{
        if($req->email == null || $req->email == ''){
            throw new Exception('Email is empty!');
        }
        
        if($req->password == null || $req->password == ''){
            throw new Exception('Password is empty!');
        }
    }

    /**
     * Register Service
     * 
     * Fungsi untuk mengelola data Register
     */
    public function register(UserRegisterRequest $req): void{
        $this->registerValidation($req);

        try{
            Database::beginTransaction();

            // check email
            if($this->userRepository->findByEmail($req->email) != null){
                throw new Exception('Email already created');
            }

            $user = new User;
            $user->userEmail = $req->email;
            $user->userName = $req->fullname;
            $user->userPassw = password_hash($req->password, PASSWORD_BCRYPT);
            
            // vkey generate
            $vkey = md5(time() . $req->email);

            DotEnv::getTimezoneArea();

            $this->userRepository->saveAccount($user, $vkey);
            $this->userRepository->saveAccountDetails($user, date('Y/m/d H:i:s'));

            // body massage html
            $body = $body = <<<HTML
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        *{
                            padding: 0;
                            margin: 0;
                        }
                        .container{
                            background-color: rgb(103, 199, 43);
                            text-align: center;
                            height: 50vh;
                            padding-top: 4rem;
                        }a{
                            padding: .5rem 1rem;
                            border: 1px solid rgb(72, 131, 184);
                            border-radius: .5rem;
                            text-decoration: none;
                            background: rgb(72, 131, 184);
                            color: #000;
                        }a:hover{
                            opacity: .9;
                            border-color: #fff;
                        }p{
                            margin-bottom: 2rem;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Email</h1>
                        <p>Click the link below to validate your account</p>
                        <a href="http://localhost/PalaganTeam-MuhKansai/test/index.html?key=$vkey">Validate Email</a>
                    </div>
                </body>
            </html>
        HTML;

            EmailSend::sendEmail($user->userEmail, 'account verification', $body);
            Database::commitTransaction();
        } catch(Exception $ex){
            Database::rollbackTransaction();
            throw $ex;
        }
    }

    /**
     * Register Validation
     */
    private function registerValidation(UserRegisterRequest $req): void{
        if($req->email == null || $req->email == ''){
            throw new Exception('Email cannot be empty!');
        }
        
        if($req->password == null || $req->password == ''){
            throw new Exception('Password cannot be empty!');
        }

        if($req->rePassword == null || $req->rePassword == ''){
            throw new Exception('RePassword cannot be empty!');
        }else if($req->password != $req->rePassword){
            throw new Exception('Passwords are not the same!');
        }
    }

    /**
     * Account Verified
     * 
     * Service untuk mengelola verified account
     */
    public function accountVerified(string $vkey){
        if($vkey == null || $vkey == ''){
            throw new Exception('V Key cannot be empty!');
        }

        try{
            if($this->userRepository->searchVkeyNotVerified($vkey)){
                $this->userRepository->verified($vkey);
                return 'Success Verified';
            }else{
                throw new Exception('Key not valid or account already verified');
            }
        } catch (Exception $ex){
            throw $ex;
        }
    }

    /**
     * Forget password
     * 
     * send email link untuk reset password jika email terdaftar
     */
    public function forgetPassword(string $email){
        if($email == null || $email == ''){
            throw new Exception('email cannot be empty');
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('email address not valid');
        }

        try{
            Database::beginTransaction();
            if($this->userRepository->findByEmail($email) != null){
                $vkey = md5(time() . $email);
                $this->userRepository->updateVkey($email, $vkey);

                // email send
                $subject = 'Reset Password';
                $body = <<<HTML
                <body>
                    <a href="#vkey=$vkey">Reset Password</a>
                </body>
                HTML;
                EmailSend::sendEmail($email, $subject, $body);

                Database::commitTransaction();
            }else{
                throw new Exception('email not found');
            }
        } catch (Exception $ex){
            Database::rollbackTransaction();
            throw $ex;
        }
    }

    /**
     * Reset Password
     * 
     * Update password dengan password yang baru
     */
    public function resetPassword(UserPasswordResetRequest $req, string $vkey): void{
        $this->resetPasswordValidation($req);
        try {
            if($email = $this->userRepository->searchVKey($vkey) != null){
                $user = new User;
                $user->userEmail = $email;
                $user->userPassw = password_hash($req->password, PASSWORD_BCRYPT);

                $this->userRepository->updatePassword($user);
            }else{
                throw new Exception('key not valid');
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Reset Password Validation
     */
    public function resetPasswordValidation(UserPasswordResetRequest $req){
        if($req->password == null || $req->password == ''){
            throw new Exception('Password cannot be empty');
        }

        if($req->repassword == null || $req->repassword == ''){
            throw new Exception('Re-Password cannot be empty');
        }else if($req->password != $req->repassword){
            throw new Exception('Passwords are not the same!');
        }
    }
}