<?php

use PalaganTeam\MuhKansai\App\Router;
use PalaganTeam\MuhKansai\Controller\HomeController;
use PalaganTeam\MuhKansai\Controller\UserController;
use PalaganTeam\MuhKansai\Middleware\AlreadyLogin;
use PalaganTeam\MuhKansai\Middleware\MustLoginMiddleware;

require_once(__DIR__ . "./../vendor/autoload.php");
// error_reporting(E_ERROR | E_PARSE);

// Home Page Index(default)
Router::add('GET', '/', HomeController::class, 'index', [MustLoginMiddleware::class]);

Router::add('GET', '/login', UserController::class, 'login', [AlreadyLogin::class]);
Router::add('POST', '/login', UserController::class, 'postLogin', [AlreadyLogin::class]);

// Register Page
Router::add('GET', '/register', UserController::class, 'register');
Router::add('POST', '/register', UserController::class, 'postRegister');


// Account verified
Router::add('GET', '/account/verified/([a-zA-Z0-9]*)', HomeController::class, 'verified');

// Run Route
Router::run();