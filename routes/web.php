<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', ['as'=>'login', 'uses'=>'MainController@login']);
Route::post('/check-login', 'MainController@checkLogin');
Route::get('/logout', 'MainController@logout')->middleware('auth');
Route::get('/hands', 'HandsController@listHands')->middleware('auth');
Route::get('/hands/form', 'HandsController@index')->middleware('auth');
Route::post('/hands/upload', 'HandsController@upload');

