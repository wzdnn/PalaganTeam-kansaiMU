<?php

use PalaganTeam\MuhKansai\App\Router;
use PalaganTeam\MuhKansai\Controller\HomeController;
use PalaganTeam\MuhKansai\Controller\UserController;

require_once(__DIR__ . "./../vendor/autoload.php");

// Home Page Index(default)
Router::add('GET', '/', HomeController::class, 'index');

Router::add('GET', '/login', UserController::class, 'login');
Router::add('POST', '/login', UserController::class, 'postLogin');


// Run Route
Router::run();