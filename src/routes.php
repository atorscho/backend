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
	Route::delete('{content}', [
		'as'   => 'admin.contents.destroy',
		'uses' => 'ContentController@destroy'
	]);
	Route::delete('{content}', [
		'as'   => 'admin.contents.forceDestroy',
		'uses' => 'ContentController@forceDestroy'
	]);
	Route::put('{content}', [
		'as'   => 'admin.contents.toggleStatus',
		'uses' => 'ContentController@toggleStatus'
	]);

	// Taxonomy Types
	// ===================================
	Route::resource('taxonomies/taxonomy-types', 'TaxonomyTypeController', [
		'except' => 'show',
		'names'  => [
			'index'   => 'admin.taxonomy-types.index',
			'create'  => 'admin.taxonomy-types.create',
			'store'   => 'admin.taxonomy-types.store',
			'edit'    => 'admin.taxonomy-types.edit',
			'update'  => 'admin.taxonomy-types.update',
			'destroy' => 'admin.taxonomy-types.destroy',
		]
	]);

	// Taxonomies
	// ===================================
	Route::get('taxonomies/{taxonomy_types}', [
		'as'   => 'admin.taxonomy-types.show',
		'uses' => 'TaxonomyTypeController@show'
	]);
	Route::get('taxonomies/{taxonomy_types}/create', [
		'as'   => 'admin.taxonomies.create',
		'uses' => 'TaxonomyController@create'
	]);
	Route::post('taxonomies/{taxonomy_types}', [
		'as'   => 'admin.taxonomies.store',
		'uses' => 'TaxonomyController@store'
	]);
	Route::get('taxonomies/{taxonomy_types}/{taxonomy}/edit', [
		'as'   => 'admin.taxonomies.edit',
		'uses' => 'TaxonomyController@edit'
	]);
	Route::put('taxonomies/{taxonomy_types}/{taxonomy}', [
		'as'   => 'admin.taxonomies.update',
		'uses' => 'TaxonomyController@update'
	]);
	Route::delete('taxonomies/{taxonomy}', [
		'as'   => 'admin.taxonomies.destroy',
		'uses' => 'TaxonomyController@destroy'
	]);
	Route::delete('taxonomies/{taxonomy}', [
		'as'   => 'admin.taxonomies.forceDestroy',
		'uses' => 'TaxonomyController@forceDestroy'
	]);
	Route::put('taxonomies/{taxonomy}', [
		'as'   => 'admin.taxonomies.toggleStatus',
		'uses' => 'TaxonomyController@toggleStatus'
	]);

	// Ecommerce
	// ===================================
	Route::get('ecommerce', [
		'as'   => 'ecommerce.index',
		'uses' => 'EcommerceController@index'
	]);
});
