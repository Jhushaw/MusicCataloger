<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use Exception;
use PDO;
use App\Http\Models\Playlist;
use App\Http\Models\User;

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
     * creates new entry in the playlist table, returns true if one row is effected
     *
     * @param Playlist $playlist
     * @return boolean
     */
    public function createPlaylist(Playlist $playlist)
    {
        try {
            //get required data to be inserted
            $name = $playlist->getName();
            $userid = $playlist->getUsers_ID();
            //insert data
            $stmt = $this->db->prepare("INSERT INTO `playlists` (`ID`, `NAME`, `users_ID`)
             VALUES (NULL, '$name', '$userid');");
            $stmt->execute();
            $result = $stmt->rowCount();
            //check rows affected
            if ($result == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    /**
     * Deletes an entry in the playlist table, returns true if one row is effected
     * @param Playlist $id
     * @throws Exception
     * @return boolean
     */
    public function deletePlaylist($id)
    {
        try {
            //delete playlist based on id
            $stmt = $this->db->query("DELETE FROM `playlists` WHERE `id` = $id");
            $result = $stmt->execute();
            //return bool if row was deleted
            return $result;
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    /**
     * updated a playlist entry
     * @param Playlist $playlist
     * @throws Exception
     * @return boolean
     */
    public function updatePlaylist(Playlist $playlist)
    {
        try {
            //update playlist based on param playlist
            $stmt = $this->db->prepare("UPDATE playlists SET NAME = :name WHERE ID = :id");
            $id = $playlist->getId();
            $name = $playlist->getName();
            
            $stmt->bindParam(':id', $id ,PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            
            $stmt->execute();
            //check rows affected
            $result = $stmt->rowCount();
            if ($result == 1){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }

    /**
     * Find all playlists for the logged in user
     * @param User $userid
     * @throws Exception
     * @return array|NULL
     */
    public function findAllPlaylists($userid)
    {
        try {
            //find all playlists based on userid 
            $stmt = $this->db->query("SELECT * FROM `playlists` WHERE `users_ID` = '$userid'");
            $stmt->execute();
            $result = $stmt->rowCount();
            //check if you found any playlists
            if ($result != 0) {
                $userResults = $stmt->fetchAll();
                //return results
                return $userResults;
            } else {
                return null;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    /**
     * finds all songs in related playlist you chose to view
     * @param Playlist $playlistId
     * @throws Exception
     * @return array|NULL
     */
    public function viewPlaylist($playlistId)
    {
        try{
            $int = (int)$playlistId;
                $stmt = $this->db->query(" SELECT s.ID, s.NAME, s.ARTIST FROM songs s 
                    Inner join playlistsong p on s.ID = p.Songs_ID
                     where p.playlists_ID = $int");
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

