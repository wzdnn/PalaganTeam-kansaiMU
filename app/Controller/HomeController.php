<?php

namespace PalaganTeam\MuhKansai\Controller;

use PalaganTeam\MuhKansai\App\View;

class HomeController{
    /**
     * Web Home/Profile Page
     */
    public function index(){
        View::render('Home/index');
    }
}