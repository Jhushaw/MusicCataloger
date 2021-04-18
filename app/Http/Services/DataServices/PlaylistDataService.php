<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use Exception;
use PDO;
use App\Http\Models\Playlist;
use App\Http\Models\User;
use App\Http\Models\Song;
use App\Http\Services\Utility\MyLogger;

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
        MyLogger::info("Entering createPlaylist() in the Playlist data service");
        try {
            // get required data to be inserted
            $name = $playlist->getName();
            $userid = $playlist->getUsers_ID();
            // insert data
            $stmt = $this->db->prepare("INSERT INTO `playlists` (`ID`, `NAME`, `users_ID`)
             VALUES (NULL, '$name', '$userid');");
            $stmt->execute();
            $result = $stmt->rowCount();
            // check rows affected
            if ($result == 1) {
                MyLogger::info("Playlist successfully created, exiting, createPlaylist()");
                return true;
            } else {
                return false;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.createPlaylist");
            throw $e2;
        }
    }

    /**
     * Deletes an entry in the playlist table, returns true if one row is effected
     *
     * @param Playlist $id
     * @throws Exception
     * @return boolean
     */
    public function deletePlaylist($id)
    {
        MyLogger::info("Entering deletePlaylist() in the Playlist data service");
        try {
            // delete playlist based on id
            $stmt = $this->db->query("DELETE FROM `playlists` WHERE `id` = $id");
            $result = $stmt->execute();
            // return bool if row was deleted
            MyLogger::info("Playlist successfully deleted, exiting, deletePlaylist()");
            return $result;
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.deletePlaylist");
            throw $e2;
        }
    }

    /**
     * updated a playlist entry
     *
     * @param Playlist $playlist
     * @throws Exception
     * @return boolean
     */
    public function updatePlaylist(Playlist $playlist)
    {
        MyLogger::info("Entering updatePlaylist() in the Playlist data service");
        try {
            // update playlist based on param playlist
            $stmt = $this->db->prepare("UPDATE playlists SET NAME = :name WHERE ID = :id");
            $id = $playlist->getId();
            $name = $playlist->getName();

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);

            $stmt->execute();
            // check rows affected
            $result = $stmt->rowCount();
            if ($result == 1) {
                MyLogger::info("Playlist successfully updated, exiting, updatePlaylist()");
                return true;
            } else {
                MyLogger::warning("Playlist not successfully updated, exiting, updatePlaylist()");
                return false;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.deleteSong");
            throw $e2;
        }
    }

    /**
     * Find all playlists for the logged in user
     *
     * @param User $userid
     * @throws Exception
     * @return array|NULL
     */
    public function findAllPlaylists($userid)
    {
        MyLogger::info("Entering findAllPlaylists() in the Playlist data service");
        try {
            // find all playlists based on userid
            $stmt = $this->db->query("SELECT * FROM `playlists` WHERE `users_ID` = '$userid'");
            $stmt->execute();
            $result = $stmt->rowCount();
            // check if you found any playlists
            if ($result != 0) {
                $userResults = $stmt->fetchAll();
                // return results
                MyLogger::info("Playlists found, exiting findAllPlaylists()");
                return $userResults;
            } else {
                MyLogger::warning("No Playlists found, exiting findAllPlaylists()");
                return null;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.findAllPlaylists");
            throw $e2;
        }
    }

    /**
     * finds all songs in related playlist you chose to view
     *
     * @param Playlist $playlistId
     * @throws Exception
     * @return array|NULL
     */
    public function viewPlaylist($playlistId)
    {
        MyLogger::info("Entering viewPlaylist() in the Playlist data service");
        try {
            $int = (int) $playlistId;
            $stmt = $this->db->query(" SELECT s.IMAGE, s.ID, s.NAME, s.ARTIST FROM songs s 
                    Inner join playlistsong p on s.ID = p.Songs_ID
                     where p.playlists_ID = $int");
            $stmt->execute();

            $result = $stmt->rowCount();
            if ($result != 0) {
                $userResults = $stmt->fetchAll();
                MyLogger::info("Playlist successfully retreived from the database, exitng viewPlaylist()");
                return $userResults;
            } else {
                MyLogger::warning("Zero playlist returned, exitng viewPlaylist()");
                return null;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.viewPlaylist");
            throw $e2;
        }
    }

    /**
     * inserts song and playlist id into playlistsong table (adds a song to a playlist)
     *
     * @param Playlist $playlistId
     * @param Song $songId
     * @throws Exception
     * @return boolean
     */
    public function addToPlaylist($playlistId, $songId)
    {
        MyLogger::info("Entering addToPlaylist() in the Playlist data service");
        try {
            // convert ids to ints
            $playlistID = (int) $playlistId;
            $songID = (int) $songId;
            // setup statement to insert ids into table
            $stmt = $this->db->prepare("INSERT INTO `playlistsong`(`playlists_ID`, `songs_ID`) VALUES ($playlistID,$songID)");
            $stmt->execute();
            $result = $stmt->rowCount();
            // check if a row was affected
            if ($result == 1) {
                MyLogger::info("Song successfully added, exixitng addToPlayist()");
                return true;
            } else {
                MyLogger::error("Song not successfully added, exixitng addToPlayist()");
                return false;
            }
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.addToPlaylist");
            throw $e2;
        }
    }

    /**
     * deletes a song from playlistsong table (remove song from a playlist)
     * @param Song $id, Playlist $playlistid
     * @throws Exception
     * @return boolean
     */
    public function deleteSong($id,$playlistid)
    {
        MyLogger::info("Entering deleteSong() in the Playlist data service");
        try {
            // delete song based on id
            $stmt = $this->db->query("DELETE FROM `playlistsong` WHERE `songs_ID` = $id AND `playlists_ID` = $playlistid LIMIT 1");
            $result = $stmt->execute();
            
            MyLogger::info("Song successfully deleted, exixitng deleteSong()");
            // return bool if row was deleted
            return $result;
        } catch (Exception $e2) {
            MyLogger::error("Global Exception error in PlaylistDataService.deleteSong");
            throw $e2;
        }
    }
}

