<?php

namespace PalaganTeam\MuhKansai\Repository;

use PalaganTeam\MuhKansai\Domain\User;
use PDO;

/**
 * Class User Repository
 * 
 * Semua fungsi yang berhubungan dengan query database
 * @requires PDO Database
 */
class UserRepository{
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    /**
     * Search Data by email
     * 
     * mencari data di database dengan email
     */
    public function findByEmail(string $email): ?User{
        $stmt = $this->connection->prepare('SELECT email, password FROM account WHERE email = ?');
        $stmt->execute([$email]);

        try{

            if($row = $stmt->fetch()){
                $user = new User;
                $user->userEmail = $row['email'];
                $user->userPassw = $row['password'];
                $user->userLevel = 'user-level';

                // return value Obj
                return $user;
            }else{
                return null;
            }

        } finally{
            $stmt->closeCursor();
        }
    }
}