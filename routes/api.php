<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/events','EventController@index');
// Route::put('/events/{event}','EventController@update')->name('events.update');
// Route::delete('/events/{event}','EventController@delete');
Route::post('login', 'API\UserController@login')->name('login');
Route::post('register', 'API\UserController@register');
Route::get('/view_all_events_of_specific_organisation/{view}','EventController@view')->name('events.view');
Route::group(['middleware'=>'auth:api'],function(){
Route::apiResource('details', 'API\UserController');
});
Route::group(['middleware'=>'auth:api'],function(){
Route::apiResource('events', 'EventController',['except' => ['index']]);
});

Route::apiResource('organisations','ProfileController');
