<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Controllers;

use App\Http\Services\BusinessServices\SongBusinessService;
use App\Http\Services\Utility\MyLogger;
use Illuminate\Http\Request;

class SongController extends Controller
{

    /**
     * find all songs
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function viewAllSongs(){
        MyLogger::info("Entering viewAllSongs() in the song controller");
        //request all songs from bs and dao
        $sbs = new SongBusinessService();
        $results = $sbs->findAllSongs();
        //return results accordingly
        if ($results != null){
            MyLogger::info("Songs found, exiting viewAllSongs()");
            return view('viewAllSongs')->with('songs', $results);
        } else {
            MyLogger::warning("No songs where found in the database, exiting viewAllSongs()");
            return view('viewAllSongs')->with('msg','You do not have any songs yet.');
        }
    }
    
    /**
     * redirect to viewAllSongs with playlist id 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addToPlaylistView(Request $request)
    {
        MyLogger::info("Entering addToPlaylistView() in the song controller");
        //get playlist id
        $playlistID = $request->input('id');
        //find all songs 
        $sbs = new SongBusinessService();
        $results = $sbs->findAllSongs();
        //return results accordingly with playlistid
        if ($results != null){
            MyLogger::info("Playlist found exiting addToPlaylistView()");
            return view('viewAllSongs')->with('songs', $results)->with('playlistid',$playlistID);
        } else {
            MyLogger::warning("No palylists where found in the database, exiting addToPlaylistView()");
            return view('viewAllSongs')->with('msg','You do not have any songs yet.');
        }
    }
}
