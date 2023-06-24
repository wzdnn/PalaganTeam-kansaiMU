<?php
namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\App\DotEnv;
use PalaganTeam\MuhKansai\Domain\News;
use PalaganTeam\MuhKansai\Model\News\NewsCreateRequest;
use PalaganTeam\MuhKansai\Model\News\NewsUpdateRequest;
use PalaganTeam\MuhKansai\Repository\NewsRepository;

class NewsService{
    private NewsRepository $newsRepo;

    public function __construct($newsRepo) {
        $this->newsRepo = $newsRepo;
    }

    /**
     * Create News
     */
    public function create(NewsCreateRequest $req){
        $this->createValidation($req);
        try{
            $news = new News;
            $news->newsTitle = $req->newsTitle;

            // image config
            $filename = md5(time() . $req->newsImage['name']) . "." . pathinfo($req->newsImage['name'], PATHINFO_EXTENSION);
            move_uploaded_file(
                $req->newsImage['tmp_name'], __DIR__ . DotEnv::getNewsPath() . $filename
            );

            // description
            $desc = [
                'image-thumbnail' => $filename,
                'news-desc' => $req->newsDescr
            ];
            $news->newsDetails = serialize($desc);

            DotEnv::getTimezoneArea();
            
            // history
            $history = [
                'last-update' => 'Create',
                'history' => [
                    'Create by ' . 'nama orang, ' . date('d M Y H:i:s')
                ]
            ];
            $news->newsHistory = serialize($history);

            $news->dateCreate = date('Y/m/d H:i:s');

            $this->newsRepo->save($news);
        } catch (\Exception $ex){
            throw $ex;
        }
    }

    /**
     * News Validation
     */
    private function createValidation(NewsCreateRequest $req){
        if($req->newsTitle == null || $req->newsTitle == ''){
            throw new \Exception('news title cannot be empty');
        }

        if($req->newsImage == null || $req->newsImage['size'] == 0){
            throw new \Exception('image cannot be empty');
        }else if($req->newsImage['size'] > 1500000){
            throw new \Exception('maximum size image is 1.5 mb');
        }

        if($req->newsDescr == null || $req->newsDescr == ''){
            throw new \Exception('news description cannot be empty');
        }
    }

    /**
     * Update news
     */
    public function update(NewsUpdateRequest $req){
        $this->updateValidation($req);
        try{
            $newsDB = $this->newsRepo->findById($req->idNews);
            if($newsDB != null){
                $news = new News;
                $news->newsId = $req->idNews;
                $news->newsTitle = $req->newsTitle;
                
                // Image config
                if($req->imageChange){
                    $filename = md5(time() . $req->newsImage['name']) . "." . pathinfo($req->newsImage['name'], PATHINFO_EXTENSION);
                    move_uploaded_file(
                        $req->newsImage['tmp_name'], __DIR__ . DotEnv::getNewsPath() . $filename
                    );

                    // delete old image
                    $details = unserialize($newsDB->newsDetails);
                    $oldThumbnail = $details['image-thumbnail'];
                    
                    // check old dir file
                    if(file_exists(__DIR__ . DotEnv::getNewsPath() . $oldThumbnail)){
                        unlink(__DIR__ . DotEnv::getNewsPath() . $oldThumbnail);
                    }
                }else{
                    $filename = $req->newsImage;
                }

                // description
                $desc = [
                    'image-thumbnail' => $filename,
                    'news-desc' => $req->newsDescr
                ];
                $news->newsDetails = serialize($desc);

                // history
                $history = unserialize($newsDB->newsHistory);

                DotEnv::getTimezoneArea();
                $history['last-update'] = 'Update';
                array_push($history['history'], 'Update by ' . 'nama orang, ' . date('d M Y H:i:s'));
                $news->newsHistory = serialize($history);

                $this->newsRepo->update($news);
            }else{
                throw new \Exception('id news not found');
            }
        } catch (\Exception $ex){
            throw $ex;
        }
    }

    /**
     * Update Validation
     */
    public function updateValidation(NewsUpdateRequest $req){
        if($req->idNews == null || $req->idNews == ''){
            throw new \Exception('id news cannot be empty');
        }else if(is_string($req->idNews)){
            throw new \Exception('id news cannot be type of string');
        }
        
        if($req->newsTitle == null || $req->newsTitle == ''){
            throw new \Exception('news title cannot be empty');
        }

        if($req->newsImage['size'] != 0){
            if($req->newsImage == null || $req->newsImage['size'] == 0){
                throw new \Exception('image cannot be empty');
            }else if($req->newsImage['size'] > 1500000){
                throw new \Exception('maximum size image is 1.5 mb');
            }

            $req->imageChange = true;
        }else{
            $news = $this->newsRepo->findById($req->idNews);
            if( $news != null){
                $details = unserialize($news->newsDetails);
                $thumbnail = $details['image-thumbnail'];

                $req->newsImage = $thumbnail;
                $req->imageChange = false;
            }else{
                throw new \Exception('id news not found');
            }
        }

        if($req->newsDescr == null || $req->newsDescr == ''){
            throw new \Exception('news description cannot be empty');
        }
    }
}