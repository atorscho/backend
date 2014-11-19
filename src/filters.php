<?php

// todo - translate

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
|
| Only authenticated user can access to the backend.
|
*/
Route::filter('admin.auth', function ()
{
	if ( !strpos(Route::currentRouteName(), 'login') )
		if ( Auth::guest() )
			return Redirect::route('admin.login')->with('warning', 'You must be authenticated to access this page.');
});

/*
|--------------------------------------------------------------------------
| GROUP ACCESS
|--------------------------------------------------------------------------
|
| Restrict access only to the selected group.
|
*/
// todo - Change to route 'front'
Route::filter('admin.group', function($route, $request, $group) {
	if ( !in_array(Route::currentRouteName(), ['admin.login', 'admin.login.post', 'admin.logout']) && Auth::check() )
		if ( !Auth::user()->in($group) )
			return Redirect::to('/')->with('danger', 'You do not have enough permissions to access this page.');
});
/*
|--------------------------------------------------------------------------
| PERMISSION ACCESS
|--------------------------------------------------------------------------
|
| Restrict access to the specified group permission.
|
*/
Route::filter('admin.perm', function($route, $request, $perm) {
	if ( !in_array(Route::currentRouteName(), ['admin.login', 'admin.login.post', 'admin.logout']) && Auth::check() )
		if ( !Auth::user()->can($perm) )
			return Redirect::route('admin.index')->with('danger', 'You do not have enough permissions to access this page.');
});
