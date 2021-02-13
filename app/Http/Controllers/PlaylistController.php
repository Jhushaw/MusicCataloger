<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Playlist;
use App\Http\Services\BusinessServices\PlaylistBusinessService;
class PlaylistController extends Controller
{

    public function addPlaylist(Request $request){
        $name = $request->input('name');
        $userid = Session::get('userid');
        $playlist = new Playlist(null, $name, $userid);
        
        $pbs = new PlaylistBusinessService();
        
        $result = $pbs->createPlaylist($playlist);
        if ($result == true){
            return view('createPlaylist')->with('msg', 'Sucessfully created a Playlist');
        }else{
            return view('createPlaylist')->with('msg', "Failed to create a Playlist");
        }
    }
    
    public function viewAllPlaylists(){
        $pbs = new PlaylistBusinessService();
        $userid = Session::get('userid');
        $results = $pbs->findAllPlaylists($userid);
        if ($results != null){
            return view('myPlaylists')->with('playlists', $results);
        } else {
            return view('myPlaylists')->with('msg','You do not have any playlists yet.');
        }
    }
}
