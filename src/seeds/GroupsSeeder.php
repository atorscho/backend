<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Group::truncate();
		Permission::truncate();

		$groups = [
			[
				'name'   => 'Members',
				'handle' => 'members'
			],
			[
				'name'   => 'Moderators',
				'handle' => 'moderators',
				'prefix' => '<span style="font-weight: bold; color: #333f4a;">',
				'suffix' => '</span>'
			],
			[
				'name'   => 'Super-Moderators',
				'handle' => 'supermods',
				'prefix' => '<span style="font-weight: bold; color: #5cb85c;">',
				'suffix' => '</span>'
			],
			[
				'name'   => 'Administrators',
				'handle' => 'admins',
				'prefix' => '<span style="font-weight: bold; color: #f40;">',
				'suffix' => '</span>'
			],
			[
				'name'   => 'Super-Administrators',
				'handle' => 'superadmins',
				'prefix' => '<span style="font-weight: bold; color: #e26c5c;">',
				'suffix' => '</span>'
			]
		];

		$permissions = [
			[
				'name'   => 'Create Users',
				'handle' => 'createUsers'
			],
			[
				'name'   => 'Show Users',
				'handle' => 'showUsers'
			],
			[
				'name'   => 'Edit Users',
				'handle' => 'editUsers'
			],
			[
				'name'   => 'Delete Users',
				'handle' => 'deleteUsers'
			],
			[
				'name'   => 'Create Groups',
				'handle' => 'createGroups'
			],
			[
				'name'   => 'Show Groups',
				'handle' => 'showGroups'
			],
			[
				'name'   => 'Edit Groups',
				'handle' => 'editGroups'
			],
			[
				'name'   => 'Delete Groups',
				'handle' => 'deleteGroups'
			],
			[
				'name'   => 'Show Permissions',
				'handle' => 'showPermissions'
			],
			[
				'name'   => 'Edit Settings',
				'handle' => 'editSettings'
			]
		];

		foreach ( $groups as $group )
		{
			Group::create($group);
		}

		foreach ( $permissions as $permission )
		{
			Permission::create($permission);
		}
	}

}
