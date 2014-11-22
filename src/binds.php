<?php

// todo - translate

Route::bind('users', function ( $value )
{
	$users = \Atorscho\Backend\Models\User::find($value);

	if ( is_numeric($value) )
		return $users;

	if ( !$users )
		return Redirect::route('admin.index')->with('User does not exist.');
});
Route::bind('groups', function ( $value )
{
	if ( strpos(Route::current()->getName(), 'fields.groups') )
		$groups = \Atorscho\Backend\Models\UserFieldGroup::find($value);
	else
		$groups = \Atorscho\Backend\Models\Group::find($value);

	if ( is_numeric($value) )
		return $groups;

	// todo - Group or Field Group does not exist.

	if ( !$groups )
		return Redirect::route('admin.index')->with('Group does not exist.');
});
