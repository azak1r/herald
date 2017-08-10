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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::resource('events', 'EventController');
Route::get('/events/{event}/announce', ['as' => 'events.announce', 'uses' => 'EventController@announce']);

Route::post('/announcement/{event}', ['as' => 'announcements.create', 'uses' => 'AnnouncementController@create']);
Route::get('/announcement/{announcement}/remove', ['as' => 'announcements.destroy', 'uses' => 'AnnouncementController@destroy']);
