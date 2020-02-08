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
	Route::post('authenticate', 'AdminController@authenticate')->name('authenticate');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('logout', 'AdminController@logout')->name('logout');
    
    Route::get('/', function() {
    	return redirect()->route('admin.dashboard');
    });

	Route::get('dashboard', "AdminController@dashboard")->name('dashboard');
		
	// Manage Admin Users Routes
    Route::group(['prefix' => 'admin_users'], function () {
    	Route::get('/', 'AdminUsersController@index')->name('admin_users')->middleware('permission:view-admin_users');
    	Route::get('create', 'AdminUsersController@create')->name('admin_users.create')->middleware('permission:create-admin_users');
    	Route::post('/', 'AdminUsersController@store')->name('admin_users.store')->middleware('permission:create-admin_users');
    	Route::get('{id}/edit', 'AdminUsersController@edit')->name('admin_users.edit')->middleware('permission:update-admin_users');
    	Route::match(['PUT','PATCH'],'{id}', 'AdminUsersController@update')->name('admin_users.update')->middleware('permission:update-admin_users');
    	Route::delete('{id}', 'AdminUsersController@destroy')->name('admin_users.delete')->middleware('permission:delete-admin_users');
    });

    // Manage Roles and Permission Routes
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RolesController@index')->name('roles')->middleware('permission:view-roles');
        Route::get('create', 'RolesController@create')->name('roles.create')->middleware('permission:create-roles');
        Route::post('/', 'RolesController@store')->name('roles.store')->middleware('permission:create-roles');
        Route::get('{id}/edit', 'RolesController@edit')->name('roles.edit')->middleware('permission:update-roles');
        Route::match(['PUT','PATCH'],'{id}', 'RolesController@update')->name('roles.update')->middleware('permission:update-roles');
        Route::delete('{id}', 'RolesController@destroy')->name('roles.delete')->middleware('permission:delete-roles');
    });

    // Manage Agencies Routes
    Route::group(['prefix' => 'agencies'], function () {
    	Route::get('/', 'AgenciesController@index')->name('agencies')->middleware('permission:view-agencies');
    	Route::get('create', 'AgenciesController@create')->name('agencies.create')->middleware('permission:create-agencies');
    	Route::post('/', 'AgenciesController@store')->name('agencies.store')->middleware('permission:create-agencies');
    	Route::get('{id}/edit', 'AgenciesController@edit')->name('agencies.edit')->middleware('permission:update-agencies');
    	Route::match(['PUT','PATCH'],'{id}', 'AgenciesController@update')->name('agencies.update')->middleware('permission:update-agencies');
    	Route::delete('{id}', 'AgenciesController@destroy')->name('agencies.delete')->middleware('permission:delete-agencies');
    });

    // Manage Customers Routes
    Route::group(['prefix' => 'customers'], function () {
    	Route::get('/', 'CustomersController@index')->name('customers')->middleware('permission:view-customers');
    	Route::get('create', 'CustomersController@create')->name('customers.create')->middleware('permission:create-customers');
    	Route::post('/', 'CustomersController@store')->name('customers.store')->middleware('permission:create-customers');
    	Route::get('{id}/edit', 'CustomersController@edit')->name('customers.edit')->middleware('permission:update-customers');
    	Route::match(['PUT','PATCH'],'{id}', 'CustomersController@update')->name('customers.update')->middleware('permission:update-customers');
    	Route::delete('{id}', 'CustomersController@destroy')->name('customers.delete')->middleware('permission:delete-customers');
    });

    // Manage Invoice Routes
    Route::group(['prefix' => 'invoice'], function () {
    	Route::get('/', 'InvoiceController@index')->name('invoice')->middleware('permission:view-invoice');
    	Route::get('create', 'InvoiceController@create')->name('invoice.create')->middleware('permission:create-invoice');
    	Route::post('/', 'InvoiceController@store')->name('invoice.store')->middleware('permission:create-invoice');
    	Route::get('{id}/edit', 'InvoiceController@edit')->name('invoice.edit')->middleware('permission:update-invoice');
    	Route::match(['PUT','PATCH'],'{id}', 'InvoiceController@update')->name('invoice.update')->middleware('permission:update-invoice');
    	Route::delete('{id}', 'InvoiceController@destroy')->name('invoice.delete')->middleware('permission:delete-invoice');
    });

    // Manage Invoice Templated Routes
    Route::group(['prefix' => 'invoice_templates'], function () {
    	Route::get('/', 'InvoiceTemplatesController@index')->name('invoice_templates')->middleware('permission:view-invoice_templates');
    	Route::get('create', 'InvoiceTemplatesController@create')->name('invoice_templates.create')->middleware('permission:create-invoice_templates');
    	Route::post('/', 'InvoiceTemplatesController@store')->name('invoice_templates.store')->middleware('permission:create-invoice_templates');
    	Route::get('{id}/edit', 'InvoiceTemplatesController@edit')->name('invoice_templates.edit')->middleware('permission:update-invoice_templates');
    	Route::match(['PUT','PATCH'],'{id}', 'InvoiceTemplatesController@update')->name('invoice_templates.update')->middleware('permission:update-invoice_templates');
    	Route::delete('{id}', 'InvoiceTemplatesController@destroy')->name('invoice_templates.delete')->middleware('permission:delete-invoice_templates');
    });

	Route::get('reports', "AdminController@index")->name('reports')->middleware('permission:view-reports');
	
	// Manage Fees Routes
    Route::group(['prefix' => 'fees'], function () {
        Route::get('/', 'FeesController@index')->name('fees')->middleware('permission:view-fees');
        Route::match(['PUT','PATCH'],'/', 'FeesController@update')->name('fees.update')->middleware('permission:update-fees');
    });

    // Manage Email Settings Routes
    Route::group(['prefix' => 'email_settings'], function () {
        Route::get('/', 'EmailController@index')->name('email_settings')->middleware('permission:view-email_settings');
        Route::match(['PUT','PATCH'],'/', 'EmailController@update')->name('email_settings.update')->middleware('permission:update-email_settings');
    });

    // Manage Site Settings Routes
    Route::group(['prefix' => 'site_settings'], function () {
        Route::get('/', 'SiteSettingsController@index')->name('site_settings')->middleware('permission:view-site_settings');
        Route::match(['PUT','PATCH'],'/', 'SiteSettingsController@update')->name('site_settings.update')->middleware('permission:update-site_settings');
    });
});