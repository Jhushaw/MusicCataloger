<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Models;

class Playlist
{
    private $id;
    private $name;
    private $users_ID;
    
    public function __construct($id, $name, $users_ID){
        $this->id = $id;
        $this->name = $name;
        $this->users_ID = $users_ID;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getUsers_ID()
    {
        return $this->users_ID;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $users_ID
     */
    public function setUsers_ID($users_ID)
    {
        $this->users_ID = $users_ID;
    }

    
    
}

