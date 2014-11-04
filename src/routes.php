<?php

Route::group(['before' => 'csrf', 'namespace' => 'Atorscho\Backend', 'prefix' => 'admin'], function ()
{
	// ADMIN
	// ===================================
	Route::get('/', [
		'as' => 'admin.index',
		'uses' => 'BackendController@index'
	]);

	// Settings
	// ===================================
	Route::get('/settings', [
		'as' => 'admin.settings',
		'uses' => 'SettingController@index'
	]);
	Route::put('/settings', [
		'as' => 'admin.settings.update',
		'uses' => 'SettingController@update'
	]);
});

