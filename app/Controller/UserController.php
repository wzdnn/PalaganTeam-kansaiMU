<?php

namespace PalaganTeam\MuhKansai\Controller;

use PalaganTeam\MuhKansai\App\View;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Model\User\UserLoginRequest;
use PalaganTeam\MuhKansai\Repository\UserRepository;
use PalaganTeam\MuhKansai\Service\UserService;

class UserController{
    private UserService $userService;

    public function __construct() {
        $repo = new UserRepository(Database::getConnection());
        $this->userService = new UserService($repo);
    }

    /**
     * GET Login
     */
    public function login(){
        View::render('User/user-login');
    }

    /**
     * POST Login
     */
    public function postLogin(){
        $request = new UserLoginRequest;
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try{
            $this->userService->login($request);
            View::render('Home/index');
        } catch(\Exception $ex){
            View::render('User/user-login', [
                "error" => $ex->getMessage()
            ]);
        }
    }
}