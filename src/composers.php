<?php

use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\TaxonomyType;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserFieldGroup;

/**
 * Sidebar on Users & Groups & Permissions index pages
 */
View::composer('backend::partials.users._sidebar', function ( $view )
{
	$view->with('usersCount', User::count());
	$view->with('groupsCount', Group::count());
	$view->with('permissionsCount', Permission::count());
	$view->with('fieldGroupsCount', UserFieldGroup::count());
});

// Sidebar on User Field Groups index page
// ===================================
View::composer('backend::partials.users._fields_sidebar', function ( $view )
{
	$view->with('fieldGroups', UserFieldGroup::orderBy('name')->get());
});

// Sidebar on Content & Taxonomy Types index page
// ===================================
View::composer('backend::partials.contents._sidebar', function ( $view )
{
	$view->with('types', ContentType::orderBy('name')->get());
});
View::composer('backend::partials.taxonomies._sidebar', function ( $view )
{
	$view->with('types', TaxonomyType::orderBy('name')->get());
});

// Content Fields
// ===================================
View::composer('backend::partials.contents._sidebar_fields', function ( $view )
{
	$view->with('types', ContentType::orderBy('name')->with('fields')->get());
});
