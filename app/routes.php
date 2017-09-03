<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'main', 'uses' => 'MainController@showMain']);
Route::get('show-users', ['as' => 'show-users', 'uses' => 'MainController@showUsers']);
Route::get('add-user', ['as' => 'add-user', 'uses' => 'MainController@addUserManualFormPage']);
Route::post('add-user', ['as' => 'add-userPOST', 'uses' => 'MainController@addUserManual']);
Route::get('add-users/{count}', ['as' => 'add-users', 'uses' => 'MainController@addUsers'])->where(['count' => '[0-9]+']);
Route::get('delete-users', ['as' => 'delete-users', 'uses' => 'MainController@deleteUsers']);