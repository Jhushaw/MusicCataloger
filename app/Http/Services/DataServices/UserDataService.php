<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Services\DataServices;

use App\Http\Models\User;
use Exception;
use PDO;
use PDOException;

class UserDataService
{
    
    private $db;
    
    /**
     * configures db connection
     * @param string $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /**
     * does a select on users table if rows return is one returns true
     *
     * @param User
     * @return User|NULL
     */
    public function findUser(User $user){
        try {
            $username = $user->getUsername();
            $password = $user->getPassword();
            
            $stmt = $this->db->query("SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' LIMIT 1");
            
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result==1) {
                $resultUser = $stmt->fetch(PDO::FETCH_OBJ);
                $returnedUser = new User($resultUser->ID,$resultUser->FIRSTNAME, $resultUser->LASTNAME, $resultUser->EMAIL, $resultUser->USERNAME
                    , $resultUser->PASSWORD);
                return $returnedUser;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
    public function findUserByName($username){
        try {
            $stmt = $this->db->query("SELECT * FROM `users` WHERE `USERNAME` = '$username' LIMIT 1");
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result == 1) {
                $resultUser = $stmt->fetch(PDO::FETCH_OBJ);
                //($id,$firstName, $lastName, $email, $username, $password, $phone, $dateOfBirth, $role, $suspension)
                
                $returned = new User($resultUser->ID, $resultUser->FIRSTNAME, $resultUser->LASTNAME, $resultUser->EMAIL, 
                    $resultUser->USERNAME, $resultUser->PASSWORD);
                return $returned;
            } else {
                return false;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
    /**
     * creates new entry in the user table, returns true if one row is effected
     *
     * @param User $user
     * @return boolean
     */
    public function createUser(User $user){
        try {
            $usrnm = $user->getUsername();
            $psswd = $user->getPassword();
            $eml = $user->getEmail();
            $frstnm = $user->getFirstName();
            $lastnm = $user->getLastName();
            $stmt = $this->db->prepare("INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRSTNAME`, `LASTNAME`)
             VALUES (NULL, '$usrnm', '$psswd', '$eml', '$frstnm', '$lastnm');");
            $stmt->execute();
            $result = $stmt->rowCount();
            if($result==1){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e2) {
            throw $e2;
        }
    }
    
}

