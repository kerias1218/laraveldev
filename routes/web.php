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

// Authentication Routes...
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');