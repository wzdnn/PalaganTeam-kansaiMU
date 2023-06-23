<?php
namespace PalaganTeam\MuhKansai\Service;

use PalaganTeam\MuhKansai\App\DotEnv;
use PalaganTeam\MuhKansai\Domain\News;
use PalaganTeam\MuhKansai\Model\News\NewsCreateRequest;
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
                $req->newsImage['tmp_name'], __DIR__ . '/../../public/images/news/' . $filename
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
    public function createValidation(NewsCreateRequest $req){
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
}