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

/**
 * Landing page
 */
Route::get('/', [
    'uses' => 'HomeController@index',
    'as'   => 'home'
]);

/*
| -------------------------------------------------------------
| * Authentication routes
|--------------------------------------------------------------
*/
Route::get('/auth/register', [
  'uses'        => 'Auth\AuthController@getRegister',
  'as'          => 'getRegister'
]);

Route::post('/auth/register' , [
  'uses'        => 'Auth\AuthController@postRegister',
  'as'          =>  'postRegister'
]);

Route::get('/auth/login', [
    'uses'      => 'Auth\AuthController@getLogin',
    'as'        =>  'getLogin'
]);

Route::post('/auth/login', [
  'uses'        => 'Auth\AuthController@postLogin',
  'as'          => 'postLogin'
]);

Route::get('/auth/logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'getLogout'
]);

/*
|-------------------------------------------------------
| Social auth route
|-------------------------------------------------------
*/

Route::get('/auth/login/{provider?}', 'Auth\AuthController@doSocial');

/*
|-------------------------------------------------------
| user profile
|-------------------------------------------------------
*/
Route::get('/user/profile', [
    'middleware'    => 'auth',
    'uses' => 'UserController@index',
    'as'   => 'profile'
]);

Route::get('/user/profile/video', [
    'uses' => 'VideoController@index',
    'as'   => 'viewUploadVideoForm'
]);

Route::post('/user/profile/video', [
    'uses' => 'VideoController@store',
    'as'   => 'createVideo'
]);

Route::get('/video/{id}/edit', 'VideoController@edit');

Route::get('/profile/{username}/edit', [
    'middleware'    => 'auth',
    'uses' => 'UserController@edit'
]);

Route::post('/profile/{username}/edit', [
    'uses' => 'UserController@postUpdateUserProfile',
    'as'   => 'postUpdateUserProfile'
]);
