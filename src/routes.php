<?php

// Global Filters
Route::when('admin*', 'admin.auth');
Route::when('admin*', 'csrf', [
	'post',
	'put',
	'delete'
]);

// Routes
Route::group([
	'namespace' => 'Atorscho\Backend\Controllers',
	'prefix'    => 'admin'
], function ()
{
	// Admin
	// ===================================
	Route::get('/', [
		'as'   => 'admin.index',
		'uses' => 'BackendController@index'
	]);
	Route::get('login', [
		'as'   => 'admin.login',
		'uses' => 'BackendController@login'
	]);
	Route::post('login', [
		'as'   => 'admin.login.post',
		'uses' => 'BackendController@loginPost'
	]);
	Route::get('logout', [
		'as'   => 'admin.logout',
		'uses' => 'BackendController@logout'
	]);
	Route::get('lang/{locale}', [
		'as'   => 'admin.lang',
		'uses' => 'BackendController@lang'
	]);

	// Settings
	// ===================================
	Route::get('settings', [
		'as'   => 'admin.settings',
		'uses' => 'SettingController@index'
	]);
	Route::put('settings', [
		'as'   => 'admin.settings.update',
		'uses' => 'SettingController@update'
	]);

	// Users & Groups & Permissions & Fields
	// ===================================
	Route::resource('users/fields/groups', 'UserFieldGroupController');
	Route::resource('users/fields', 'UserFieldController');
	Route::resource('users/groups', 'GroupController');
	Route::resource('users/permissions', 'PermissionController', [ 'only' => 'index' ]);
	Route::resource('users', 'UserController');

	// Ecommerce
	// ===================================
	Route::get('ecommerce', [
		'as'   => 'ecommerce.index',
		'uses' => 'EcommerceController@index'
	]);
});
