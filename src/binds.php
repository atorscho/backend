<?php

Route::bind('users', function ( $value )
{
	$users = \Atorscho\Backend\Models\User::find($value);

	if ( is_numeric($value) )
		return $users;

	if(!$users)
		return Redirect::route('admin.index')->with('User does not exist.');
});
Route::bind('groups', function ( $value )
{
	$groups = \Atorscho\Backend\Models\Group::find($value);

	if ( is_numeric($value) )
		return $groups;

	if(!$groups)
		return Redirect::route('admin.index')->with('Group does not exist.');
});
