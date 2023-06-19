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
     * Save Data Account
     * 
     * Menyimpan data ke DB
     * @return User
     */
    public function save(User $user): User{
        $stmt = $this->connection->prepare('INSERT INTO account(email, password) VALUES(?, ?)');
        $stmt->execute([$user->userEmail, $user->userPassw]);

        return $user;
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


    /**
     * Get All Data
     * 
     * Ambil semua data account
     * @return array | null
     */
    public function getAll(): ?array{
        $stmt = $this->connection->prepare('SELECT * FROM account');
        $stmt->execute();

        try{
            if($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                foreach($row as $data){
                    $array[] = $data;
                }
    
                return $array;
            }else{
                return null;
            }
        } finally{
            $stmt->closeCursor();
        }
    }

    
    /**
     * Update User Data
     * 
     * Update data berdasarkan atrribute email
     * @return User
     */
    public function updatePassword(User $user): User{
        $stmt = $this->connection->prepare('UPDATE account SET password = ? WHERE email = ?');
        $stmt->execute([$user->userPassw, $user->userEmail]);

        return $user;
    }
}