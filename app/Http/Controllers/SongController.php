<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Controllers;

use App\Http\Services\BusinessServices\SongBusinessService;

class SongController extends Controller
{

    /**
     * find all songs
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function viewAllSongs(){
        //request all songs from bs and dao
        $sbs = new SongBusinessService();
        $results = $sbs->findAllSongs();
        //return results accordingly
        if ($results != null){
            return view('viewAllSongs')->with('songs', $results);
        } else {
            return view('viewAllSongs')->with('msg','You do not have any songs yet.');
        }
    }
}
