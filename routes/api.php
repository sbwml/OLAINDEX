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

// 登陆相关
Route::post('/login','AuthController@login');
Route::post('/logout','AuthController@logout');
Route::get('/user','AuthController@user');

Route::get('/settings','SettingController@index');
Route::post('/settings','SettingController@update');
