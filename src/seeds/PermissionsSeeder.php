<?php

use Atorscho\Backend\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		DB::table('group_permission')->truncate();
		Permission::truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

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

		foreach ( $permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', ['showUsers', 'showGroups', 'showPermissions']);
		addPermissionsToGroup('moderators', ['showUsers', 'editUsers', 'showGroups', 'showPermissions']);
		addPermissionsToGroup('supermods', ['createUsers', 'showUsers', 'editUsers', 'createGroups', 'showGroups', 'editGroups', 'showPermissions']);
		addPermissionsToGroup('admins', ['createUsers', 'showUsers', 'editUsers', 'deleteUsers', 'createGroups', 'showGroups', 'editGroups', 'deleteGroups', 'showPermissions']);
		addPermissionsToGroup('superadmins', ['createUsers', 'showUsers', 'editUsers', 'deleteUsers', 'createGroups', 'showGroups', 'editGroups', 'deleteGroups', 'showPermissions', 'editSettings']);
	}

}
