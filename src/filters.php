<?php

// todo - translate

Route::filter('admin.auth', function ()
{
	if ( !strpos(Route::currentRouteName(), 'login') )
		if ( Auth::guest() )
			return Redirect::route('admin.login')->with('warning', 'You must be authenticated to access this page.');
});
