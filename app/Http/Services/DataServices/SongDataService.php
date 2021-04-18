<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use App\Http\Services\Utility\MyLogger;
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
        MyLogger::info("Entering fingAllSongs() in the Song Data Service");
        try {
            //select all songs
            $stmt = $this->db->query("SELECT * FROM `songs`");
            $stmt->execute();
            $result = $stmt->rowCount();
            //check if i found anything, return them
            if ($result != 0) {
                $userResults = $stmt->fetchAll();
                MyLogger::info("Songs successfully found, exiting findAllSongs()");
                return $userResults;
            } else {
                MyLogger::warning("No songs where found, exiting findAllSongs()");
                return null;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in SongDataService.findAllSongs");
            throw $e2;
        }
    }
}

