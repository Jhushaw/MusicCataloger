<?php
//Jacob Hushaw, Lincoln Magugo
//CST - 323, Professor Mark Reha
//This is our own work. 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Playlist;
use App\Http\Services\BusinessServices\PlaylistBusinessService;
use App\Http\Services\Utility\MyLogger;
class PlaylistController extends Controller
{

    /**
     * Gets name and userid and returns all playlists with new playlist added.
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addPlaylist(Request $request){
        MyLogger::info("Entering addPlaylist() in the Playlist controller");
        //grab fields from view
        $name = $request->input('name');
        $userid = Session::get('userid');
        
        //send playlist to business service
        $playlist = new Playlist(null, $name, $userid);
        $pbs = new PlaylistBusinessService();
        $result = $pbs->createPlaylist($playlist);
        
        //check if playlist was added or not.. return view accordingly
        if ($result == true){
            MyLogger::info("Playlist ".$name. " was successfully added");
            return $this->viewAllPlaylists();
        }else{
            MyLogger::error("Playlist could not be created, exiting addPlaylist()");
            return view('createPlaylist')->with('msg', "Failed to create a Playlist");
        }
    }
    
    /**
     * recieve playlist id, send to be deleted
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deletePlaylist(Request $request){
        MyLogger::info("Entering deletePalylist() in the playlist controller");
        //get playlist id send to bs
        $id = $request->input('id');
        $pbs = new PlaylistBusinessService();  
        $result = $pbs->deletePlaylist($id);
        //check if playlist was deleted.. return view accordingly
        if ($result == true){
            MyLogger::info("Playlist with ID: ".$id. " successfully deleted, exiting deletePlaylist()");
            return $this->viewAllPlaylists();
        }else{
            MyLogger::error("Playlist with ID: ".$id. " could not be deleted, exiting deletePlaylist()");
            return view('error')->with('msg', "Failed to delete a Playlist");
        }
    }
    
    /**
     * get Id and name from myPlaylists page, send to editPlaylist page
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPlaylistView(Request $request){
        MyLogger::info("Entering editPlaylistView() in the playlist controller");
        //get id and name
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        //send playlist to edit page
        MyLogger::info("Exiting editPlaylistView() in the playlist controller");
        return view('editPlaylist')->with('playlist', $playlist);
    }
    
    /**
     * get fields from view, send to be edited
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPlaylist(Request $request){
        MyLogger::info("Entering editPlaylist() in the playlist controller");
        //get fields.. create playlist
        $id = $request->input('id');
        $name = $request->input('name');
        $playlist = New Playlist($id, $name, null);
        
        $pbs = new PlaylistBusinessService();
        //send playlist down to be edited
        $result = $pbs->editPlaylist($playlist);
        //check if playlist was edited.. return view accordingly
        if ($result == true){
            MyLogger::info($name. " successfully edited, exiting editPlaylist()");
            return $this->viewAllPlaylists();
        }else{
            MyLogger::warning($name. " not successfully edited, exiting editPlaylist()");
            return view('error')->with('msg', "Failed to edit the Playlist, make sure you actually changed something");
        }
    }
    
    /**
     * find all playlists based on logged in user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function viewAllPlaylists(){
        MyLogger::info("Entering viewAllPlaylists() in the playlist controller");
        $pbs = new PlaylistBusinessService();
        $userid = Session::get('userid');
        $results = $pbs->findAllPlaylists($userid);
        if ($results != null){
            MyLogger::info("Playlists successfully returned, exiting viewAllPlaylists()");
            return view('myPlaylists')->with('playlists', $results);
        } else {
            MyLogger::warning("There are no playlist for this user in the database, exiting viewAllPlaylists()");
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
        MyLogger::info("Entering viewPlaylist() in the playlist controller");
        //get id from view, find all songs based on id.
        $pbs = new PlaylistBusinessService();
        $playlistID= $request->input('id');
        $results = $pbs->viewPlaylist($playlistID);
        //make sure you got songs back.. return view accordingly
        if ($results != null){
            MyLogger::info("Playlists successfully displayed, exiting viewPlaylist()");
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistID);
        } else {
            return view('viewPlaylist')->with('msg','You currently do not have any songs in this playlist.')->with('playlistid',$playlistID);
        }
    }
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addSongToPlaylist(Request $request)
    {
        MyLogger::info("Entering addSongToPlaylist() in the playlist controller");
        //get ids from view, send down to bs and dao to add to playlistsong table
        $playlistID= $request->input('playlistid');
        $songID = $request->input('songid');
        //make sure song was added as well as got all songs for viewPlaylist
        $pbs = new PlaylistBusinessService();
        $result1 = $pbs->addToPlaylist($playlistID, $songID);
        
        $results = $pbs->viewPlaylist($playlistID);
        //return results accordingly
        if ($results != null && $result1 != null){
            MyLogger::info("Song successfully added, exiting addSongToPlaylist()");
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistID);
        } else {
            MyLogger::error("Failed to add the song to the playlist, exiting addSongToPlaylist()");
            return view('viewPlaylist')->with('msg','Failed to add song to the Playlist.')->with('playlistid',$playlistID);
        }
    }
    
    /**
     * sends songid down to dao to be deleted
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteSong(Request $request){
        MyLogger::info("Entering deleteSong() in the playlist controller");
        //get song and playlist id send to bs
        $songid = $request->input('songid');
        $playlistid = $request->input('playlistid');
        $pbs = new PlaylistBusinessService();
        //delete song
        $result1 = $pbs->deleteSong($songid, $playlistid);
        
        $results = $pbs->viewPlaylist($playlistid);
        //check if Song was deleted.. return view accordingly
        if ($results != null && $result1 == true){
            MyLogger::info("Song successfully deleted, exiting deleteSong()");
            return view('viewPlaylist')->with('songs', $results)->with('playlistid',$playlistid);
        } else if ($result1 == true){
            return view('viewPlaylist')->with('msg','you do not have any songs in this playlist.')->with('playlistid',$playlistid);
        } else {
            MyLogger::error("Failed to delete the song from the playlist, exiting deleteSong()");
            return view('viewPlaylist')->with('msg','Failed to delete song from the Playlist.')->with('playlistid',$playlistid);
        }
    }
}
