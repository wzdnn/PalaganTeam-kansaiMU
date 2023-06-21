<?php

namespace PalaganTeam\MuhKansai\Controller;

use PalaganTeam\MuhKansai\App\View;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Repository\ActivityRepository;
use PalaganTeam\MuhKansai\Service\ActivityService;

class ActivityController{
    
    private ActivityService $activityService;
    public function __construct() {
        $actRepo = new ActivityRepository(Database::getConnection());
        $this->activityService = new ActivityService($actRepo);
    }

    /**
     * GET Page List Activity
     */
    public function listActivity(){

    }

    /**
     * GET Page Register Activity
     */
    public function registerActivity(){
        
    }

    /**
     * POST Register Activity
     */
    public function postRegisterActivity(){

    }

    /**
     * GET Page Update Activity
     */
    public function updateActivity(){

    }

    /**
     * POST Update Activity
     */
    public function postUpdateActivity(){

    }

    /**
     * POST Delete Activity
     */
    public function postDeleteActivity(){
        
    }
}