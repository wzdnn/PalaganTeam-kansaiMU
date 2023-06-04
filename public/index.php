<?php

use PalaganTeam\MuhKansai\App\Router;
use PalaganTeam\MuhKansai\Controller\HomeController;

require_once(__DIR__ . "./../vendor/autoload.php");

// Home Page Index(default)
Router::add('GET', '/', HomeController::class, 'index');


// Run Route
Router::run();