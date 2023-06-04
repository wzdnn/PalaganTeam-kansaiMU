<?php

namespace PalaganTeam\MuhKansai\App;
class View{
    /**
     * Render Page File
     * 
     * Merender file target (.php) menjadi halaman
     */
    public static function render(string $targetView){
        define('ROOT', 'http://localhost:8080');

        // default folder /View
        require(__DIR__ . "./../View/" . $targetView . ".php");
    }
}