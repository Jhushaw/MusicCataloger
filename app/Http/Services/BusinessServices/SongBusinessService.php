<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Services\BusinessServices;

use PDO;
use App\Http\Services\DataServices\SongDataService;

class SongBusinessService
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
     * request all songs from dao
     * @return NULL|array
     */
    public function findAllSongs(){
        $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sds = new SongDataService($db);
        $result = $sds->findAllSongs();
        $db = null;
        return $result;
        
    }
}

