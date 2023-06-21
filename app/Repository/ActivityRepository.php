<?php

namespace PalaganTeam\MuhKansai\Repository;

use PalaganTeam\MuhKansai\Domain\Activity;
use PDO;
class ActivityRepository{
    private PDO $connection;

    public function __construct(PDO $connection){
        $this->connection = $connection;
    }

    /**
     * Save Activity to DB
     * 
     * Menyimpan data Activity ke dalam DB
     * @return Activity
     */
    public function save(Activity $activity): Activity{
        $stmt = $this->connection->prepare('INSERT INTO activity(nama_activity, tanggal_pembuatan, detail_activity, history_activity) VALUES(?, ?, ?, ?)');
        $stmt->execute([$activity->namaActivity, $activity->tanggalPembuatan, $activity->detailActivity, $activity->historyActivity]);

        return $activity;
    }

    /**
     * Find Activity by ID
     * 
     * Mencari data activity berdasarkan ID
     * @return Activity
     */
    public function findById(int $idActivity): ?Activity{
        $stmt = $this->connection->prepare('SELECT * FROM activity WHERE id = ?');
        $stmt->execute([$idActivity]);

        try{
            if($row = $stmt->fetch()){
                $activity = new Activity;
                $activity->idActivity = $row['id'];
                $activity->namaActivity = $row['nama_activity'];
                $activity->tanggalPembuatan = $row['tanggal_pembuatan'];
                $activity->detailActivity = $row['detail_activity'];
                $activity->historyActivity = $row['history_activity'];

                return $activity;
            }else{
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    /**
     * Get All Activity Data
     * 
     * Ambil Semua activity yang ada di dalam database
     */
    public function getAllData(): array{
        $stmt = $this->connection->prepare('SELECT * FROM activity');
        $stmt->execute();

        try{
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($row as $data){
                $array[] = $data;
            }

            return $array;
        } finally{
            $stmt->closeCursor();
        }
    }
    
    /**
     * Update activity by id
     * 
     * Update data activity berdasarkan ID
     */
    public function update(Activity $activity): bool{
        $stmt = $this->connection->prepare('UPDATE activity SET nama_activity = ?, detail_activity = ?, history_activity = ? WHERE id = ?');

        return $stmt->execute([$activity->namaActivity, $activity->detailActivity, $activity->historyActivity, $activity->idActivity]);
    }

    /**
     * Delete activity by id
     * 
     * Hapus data activity bedasarkan ID
     */
    public function delete(int $id): bool{
        $stmt = $this->connection->prepare('DELETE FROM activity WHERE id = ?');
        
        return $stmt->execute([$id]);
    }
}