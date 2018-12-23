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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Route::resource('things', 'ThingsController');
Route::get('things', 'ThingsController@index');
Route::get('things/create', 'ThingsController@create');
Route::post('things/store', 'ThingsController@store');
Route::get('things/edit', 'ThingsController@edit');
Route::post('things/update/{id}', 'ThingsController@update');

Route::get('things/channels', 'ThingsController@channels');
