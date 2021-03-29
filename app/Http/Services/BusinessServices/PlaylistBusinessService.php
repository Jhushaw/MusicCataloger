<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Services\BusinessServices;

use PDO;
use App\Http\Models\Playlist;
use App\Http\Services\DataServices\PlaylistDataService;
use App\Http\Services\Utility\MyLogger;
use App\Http\Models\User;
use App\Http\Models\Song;

class PlaylistBusinessService
{
    private $uds;
    private $servername;
    private $port;
    private $username;
    private $password;
    private $dbname;
    
    /**
     * Used for db connections
     */
    public function __construct()
    {
        $this->servername = config("database.connections.mysql.host");
        $this->port=config("database.connections.mysql.port");
        $this->username=config("database.connections.mysql.username");
        $this->password=config("database.connections.mysql.password");
        $this->dbname=config("database.connections.mysql.database");
    }
    
    /**
     * send playlist to data service (returns true or false)
     *
     * @param Playlist $playlist
     * @return Null|bool
     */
    public function createPlaylist(Playlist $playlist){
            MyLogger::info("Entering createPlaylist() in the playlist business service");
            //create connection
            $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pds = new PlaylistDataService($db);
            //get result
            $result = $pds->createPlaylist($playlist);
            $db = null;
            //return result
            MyLogger::info("Exiting createPlaylist() in the playlist business service");
            return $result;
        
    }
    /**
     * Send id down to delete the playlist in dao
     * @param Playlist $id
     * @return boolean
     */
    public function deletePlaylist($id){
        MyLogger::info("Entering deletePlaylist() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        //get result
        $result = $pds->deletePlaylist($id);
        $db = null;
        
        MyLogger::info("Exiting deletePlaylist() in the playlist business service");
        //return result
        return $result;
        
    }
    
    /**
     * sends playlist down to be edited in dao
     * @param Playlist $playlist
     * @return boolean
     */
    public function editPlaylist(Playlist $playlist){
        
        MyLogger::info("Entering editPlaylist() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        //get result
        $result = $pds->updatePlaylist($playlist);
        $db = null;
        
        MyLogger::info("Exiting editPlaylist() in the playlist business service");
        //return result
        return $result;
        
    }
    
    /**
     * find all playlist related to logged in user
     * @param User $userid
     * @return NULL|boolean
     */
    public function findAllPlaylists($userid){
        
        MyLogger::info("Entering findAllPlaylists() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pbs = new PlaylistDataService($db);
        //get result
        $result = $pbs->findAllPlaylists($userid);
        $db = null;
        
        MyLogger::info("Exiting findAllPlaylists() in the playlist business service");
        //return result
        return $result;
        
    }
    
    /**
     * view all songs inside a playlist based on id
     * @param Playlist $playlistID
     * @return NULL|boolean
     */
    public function viewPlaylist($playlistID)
    {
        MyLogger::info("Entering viewPlaylist() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        //get result
        $result = $pds->viewPlaylist($playlistID);
        $db=null;
        
        MyLogger::info("Exiting viewPlaylist() in the playlist business service");
        //return result
        return $result;
    }
    
    /**
     * sends playlist and song id down to dao to be added to playlistsong table
     * @param Playlist $playlistId
     * @param Song $songId
     * @return boolean
     */
    public function addToPlaylist($playlistId,$songId)
    {
        MyLogger::info("Entering addToPlaylist() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        //send ids to dao
        $results = $pds->addToPlaylist($playlistId, $songId);
        $db=null;
        
        MyLogger::info("Exiting addToPlaylist() in the playlist business service");
        //return boolean results
        return $results;
        
    }
    
    /**
     * send song id down to dao to be deleted from playlistsong table
     * @param Song $id
     * @return boolean
     */
    public function deleteSong($id,$playlistid){
        MyLogger::info("Entering deleteSong() in the playlist business service");
        //create connection
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        //get result
        $result = $pds->deleteSong($id,$playlistid);
        $db = null;
        
        MyLogger::info("Exiting deleteSong() in the playlist business service");
        //return result
        return $result;
        
    }
    
}

