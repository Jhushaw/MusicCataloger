<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use Exception;
use PDO;

class SongDataService
{

    private $db;

    /**
     * configures db connection
     *
     * @param string $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function findAllSongs()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM `songs`");
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result != 0) {
                $userResults = $stmt->fetchAll();
                return $userResults;
            } else {
                return null;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
}

