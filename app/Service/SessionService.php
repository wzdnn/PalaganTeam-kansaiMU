<?php

namespace PalaganTeam\MuhKansai\Service;

use Exception;
use PalaganTeam\MuhKansai\Domain\Session;
use PalaganTeam\MuhKansai\Repository\SessionRepository;

class SessionService{

    public static string $COOKIE_NAME = "KANSAI-";
    private SessionRepository $sessionRepo;

    public function __construct($sessionRepository) {
        $this->sessionRepo = $sessionRepository;
    }

    /**
     * Create Session and Cookie
     * 
     * buat session di DB dan set cookie pada client
     */
    public function create(string $email, int $levelAccses, bool $mounth = false){
        $session = new Session;
        $session->idSession = md5(time() . uniqid());
        $session->emailSessions = $email;
        $session->levelAccses = $levelAccses;

        $this->sessionRepo->save($session);
        if($mounth){
            setcookie(self::$COOKIE_NAME, $session->idSession, time() + (60 * 60 * 24 * 30), "/");
        }else{
            setcookie(self::$COOKIE_NAME, $session->idSession, time() + (60 * 60 * 1), "/");
        }

        return $session;
    }

    /**
     * Destroy Sessions and cookie
     * 
     * hapus cookie dan setcookie to empty value
     */
    public function destroy(){
        $sessionIdGet = $_COOKIE[self::$COOKIE_NAME] ?? "";
        $this->sessionRepo->deleteById($sessionIdGet);

        setcookie(self::$COOKIE_NAME, "", 1, "/");
    }
}