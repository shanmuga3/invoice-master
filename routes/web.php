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
	
	Route::get('admin_users', "HomeController@dashboard")->name('admin_users')->middleware('permission:view-admin_users');

	Route::get('invoice', "HomeController@dashboard")->name('invoice')->middleware('permission:view-invoice');
	
	Route::get('agencies', "HomeController@dashboard")->name('agencies')->middleware('permission:view-agencies');
	
	Route::get('customers', "HomeController@dashboard")->name('customers')->middleware('permission:view-customers');
	
	Route::get('reports', "HomeController@dashboard")->name('reports')->middleware('permission:view-reports');
	
	Route::get('fees', "HomeController@dashboard")->name('fees')->middleware('permission:manage-fees');
	
	Route::get('email_settings', "HomeController@dashboard")->name('email_settings')->middleware('permission:manage-email_settings');
	
	Route::get('site_settings', "HomeController@dashboard")->name('site_settings')->middleware('permission:manage-site_settings');
});