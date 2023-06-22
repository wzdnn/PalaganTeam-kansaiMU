<?php

namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\App\DotEnv;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Domain\User;
use PalaganTeam\MuhKansai\Model\User\UserLoginRequest;
use PalaganTeam\MuhKansai\Model\User\UserLoginResponse;
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
            throw new \Exception('Email or Password is wrong');
        }
        
        // check password
        if(password_verify($req->password, $user->userPassw)){
            $response = new UserLoginResponse;
            $response->username = $user->userEmail;
            $response->level = $user->userLevel;

            return $response;
        }else{
            throw new \Exception('Email or Password is wrong');
        }

    }

    /**
     * Login Validation
     */
    private function loginValidation(UserLoginRequest $req): void{
        if($req->email == null || $req->email == ''){
            throw new \Exception('Email is empty!');
        }
        
        if($req->password == null || $req->password == ''){
            throw new \Exception('Password is empty!');
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
                throw new \Exception('Email sudah pernah dibuat');
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
            Database::commitTransaction();
        } catch(\Exception $ex){
            Database::rollbackTransaction();
            throw $ex;
        }
    }

    /**
     * Register Validation
     */
    private function registerValidation(UserRegisterRequest $req): void{
        if($req->email == null || $req->email == ''){
            throw new \Exception('Email cannot be empty!');
        }
        
        if($req->password == null || $req->password == ''){
            throw new \Exception('Password cannot be empty!');
        }

        if($req->rePassword == null || $req->rePassword == ''){
            throw new \Exception('RePassword cannot be empty!');
        }else if($req->password != $req->rePassword){
            throw new \Exception('Passwords are not the same!');
        }
    }
}