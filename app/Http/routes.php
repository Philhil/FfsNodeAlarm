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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('auth/password', function() {return view('/auth/password');});
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function() {
        return redirect('/home');
    });

    Route::get('/home', 'DashboardController@index');

    Route::get('/tasks', 'TasksController@index');
    Route::get('/tasks/remove/{id}', 'TasksController@destroy');
    Route::post('/tasks', 'TasksController@store');

    Route::get('/profile/', 'UserController@show');
    Route::Post('/profile/', 'UserController@store');

    Route::get('/alerts/', 'AlertController@index');
});