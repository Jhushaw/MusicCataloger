<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Services\BusinessServices;

use App\Http\Models\User;
use Exception;
use PDO;
use App\Http\Services\DataServices\UserDataService;

class UserBusinessService
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
     * calls userDataService to query returns appropriate result to controller (returns true or false)
     *
     * @param User $usder
     * @return Null|User
     */
    public function UserLogin(User $user){
            //create connection, (best to create connection in business for atomic database transactions)
            $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $uds= new UserDataService($db);
            
            $result= $uds->findUser($user);
            $db = null;
            
            return $result;
        
    }
    
    /**
     * calls userDataService to run insert statement (returns true or false)
     *
     * @param User $usr
     * @return boolean
     */
    public function UserRegister(User $usr){
        try {
            $db = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $uds= new UserDataService($db);
            //Check if user exists
            if($uds->findUserByName($usr->getUsername()) == false){
                $result= $uds->createUser($usr);
                $db = null;
                if ($result == true){
                    return 1;
                } else {
                    return 2;
                }
            }else{
                return -2;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
}

