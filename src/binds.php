<?php

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\SettingsGroup;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;

Route::bind('users', function($users)
{
	if ( is_numeric( $users ) )
		$users = User::find($users);
	else
		$users = User::where('username', $users)->first();

	if ( !$users )
		\App::abort(404);

	return $users;
});

Route::bind('groups', function ( $value )
{
	if ( strpos(Route::current()->getName(), 'fields.groups') )
	{
		if ( is_numeric( $value ) )
			$groups = UserFieldGroup::find($value);
		else
			$groups = UserFieldGroup::where('username', $value)->first();
	}
	else
	{
		if ( is_numeric( $value ) )
			$groups = Group::find($value);
		else
			$groups = Group::where('username', $value)->first();
	}

	if ( !$groups )
		\App::abort(404);

	return $groups;
});

Route::bind('fields', function($fields)
{
	if ( is_numeric( $fields ) )
		$fields = UserField::find($fields);
	else
		$fields = UserField::where('handle', $fields)->first();

	if ( !$fields )
		\App::abort(404);

	return $fields;
});

Route::bind('settingsGroup', function($settingsGroup)
{
	if ( is_numeric( $settingsGroup ) )
		$settingsGroup = SettingsGroup::find($settingsGroup);
	else
		$settingsGroup = SettingsGroup::where('slug', $settingsGroup)->first();

	if ( !$settingsGroup )
		\App::abort(404);

	return $settingsGroup;
});

Route::bind('content_types', function($contentTypes)
{
	if ( is_numeric( $contentTypes ) )
		$contentTypes = ContentType::find($contentTypes);
	else
		$contentTypes = ContentType::where('slug', $contentTypes)->first();

	if ( !$contentTypes )
		\App::abort(404);

	return $contentTypes;
});

Route::bind('content', function($content)
{
	if ( is_numeric( $content ) )
		$content = Content::withTrashed()->find($content);
	else
		$content = Content::where('slug', $content)->first();

	if ( !$content )
		\App::abort(404);

	return $content;
});
