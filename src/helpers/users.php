<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;

if ( !function_exists('addPermissionsToGroup') )
{
	/**
	 * Add permissions to Members group.
	 *
	 * @param int|string       $group       Group handle or ID.
	 * @param int|string|array $permissions Permission's ID or handle or an array of permissions' IDs or handles.
	 *
	 * @return bool
	 */
	function addPermissionsToGroup( $group, $permissions )
	{
		// Get group model
		$group = is_numeric($group) ? Group::find($group) : Group::where('handle', $group)->first();

		// Attach permissions to the group
		if ( is_array($permissions) )
		{
			foreach ( $permissions as $permission )
			{
				// If permission is a handle, get its ID
				if ( !is_numeric($permission) )
					$permission = Permission::where('handle', $permission)->first()->id;

				$group->permissions()->attach($permission);
			}

			return true;
		}

		// If permission is a handle, get its ID
		if ( !is_numeric($permissions) )
			$permissions = Permission::where('handle', $permissions)->first()->id;

		$group->permissions()->attach($permissions);

		return true;
	}
}
