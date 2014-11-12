<?php

// todo - translate

Route::filter('admin.auth', function ()
{
	if ( !strpos(Route::currentRouteName(), 'login') )
		if ( Auth::guest() )
			return Redirect::route('admin.login')->with('warning', 'You must be authenticated to access this page.');
});

Route::filter('admin.access:perm', function($perm) {
	if ( !Auth::user()->can($perm) )
		return Redirect::route('admin.index')->with('warning', 'You do not have enough permissions to access this page.');
});
