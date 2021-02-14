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

    /**
     * Gets name and userid and returns all playlists with new playlist added.
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addPlaylist(Request $request){
        //grab fields from view
        $name = $request->input('name');
        $userid = Session::get('userid');
        
        //send playlist to business service
        $playlist = new Playlist(null, $name, $userid);
        $pbs = new PlaylistBusinessService();
        $result = $pbs->createPlaylist($playlist);
        
        //check if playlist was added or not.. return view accordingly
        if ($result == true){
            return $this->viewAllPlaylists();
        }else{
            return view('createPlaylist')->with('msg', "Failed to create a Playlist");
        }
    }
    
    /**
     * recieve playlist id, send to be deleted
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deletePlaylist(Request $request){
        //get playlist id send to bs
        $id = $request->input('id');
        $pbs = new PlaylistBusinessService();  
        $result = $pbs->deletePlaylist($id);
        //check if playlist was deleted.. return view accordingly
        if ($result == true){
            return $this->viewAllPlaylists();
        }else{
            return view('error')->with('msg', "Failed to create a Playlist");
        }
    }
    
    /**
     * get Id and name from myPlaylists page, send to editPlaylist page
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPlaylistView(Request $request){
        //get id and name
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        //send playlist to edit page
        return view('editPlaylist')->with('playlist', $playlist);
    }
    
    /**
     * get fields from view, send to be edited
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPlaylist(Request $request){
        //get fields.. create playlist
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        
        $pbs = new PlaylistBusinessService();
        //send playlist down to be edited
        $result = $pbs->editPlaylist($playlist);
        //check if playlist was edited.. return view accordingly
        if ($result == true){
            return $this->viewAllPlaylists();
        }else{
            return view('error')->with('msg', "Failed to edit the Playlist, make sure you actually changed something");
        }
    }
    
    /**
     * find all playlists based on logged in user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
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
    
    /**
     * view a single playlist
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function viewPlaylist(Request $request)
    {
        //get id from view, find all songs based on id.
        $pbs = new PlaylistBusinessService();
        $playlistID= $request->input('id');
        $results = $pbs->viewPlaylist($playlistID);
        //make sure you got songs back.. return view accordingly
        if ($results != null){
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistID);
        } else {
            return view('viewPlaylist')->with('msg','You currently do not have any songs in this playlist.')->with('playlistid',$playlistID);
        }
    }
    
    public function addSongToPlaylist(Request $request)
    {
        //get id from view, find all songs based on id.
        $playlistID= $request->input('playlistid');
        $songID = $request->input('songid');
        //make sure you got songs back.. return view accordingly
        $pbs = new PlaylistBusinessService();
        $result1 = $pbs->addToPlaylist($playlistID, $songID);
        
        $results = $pbs->viewPlaylist($playlistID);
        //return results accordingly
        if ($results != null && $result1 != null){
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistID);
        } else {
            return view('viewPlaylist')->with('msg','Failed to add song to the Playlist.')->with('playlistid',$playlistID);
        }
    }
    
    public function deleteSong(Request $request){
        //get song id send to bs
        $songid = $request->input('songid');
        $playlistid = $request->input('playlistid');
        $pbs = new PlaylistBusinessService();
        $result1 = $pbs->deleteSong($songid);
        
        $results = $pbs->viewPlaylist($playlistid);
        //check if Song was deleted.. return view accordingly
        if ($results != null && $result1 == true){
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistid);
        } else {
            return view('viewPlaylist')->with('msg','Failed to delete song from the Playlist.')->with('playlistid',$playlistid);
        }
    }
}
