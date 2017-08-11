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

Route::get('/', ['as' => 'login', 'uses' => 'HomeController@index', 'middleware' => 'guest']);

Route::group(['middleware' => 'auth'], function(){
    Route::resource('events', 'EventController');
    Route::get('/events/{event}/announce', ['as' => 'events.announce', 'uses' => 'EventController@announce']);
});

Route::post('/announcement/{event}', ['as' => 'announcements.create', 'uses' => 'AnnouncementController@create']);
Route::get('/announcement/{announcement}/remove', ['as' => 'announcements.destroy', 'uses' => 'AnnouncementController@destroy']);

Route::group(['prefix' => 'auth'], function(){

    Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\SSOController@login']);
    Route::get('/sso', ['as' => 'auth.callback', 'uses' => 'Auth\SSOController@callback']);
    Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SSOController@logout']);

});