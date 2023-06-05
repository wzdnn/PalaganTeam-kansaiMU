<?php

namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\Model\User\UserLoginRequest;
use PalaganTeam\MuhKansai\Model\User\UserLoginResponse;
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
        if($req->password == $user->userPassw){
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
}