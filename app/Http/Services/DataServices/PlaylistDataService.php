<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use Exception;
use PDO;
use App\Http\Models\Playlist;

class PlaylistDataService
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
     * creates new entry in the Playlist table, returns true if one row is effected
     *
     * @param Playlist $playlist
     * @return boolean
     */
    public function createPlaylist(Playlist $playlist)
    {
        try {
            $name = $playlist->getName();
            $userid = $playlist->getUsers_ID();
            $stmt = $this->db->prepare("INSERT INTO `playlists` (`ID`, `NAME`, `users_ID`)
             VALUES (NULL, '$name', '$userid');");
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    public function deletePlaylist($id)
    {
        try {
            $stmt = $this->db->query("DELETE FROM `playlists` WHERE `id` = $id");
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e2) {
            throw $e2;
        }
    }

    public function findAllPlaylists($userid)
    {
        try {
            $stmt = $this->db->query("SELECT * FROM `playlists` WHERE `users_ID` = '$userid'");
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
    
    public function viewPlaylist($playlistId)
    {
        try{
                $stmt = $this->db->query(" SELECT s.NAME, s.ARTIST FROM songs s" +
                    " Inner join playlistsong p on s.ID = p.Songs_ID" +
                    " where p.playlists_ID = $playlistId");
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

