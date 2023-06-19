<?php

namespace PalaganTeam\MuhKansai\App;
class View{
    /**
     * Render Page File
     * 
     * Merender file target (.php) menjadi halaman
     */
    public static function render(string $targetView, ?array $response = []){
        define('ROOT', 'http://localhost:8080');

        // default folder /View
        require(__DIR__ . "./../View/" . $targetView . ".php");
    }

    /**
     * Redirect Page
     * 
     * Beralih kehalaman yang dituju yang sudah terdaftar pathnya
     */
    public static function redirect(string $pathUrl){
        header("location: " . $pathUrl . ".php");
        exit();
    }
}