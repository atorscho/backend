<?php

// Global Filters
use Atorscho\Backend\Models\ContentType;

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
	Route::put('lang/{locale}', [
		'as'   => 'admin.lang',
		'uses' => 'BackendController@lang'
	]);

	// Settings
	// ===================================
	Route::get('settings', [
		'as'   => 'admin.settings.index',
		'uses' => 'SettingController@index'
	]);
	Route::get('settings/{settingsGroup}', [
		'as'   => 'admin.settings.show',
		'uses' => 'SettingController@show'
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

	// Content Types
	// ===================================
	Route::resource('content-types', 'ContentTypeController', [ 'except' => 'show' ]);
	Route::get('{content-types}', [
		'as'   => 'admin.content-types.show',
		'uses' => 'ContentTypeController@show'
	]);
	Route::get('{content-types}/create', [
		'as'   => 'admin.content-types.create',
		'uses' => 'ContentTypeController@create'
	]);
	Route::post('{content-types}', [
		'as'   => 'admin.content-types.store',
		'uses' => 'ContentTypeController@store'
	]);
	Route::get('{content-types}/{content}/edit', [
		'as'   => 'admin.content-types.edit',
		'uses' => 'ContentTypeController@edit'
	]);
	Route::put('{content-types}/{content}', [
		'as'   => 'admin.content-types.update',
		'uses' => 'ContentTypeController@update'
	]);
	Route::delete('{content-types}/{content}', [
		'as'   => 'admin.content-types.destroy',
		'uses' => 'ContentTypeController@destroy'
	]);

	// Ecommerce
	// ===================================
	Route::get('ecommerce', [
		'as'   => 'ecommerce.index',
		'uses' => 'EcommerceController@index'
	]);
});
