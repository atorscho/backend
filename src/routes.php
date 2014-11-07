<?php

// Filters
Route::when('admin*', 'admin.auth');

Route::group([
	'namespace' => 'Atorscho\Backend\Controllers',
	'prefix'    => 'admin'
], function ()
{
	// ADMIN
	// ===================================
	Route::get('/', [
		'as'   => 'admin.index',
		'uses' => 'BackendController@index'
	]);
	Route::get('/login', [
		'as'   => 'admin.login',
		'uses' => 'BackendController@login'
	]);
	Route::post('/login', [
		'as'     => 'admin.login.post',
		'before' => 'csrf',
		'uses'   => 'BackendController@loginPost'
	]);
	Route::get('/logout', [
		'as'   => 'admin.logout',
		'uses' => 'BackendController@logout'
	]);

	// Settings
	// ===================================
	Route::get('/settings', [
		'as'   => 'admin.settings',
		'uses' => 'SettingController@index'
	]);
	Route::put('/settings', [
		'as'     => 'admin.settings.update',
		'before' => 'csrf',
		'uses'   => 'SettingController@update'
	]);

	// Users & Groups & Permissions
	// ===================================
	Route::resource('users', 'UserController', [ 'except' => 'show' ]);
	Route::resource('groups', 'GroupController');
	//Route::resource('users/permissions', 'PermissionController');
});
