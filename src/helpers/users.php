<?php

if ( !function_exists('groupsList') )
{
	/**
	 * The same as $user->groups->implode('name', ', '),
	 * but with links to group show routes.
	 *
	 * @param null $user
	 *
	 * @return string
	 */
	function groupsAnchorList( $user = null )
	{
		if ( is_null($user) )
			$user = Auth::user();

		$list = array();

		foreach ( $user->groups as $group )
		{
			$list[] = sprintf('<a href="%s">%s</a>', route('admin.groups.show', $group->id), $group->name);
		}

		return implode(', ', $list);
	}
}
