<?php
// Jacob Hushaw, Lincoln Magugo
// CST - 323, Professor Mark Reha
// This is our own work.
namespace App\Http\Services\DataServices;

use App\Http\Models\User;
use App\Http\Services\Utility\MyLogger;
use Exception;
use PDO;
use PDOException;

class UserDataService
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
     * does a select on users table if rows return is one returns true
     *
     * @param
     *            User
     * @return User|NULL
     */
    public function findUser(User $user)
    {
        MyLogger::info("Entering findUser() in the User Data Service");
        try {
            // get credentials form user object
            $username = $user->getUsername();
            $password = $user->getPassword();

            // select all where username & password = credentials
            $stmt = $this->db->query("SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' LIMIT 1");

            $stmt->execute();
            $result = $stmt->rowCount();

            // check if user was found, create new user and return it
            if ($result == 1) {
                $resultUser = $stmt->fetch(PDO::FETCH_OBJ);
                $returnedUser = new User($resultUser->ID, $resultUser->FIRSTNAME, $resultUser->LASTNAME, $resultUser->EMAIL, $resultUser->USERNAME, $resultUser->PASSWORD);
                MyLogger::info("User successfully found, exiting findUser()");
                return $returnedUser;
            } else {
                MyLogger::info("User not found, exiting findUser()");
                return null;
            }
        } catch (PDOException $e) {
            MyLogger::error("PDO Exception error in UserDataService.findUser");
            throw $e;
        }
    }

    /**
     * used to ensure multiple same users are not added to user table
     *
     * @param User $username
     * @throws Exception
     * @return \App\Http\Models\User|boolean
     */
    public function findUserByName($username)
    {
        MyLogger::info("Entering findUserByName() in the User Data Service");
        try {
            // find all users where username = $username
            $stmt = $this->db->query("SELECT * FROM `users` WHERE `USERNAME` = '$username' LIMIT 1");
            $stmt->execute();
            $result = $stmt->rowCount();
            // if user was found, return that user
            if ($result == 1) {
                $resultUser = $stmt->fetch(PDO::FETCH_OBJ);
                // ($id,$firstName, $lastName, $email, $username, $password, $phone, $dateOfBirth, $role, $suspension)

                $returned = new User($resultUser->ID, $resultUser->FIRSTNAME, $resultUser->LASTNAME, $resultUser->EMAIL, $resultUser->USERNAME, $resultUser->PASSWORD);
                MyLogger::info("User successfully found, exiting findUserByName()");
                return $returned;
            } else {
                MyLogger::error("User not found, exiting findUserByName()");
                return false;
            }
        } catch (Exception $e2) {
            MyLogger::error("PDO Exception error in UserDataService.findUserByName");
            throw $e2;
        }
    }

    /**
     * creates new entry in the user table, returns true if one row is effected
     *
     * @param User $user
     * @return boolean
     */
    public function createUser(User $user)
    {
        MyLogger::info("Entering createUser() in the User Data Service");
        try {
            // get all user info
            $usrnm = $user->getUsername();
            $psswd = $user->getPassword();
            $eml = $user->getEmail();
            $frstnm = $user->getFirstName();
            $lastnm = $user->getLastName();
            // insert user to user table
            $stmt = $this->db->prepare("INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRSTNAME`, `LASTNAME`)
             VALUES (NULL, '$usrnm', '$psswd', '$eml', '$frstnm', '$lastnm');");
            $stmt->execute();
            $result = $stmt->rowCount();
            // check if a row was affected
            if ($result == 1) {
                MyLogger::info("User successfully created, exiting createUser()");
                return true;
            } else {
                MyLogger::info("User not created, exiting createUser()");
                return false;
            }
        } catch (Exception $e2) {
            MyLogger::error("PDO Exception error in UserDataService.createUser");
            throw $e2;
        }
    }
    
}

