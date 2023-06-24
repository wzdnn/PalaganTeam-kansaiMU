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
     * Menyimpan data ke tabel account
     * @return User
     */
    public function saveAccount(User $user, string $vkey): User{
        $stmt = $this->connection->prepare('INSERT INTO account(email, password, vkey, verified, access_level) VALUES(?, ?, ?, ?, ?)');
        $stmt->execute([$user->userEmail, $user->userPassw, $vkey, 0, 0]);

        return $user;
    }


    /**
     * Save Data Account Details
     * 
     * Menyimpan data ke tabel account details
     */
    public function saveAccountDetails(User $user, string $timeCreate): User{
        $stmt = $this->connection->prepare('INSERT INTO account_details(email, fullname, create_at) VALUES(?, ?, ?)');
        $stmt->execute([$user->userEmail, $user->userName, $timeCreate]);

        return $user;
    }
    

    /**
     * Search Data by email
     * 
     * mencari data di database dengan email
     */
    public function findByEmail(string $email): ?User{
        $stmt = $this->connection->prepare('SELECT email, password, verified, access_level FROM account WHERE email = ?');
        $stmt->execute([$email]);

        try{

            if($row = $stmt->fetch()){
                $user = new User;
                $user->userEmail = $row['email'];
                $user->userPassw = $row['password'];
                $user->userData  = $row['verified'];
                $user->userLevel = $row['access_level'];

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

    /**
     * Verified Account
     * 
     * Update data account untuk verifikasi
     */
    public function verified(string $vkey): bool{
        $stmt = $this->connection->prepare('UPDATE account SET verified = ? WHERE vkey = ?');
        $stmt->execute([1, $vkey]);

        return true;
    }

    /**
     * Search V-Key
     * 
     * Mencari V Key pada DB yang belum verified
     */
    public function searchVkeyNotVerified(string $vkey): bool | string{
        $stmt = $this->connection->prepare('SELECT vkey FROM account WHERE vkey = ? AND verified = ?');
        $stmt->execute([$vkey, 0]);

        try{
            if($row = $stmt->fetch()){
                return $row['vkey'];
            }else{
                return false;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    /**
     * Search V Key
     * 
     * Mencari V Key pada DB, retun berupa email
     * @return string 
     */
    public function searchVKey(string $vkey): ?string{
        $stmt = $this->connection->prepare('SELECT email FROM account WHERE vkey = ?');
        $stmt->execute([$vkey]);

        try{
            if($row = $stmt->fetch()){
                return $row['email'];
            }else{
                return null;
            }
        } finally{
            $stmt->closeCursor();
        }
    }

    /**
     * Update V key token By email
     * 
     * Membuat v key token baru berdasarkan email
     */
    public function updateVkey(string $email, string $vkey): bool{
        $stmt = $this->connection->prepare('UPDATE account SET vkey = ? WHERE email = ?');
        $stmt->execute([$vkey, $email]);

        return true;
    }
}