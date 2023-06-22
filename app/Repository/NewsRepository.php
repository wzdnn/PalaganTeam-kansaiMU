<?php

namespace PalaganTeam\MuhKansai\Repository;

use PalaganTeam\MuhKansai\Domain\News;
use PDO;
class NewsRepository{
    private PDO $connection;
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    /**
     * Save News to DB
     * 
     * simpan data news ke dalam database
     */
    public function save(News $news): News{
        $stmt = $this->connection->prepare('INSERT INTO news(news_title, news_details, news_history, tanggal_pembuatan) VALUES(?, ?, ?, ?)');
        $stmt->execute([$news->newsTitle, $news->newsDetails, $news->newsHistory, $news->dateCreate]);

        return $news;
    }

    /**
     * Search news by id
     * 
     * mencari data news bedasarkan ID news
     */
    public function findById(string $id): ?News{
        $stmt = $this->connection->prepare('SELECT * FROM news WHERE id = ?');
        $stmt->execute([$id]);

        try{
            if($row = $stmt->fetch()){
                $news = new News;
                $news->newsId = $row['id'];
                $news->newsTitle = $row['news_title'];
                $news->newsDetails = $row['news_details'];
                $news->newsHistory = $row['news_history'];
                $news->dateCreate = $row['tanggal_pembuatan'];

                return $news;
            }else{
                return null;
            }
        } finally{
            $stmt->closeCursor();
        }
    }

    /**
     * Get all news Data order by date DESC
     * 
     * ambil semua news berdasarkan tanggal secara DESC
     */
    public function getAllNewsDESC(): array | null{
        $stmt = $this->connection->prepare('SELECT * FROM news ORDER BY tanggal_pembuatan DESC');
        $stmt->execute();

        try{
            if($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                foreach($row as $data){
                    $array[] = $data;
                }
    
                return $array;
            }else{
                return null;
            }
        } finally{
            $stmt->closeCursor();
        }
    }
}