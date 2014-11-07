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
				'handle' => 'moderators'
			],
			[
				'name'   => 'Super-Moderators',
				'handle' => 'supermods'
			],
			[
				'name'   => 'Administrators',
				'handle' => 'admins'
			],
			[
				'name'   => 'Super-Administrators',
				'handle' => 'superadmins'
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
