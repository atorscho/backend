<?php

// ADMIN
// ===================================
Route::get('/admin', ['as' => 'admin.index', 'uses' => 'Atorscho\Backend\BackendController@index']);

// Settings
// ===================================
Route::get('/admin/settings', ['as' => 'admin.settings', 'uses' => 'Atorscho\Backend\SettingController@index']);
