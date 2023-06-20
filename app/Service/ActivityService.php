<?php

namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\Model\Activity\ActivityCreateRequest;
use PalaganTeam\MuhKansai\Repository\ActivityRepository;

class ActivityService{
    
    private ActivityRepository $activityRepo;

    public function __construct($activityRepository) {
        $this->activityRepo = $activityRepository;
    }

    /**
     * Create Service Activity
     * 
     * Service logic untuk membuat activity
     */
    public function createActivity(ActivityCreateRequest $req){
        // detail activity
        $detail = [];

    }

    public function validationCreateActivity(ActivityCreateRequest $req){
        if($req->activityName == null || trim($req->activityName) == ''){
            throw new \Exception('activity cannot be empty');
        }
        
        if($req->activityTanggal == null || trim($req->activityTanggal) == ''){
            throw new \Exception('date cannot be empty');
        }

        if($req->activityTimeStart == null || trim($req->activityTimeStart) == ''){
            throw new \Exception('time start cannot be empty');
        }

        if($req->activityTimeEnd == null || trim($req->activityTimeEnd) == ''){
            throw new \Exception('time end cannot be empty');
        }

        if($req->activityDeskripsi == null || trim($req->activityDeskripsi) == ''){
            throw new \Exception('description cannot be empty');
        }

        if($req->activityLokasi == null || trim($req->activityLokasi) == ''){
            throw new \Exception('location cannot be empty');
        }

        if($req->activityJudulLink == null || $req->activityJudulLink == ''){
            $req->activityJudulLink = null;   
        }else{
            foreach ($req->activityJudulLink as $key => $value) {
                if($value == null || trim($value) == ''){
                    throw new \Exception('link title cannot be empty');
                }
            }
        }
    }
}