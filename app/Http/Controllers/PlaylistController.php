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
            return $this->viewAllPlaylists();
        }else{
            return view('createPlaylist')->with('msg', "Failed to create a Playlist");
        }
    }
    
    public function deletePlaylist(Request $request){
        $id = $request->input('id');
        
        $pbs = new PlaylistBusinessService();
        
        $result = $pbs->deletePlaylist($id);
        if ($result == true){
            return $this->viewAllPlaylists();
        }else{
            return view('error')->with('msg', "Failed to create a Playlist");
        }
    }
    
    public function editPlaylistView(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        return view('editPlaylist')->with('playlist', $playlist);
    }
    
    public function editPlaylist(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        
        $pbs = new PlaylistBusinessService();
        
        $result = $pbs->editPlaylist($playlist);
        if ($result == true){
            return $this->viewAllPlaylists();
        }else{
            return view('error')->with('msg', "Failed to edit the Playlist");
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
    
    public function viewPlaylist(Request $request)
    {
        $pbs = new PlaylistBusinessService();
        $playlistID= $request->input('id');
        $results = $pbs->viewPlaylist($playlistID);
        if ($results != null){
            return view('viewPlaylist')->with('playlists', $results);
        } else {
            return view('viewPlaylist')->with('msg','You currently do not have any songs in this playlist.');
        }
    }
}
