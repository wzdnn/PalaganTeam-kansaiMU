<?php

namespace PalaganTeam\MuhKansai\Controller;

use PalaganTeam\MuhKansai\App\View;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Repository\UserRepository;
use PalaganTeam\MuhKansai\Service\AccountService;

class HomeController{
    private AccountService $accountService;
    public function __construct() {
        $this->accountService = new AccountService();
    }
    /**
     * GET Web Home/Profile Page
     */
    public function index(){
        View::render('Home/index');
    }

    /**
     * GET Account Verified
     */
    public function verified(string $vkey){
        try{
            if(isset($_GET['email']) && isset($vkey)){
                if($this->accountService->verifiedAccount($vkey, $_GET['email'])){
                    View::render('Home/account-verified', [
                        'succses' => true,
                        'massage' => 'E-Mail Has Been Verified',
                        'email' => $_GET['email']
                    ]);
                }
            }else{
                View::redirect('/');
            }
        }catch(\Exception $ex){
            View::render('Home/account-verified', [
                'massage' => $ex->getMessage()
            ]);
        }
    }
}