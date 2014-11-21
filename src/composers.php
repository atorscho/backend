<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserFieldGroup;

View::composer('backend::partials.users._sidebar', function ( $view )
{
	$view->with('usersCount', User::count());
	$view->with('groupsCount', Group::count());
	$view->with('permissionsCount', Permission::count());
	$view->with('fieldGroupsCount', UserFieldGroup::count());
});
