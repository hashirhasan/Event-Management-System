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

Route::get('/view_domain','EventController@viewdomain');
Route::get('/upcoming_events','EventController@upcoming_events')->name('events.upcoming');
Route::get('/domain_specific_events','EventController@domain_specific_events')->name('events.domain_specific');
Route::get('/events_passed_away','EventController@passed_events')->name('events.passed');
Route::get('/events/{event}','EventController@show')->name('events.show');
// Route::delete('/events/{event}','EventController@delete');
Route::post('login', 'API\UserController@login')->name('login');
Route::post('register', 'API\UserController@register');
Route::get('/view_all_events_of_specific_organisation/{view}','EventController@view')->name('events.view');
Route::group(['middleware'=>'auth:api'],function(){
Route::apiResource('details', 'API\UserController');
});
Route::group(['middleware'=>'auth:api'],function(){
Route::apiResource('events', 'EventController',['except' => ['index','show']]);
});

Route::apiResource('organisations','ProfileController');
Route::get('/users/verify/{token}','API\UserController@verify')->name('verify');
Route::apiResource('events/{event}/reviews','ReviewsController');
