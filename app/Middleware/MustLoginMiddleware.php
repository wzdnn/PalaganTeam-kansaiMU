<?php

namespace PalaganTeam\MuhKansai\Middleware;

use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Repository\SessionRepository;
use PalaganTeam\MuhKansai\Service\SessionService;

class MustLoginMiddleware implements Middleware{
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();
        $sessionRepo = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepo);
    }
    public function before(): void{
        if($this->sessionService->current() == null){
            throw new \Exception('belum login');
        }
    }
}