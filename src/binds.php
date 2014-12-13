<?php

// todo - translate

// todo - update binds with new Live Template

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;

Route::bind('users', function ( $value )
{
	$users = User::find($value);

	return $users;
});

Route::bind('groups', function ( $value )
{
	if ( strpos(Route::current()->getName(), 'fields.groups') )
	{
		$groups = UserFieldGroup::find($value);
	}
	else
	{
		$groups = Group::find($value);
	}

	return $groups;
});

Route::bind('fields', function ( $fields )
{
	$fields = UserField::find($fields);

	return $fields;
});
