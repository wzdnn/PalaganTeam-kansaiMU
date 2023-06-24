<?php

namespace PalaganTeam\MuhKansai\Controller;

use PalaganTeam\MuhKansai\App\View;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Model\User\UserLoginRequest;
use PalaganTeam\MuhKansai\Repository\SessionRepository;
use PalaganTeam\MuhKansai\Repository\UserRepository;
use PalaganTeam\MuhKansai\Service\SessionService;
use PalaganTeam\MuhKansai\Service\UserService;

class UserController{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();

        $userRepo = new UserRepository($connection);
        $this->userService = new UserService($userRepo);

        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepo);
    }

    /**
     * GET Login Page
     */
    public function login(){
        View::render('User/user-login');
    }

    /**
     * POST Login Page
     */
    public function postLogin(){
        $request = new UserLoginRequest;
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->remember = false;

        if(isset($_POST['remember'])){
            $request->remember = true;
        }

        try{
            $data = $this->userService->login($request);
            $this->sessionService->create($data->email, $data->level, $request->remember);
            View::render('Home/index');
        } catch(\Exception $ex){
            View::render('User/user-login', [
                "error" => $ex->getMessage()
            ]);
        }
    }

    /**
     * GET Register Page
     */
    public function register(){

    }

    /**
     * POST Register Page
     */
    public function postRegister(){

    }

    /**
     * GET Forget Password Page
     */
    public function forget(){

    }

    /**
     * POST Forget Password Page
     */
    public function postForget(){

    }

    /**
     * GET Reset Password Page
     */
    public function resetPassword(string $vkey){

    }

    /**
     * POST Reset Password Page
     */
    public function postResetPassword(string $vkey){

    }
}