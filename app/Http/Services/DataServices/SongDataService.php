<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use Exception;

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

    /**
     * find all songs from song table
     * @throws Exception
     * @return array|NULL
     */
    public function findAllSongs()
    {
        try {
            //select all songs
            $stmt = $this->db->query("SELECT * FROM `songs`");
            $stmt->execute();
            $result = $stmt->rowCount();
            //check if i found anything, return them
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

