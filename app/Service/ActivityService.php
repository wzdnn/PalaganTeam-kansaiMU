<?php

namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\App\DotEnv;
use PalaganTeam\MuhKansai\Config\Database;
use PalaganTeam\MuhKansai\Domain\Activity;
use PalaganTeam\MuhKansai\Model\Activity\ActivityCreateRequest;
use PalaganTeam\MuhKansai\Model\Activity\ActivityUpdateRequest;
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
        $this->validationCreateActivity($req);

        try{
            $activity = new Activity;
            $activity->namaActivity = $req->activityName;

            // get timezone
            DotEnv::getTimezoneArea();
            $activity->tanggalPembuatan = date('Y/m/d H:i:s');

            // detail activity
            $detail = [
                'tanggal' => date('d M Y', strtotime($req->activityTanggal)),
                'time-start' => date('H:i', strtotime($req->activityTimeStart)),
                'time-end' => date('H:i', strtotime($req->activityTimeEnd)),
                'desc' => $req->activityDeskripsi,
                'links' => $this->activityLinkLogic($req)
            ];
            $activity->detailActivity = serialize($detail);

            // history activity default
            $history = [
                'last-update' => 'Create',
                'history' => [
                    'Create by ' . 'nama orang, ' . date('d M Y H:i:s')
                ]
            ];
            $activity->historyActivity = serialize($history);

            $this->activityRepo->save($activity);
        } catch(\Exception $ex){
            throw $ex;
        }
    }

    /**
     * Validasi activity input form
     */
    private function validationCreateActivity(ActivityCreateRequest $req){
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

        if($req->activityJudulLink == null || $req->activityJudulLink == ''){
            $req->activityJudulLink = null;   
        }else{
            foreach ($req->activityJudulLink as $key => $value) {
                if($value == null || trim($value) == ''){
                    throw new \Exception('link title cannot be empty');
                }
            }
        }

        if($req->activityLink == null || $req->activityLink == ''){
            $req->activityLink = null;
        }else{
            foreach ($req->activityLink as $key => $value) {
                if($value == null || trim($value) == ''){
                    throw new \Exception('link cannot be empty');
                }
            }
        }

        if(isset($req->activityLink) || isset($req->activityJudulLink)){
            if(!isset($req->activityLink)){
                throw new \Exception('link title array cannot be empty');
            }
            if(!isset($req->activityJudulLink)){
                throw new \Exception('link array cannot be empty');
            }
            if(count($req->activityJudulLink) != count($req->activityLink)){
                throw new \Exception('one of the links is missing, please fill in');
            }
        }
    }

    /**
     * Activity Links Logic
     * 
     * Fungsi untuk menghandel links
     * @return  array
     */
    private function activityLinkLogic(ActivityCreateRequest $req): array{
        $this->validationCreateActivity($req);
        $links = [];
        if(isset($req->activityJudulLink)){
            for($i = 0; $i < count($req->activityJudulLink); $i++){
                $links[] = [
                    'judul' => $req->activityJudulLink,
                    'link' => $req->activityLink
                ];
            }
        }

        return $links;
    }

    /**
     * Update Activity
     * 
     * Service untuk menghandel update
     */
    public function updateActivity(ActivityUpdateRequest $req){
        $this->validationCreateActivity($req);
        $this->validationUpdateActivity($req);

        try{
            $activity = new Activity;
            // id target activity
            $activity->idActivity = $req->acitivityId;

            // name activity
            $activity->namaActivity = $req->activityName;

            // detail activity
            $detail = [
                'tanggal' => date('d M Y', strtotime($req->activityTanggal)),
                'time-start' => date('H:i', strtotime($req->activityTimeStart)),
                'time-end' => date('H:i', strtotime($req->activityTimeEnd)),
                'desc' => $req->activityDeskripsi,
                'links' => $this->activityLinkLogic($req)
            ];
            $activity->detailActivity = serialize($detail);

            Database::beginTransaction();
            // history
            $activityDB = $this->activityRepo->findById($req->acitivityId);
            $history = unserialize($activityDB->historyActivity);
            
            DotEnv::getTimezoneArea();
            $history['last-update'] = 'Update';
            array_push($history['history'], 'Update by ' . 'nama orang, ' . date('d M Y H:i:s'));
            $activity->historyActivity = serialize($history);
            
            $this->activityRepo->update($activity);
            Database::commitTransaction();
            return $activity;
        } catch(\Exception $ex){
            // Database::rollbackTransaction();
            throw $ex;
        }
    }

    /**
     * Update validation
     */
    private function validationUpdateActivity(ActivityUpdateRequest $req){
        if($req->acitivityId == null || $req->acitivityId == ''){
            throw new \Exception('id activity cannot be empty');
        }else if(is_string($req->acitivityId)){
            throw new \Exception('id activity cannot be type of string');
        }
    }
}