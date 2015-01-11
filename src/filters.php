<?php

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
	{
		if ( Auth::guest() )
		{
			Flash::warning('loginRequired');

			return Redirect::route('admin.login');
		}
	}
});

/*
|--------------------------------------------------------------------------
| GROUP ACCESS
|--------------------------------------------------------------------------
|
| Restrict access only to the selected group.
|
*/
Route::filter('admin.group', function($route, $request, $group) {
	if ( !in_array(Route::currentRouteName(), ['admin.login', 'admin.login.post', 'admin.logout']) && Auth::check() )
	{
		if ( !in($group) )
		{
			Flash::danger('noPageAccess');

			return Redirect::to('/');
		}
	}
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
	{
		if ( !can($perm) )
		{
			Flash::danger('noPageAccess');

			return Redirect::route('admin.index');
		}
	}
});
