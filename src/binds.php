<?php

// todo - translate

Route::bind('users', function ( $value )
{
	$users = \Atorscho\Backend\Models\User::find($value);

	if ( !$users )
		return Redirect::route('admin.users.index')->with('User does not exist.');

	return $users;
});
Route::bind('groups', function ( $value )
{
	if ( strpos(Route::current()->getName(), 'fields.groups') )
	{
		$groups = \Atorscho\Backend\Models\UserFieldGroup::find($value);

		if ( !$groups )
			return Redirect::route('admin.users.fields.groups.index')->with('Fields Group does not exist.');
	}
	else
	{
		$groups = \Atorscho\Backend\Models\Group::find($value);

		if ( !$groups )
			return Redirect::route('admin.users.groups.index')->with('Group does not exist.');
	}

	return $groups;
});
Route::bind('fields', function ( $fields )
{
	$fields = \Atorscho\Backend\Models\UserField::all();

	if ( !$fields )
		return Redirect::route('admin.users.fields.index')->with('Field does not exist.');

	return $fields;
});
