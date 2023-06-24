<?php

namespace PalaganTeam\MuhKansai\Middleware;
use PalaganTeam\MuhKansai\App\View;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Repository\SessionRepository;
use PalaganTeam\MuhKansai\Service\SessionService;
class AlreadyLogin implements Middleware{
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();
        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepo);
    }
    public function before(): void{
        if($this->sessionService->current() != null){
            // dashboard
            View::redirect('/');
        }
    }
}