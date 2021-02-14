<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Login & register routes

    Route::get('/', function () {
        return view('login');
    });
        Route::get('/login', function () {
            return view('login');
        });
    
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('login', 'UserController@login');
    
    Route::post('register', 'UserController@register');
    
    Route::get('/logout', 'UserController@Logout');
    
    
 //playlist routes
 
    Route::get('/createplaylist', function () {
        return view('createPlaylist');
    });
            
    Route::post('addplaylist', 'PlaylistController@addPlaylist');
   
    Route::post('deletePlaylist', 'PlaylistController@deletePlaylist');
    
    Route::post('editPlaylistView', 'PlaylistController@editPlaylistView');
    
    Route::post('editplaylist', 'PlaylistController@editPlaylist');
    
    Route::get('myplaylists', 'PlaylistController@viewAllPlaylists');
    
   //Song Routes
    Route::get('songs', 'SongController@viewAllSongs');
    
    
 //Homepage routes

    Route::get('/home', function () {
        return view('home');
    });
