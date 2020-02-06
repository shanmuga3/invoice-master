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

Route::group(['middleware' => 'guest:admin'], function () {
	Route::view('login', 'admin.login')->name('login');
	Route::post('authenticate', 'HomeController@authenticate')->name('authenticate');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::get('/', function() {
    	return redirect()->route('admin.dashboard');
    });
	Route::get('dashboard', "HomeController@dashboard")->name('dashboard');
});