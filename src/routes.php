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

	// Contents
	// ===================================
	Route::get('{content_types}', [
		'as'   => 'admin.content-types.show',
		'uses' => 'ContentTypeController@show'
	]);
	Route::get('{content_types}/create', [
		'as'   => 'admin.contents.create',
		'uses' => 'ContentController@create'
	]);
	Route::post('{content_types}', [
		'as'   => 'admin.contents.store',
		'uses' => 'ContentController@store'
	]);
	Route::get('{content_types}/{content}/edit', [
		'as'   => 'admin.contents.edit',
		'uses' => 'ContentController@edit'
	]);
	Route::put('{content_types}/{content}', [
		'as'   => 'admin.contents.update',
		'uses' => 'ContentController@update'
	]);
	Route::delete('{content_types}/{content}', [
		'as'   => 'admin.contents.destroy',
		'uses' => 'ContentController@destroy'
	]);
	Route::put('{content}', [
		'as'   => 'admin.contents.toggleStatus',
		'uses' => 'ContentController@toggleStatus'
	]);

	// Ecommerce
	// ===================================
	Route::get('ecommerce', [
		'as'   => 'ecommerce.index',
		'uses' => 'EcommerceController@index'
	]);
});
