<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Models;

class Song
{
    private $id;
    private $name;
    private $artist;
    private $image;
    private $playlists_ID;

    public function __construct($id,$name,$artist,$image,$playlists_ID){
        $this->id = $id;
        $this->name = $name;
        $this->artist = $artist;
        $this->image = $image;
        $this->playlists_ID = $playlists_ID;
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
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
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
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    /**
     * @return mixed
     */
    public function getPlaylists_ID()
    {
        return $this->playlists_ID;
    }
    
    /**
     * @param mixed $playlists_ID
     */
    public function setPlaylists_ID($playlists_ID)
    {
        $this->playlists_ID = $playlists_ID;
    }

}

