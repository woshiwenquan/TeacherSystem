<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','UsersController@postLogin');

Route::get('/logout','UsersController@getLogOut');

Route::get('/getInfo','UsersController@getInfo');

Route::get('/editInfo','UsersController@editInfo');

Route::get('/getTeacherList','UsersController@getTeacherList');

Route::get('/getTeacherDetail','UsersController@getTeacherDetail');

Route::get('/evaluateTeacher','UsersController@evaluateTeacher');

Route::get('/feedBack','UsersController@feedBack');




