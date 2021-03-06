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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/scrape', 'App\Http\Controllers\HomeController@scrape');



Route::get('/home', 'App\Http\Controllers\ProductDisplayController@home');

Route::get('/scrapeMe', 'App\Http\Controllers\HomeController@scapeMe');



