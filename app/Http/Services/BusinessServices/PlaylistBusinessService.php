<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Services\BusinessServices;

use PDO;
use App\Http\Models\Playlist;
use App\Http\Services\DataServices\PlaylistDataService;

class PlaylistBusinessService
{
    //user data service
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
     * calls playlistDataService to query returns appropriate result to controller (returns true or false)
     *
     * @param Playlist $playlist
     * @return Null|bool
     */
    public function createPlaylist(Playlist $playlist){
            //create connection, (best to create connection in business for atomic database transactions)
            $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pds = new PlaylistDataService($db);
            
            $result = $pds->createPlaylist($playlist);
            $db = null;
            
            return $result;
        
    }
    
    public function deletePlaylist($id){
        //create connection, (best to create connection in business for atomic database transactions)
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $pds = new PlaylistDataService($db);
        
        $result = $pds->deletePlaylist($id);
        $db = null;
        
        return $result;
        
    }
    
    public function findAllPlaylists($userid){
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pbs = new PlaylistDataService($db);
        $result = $pbs->findAllPlaylists($userid);
        $db = null;
        return $result;
        
    }
    
    public function viewPlaylist($playlistID)
    {
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pbs = new PlaylistDataService($db);
        
        $result = $pds->viewPlaylist($playlistID);
        $db=null;
        
        return $result;
    }
}

