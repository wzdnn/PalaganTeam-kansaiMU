<?php

namespace PalaganTeam\MuhKansai\Config;

use PDO;

class Database{
    private static ?PDO $pdo = null;

    /**
     * Get Connection
     * 
     * Mendapatkan koneksi dengan Database menggunakan desain Singleton Database Func
     */
    public static function getConnection(): ?PDO{
        try{
            self::$pdo = new PDO(
                "mysql:host=localhost;dbname=muhkansai",
                "root",
                ""
            );

            // retun value
            return self::$pdo;
        } catch(\Exception $ex){
            // jika ada error
            die($ex->getMessage());
        }
    }

    /**
     * PDO Begin Transaction
     * 
     * Untuk memulai sebuah transaksi
     */
    public static function beginTransaction(){
        self::$pdo->beginTransaction();
    }

    /**
     * PDO Commit Transaksi
     * 
     * Untuk mengcommit transaksi yang berlangsung
     */
    public static function commitTransaction(){
        self::$pdo->commit();
    }

    /**
     * PDO Rollback Transaksi
     * 
     * Untuk Cancel Transaksi yang sedang berlangsung
     */
    public static function rollbackTransaction(){
        self::$pdo->rollBack();
    }
}