<?php

namespace PalaganTeam\MuhKansai\Repository;

use PalaganTeam\MuhKansai\Domain\Session;
use PDO;
class SessionRepository{
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    /**
     * Save Session data
     */
    public function save(Session $session): Session{
        $stmt = $this->connection->prepare('INSERT INTO sessions(id, email, level) VALUES(?, ?, ?)');
        $stmt->execute([$session->idSession, $session->emailSessions, $session->levelAccses]);

        return $session;
    }

    /**
     * Search Session data
     * 
     * Mencari session berdasarkan ID session
     * @return Session | null
     */
    public function findById(string $idSession): ?Session{
        $stmt = $this->connection->prepare('SELECT * FROM sessions WHERE id = ?');
        $stmt->execute([$idSession]);

        try{
            if($row = $stmt->fetch()){
                $session = new Session;
                $session->emailSessions = $row['email'];
                $session->levelAccses = $row['level'];

                return $session;
            }else{
                return null;
            }
        } finally{
            $stmt->closeCursor();
        }
    }

    /**
     * Delete Session
     * 
     * Menghapus session berdasarkan Id
     */
    public function deleteById(string $id): bool{
        $stmt = $this->connection->prepare('DELETE FROM sessions WHERE id = ?');
        $stmt->execute([$id]);

        return true;
    }
}