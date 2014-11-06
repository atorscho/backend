<?php

use Atorscho\Backend\Models\Group;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('group_permission')->truncate();

		// Members - 1
		// Moderators - 2
		// Supermods - 3
		// Admins - 4
		// Superadmins - 5

		// Create Users - 1
		// Show Users - 2
		// Edit Users - 3
		// Delete Users - 4
		// Create Groups - 5
		// Show Groups - 6
		// Edit Groups - 7
		// Delete Groups - 8
		// Show Permissions - 9
		// Edit Settings - 10

		$members = Group::find(1);
		$members->permissions()->attach(2);
		$members->permissions()->attach(6);
		$members->permissions()->attach(9);

		$moderators = Group::find(2);
		$moderators->permissions()->attach(2);
		$moderators->permissions()->attach(3);
		$moderators->permissions()->attach(6);
		$moderators->permissions()->attach(9);

		$supermods = Group::find(3);
		$supermods->permissions()->attach(1);
		$supermods->permissions()->attach(2);
		$supermods->permissions()->attach(3);
		$supermods->permissions()->attach(4);
		$supermods->permissions()->attach(6);
		$supermods->permissions()->attach(7);
		$supermods->permissions()->attach(9);

		$admins = Group::find(4);
		$admins->permissions()->attach(1);
		$admins->permissions()->attach(2);
		$admins->permissions()->attach(3);
		$admins->permissions()->attach(4);
		$admins->permissions()->attach(5);
		$admins->permissions()->attach(6);
		$admins->permissions()->attach(7);
		$admins->permissions()->attach(8);
		$admins->permissions()->attach(9);

		$superadmins = Group::find(5);
		$superadmins->permissions()->attach(1);
		$superadmins->permissions()->attach(2);
		$superadmins->permissions()->attach(3);
		$superadmins->permissions()->attach(4);
		$superadmins->permissions()->attach(5);
		$superadmins->permissions()->attach(6);
		$superadmins->permissions()->attach(7);
		$superadmins->permissions()->attach(8);
		$superadmins->permissions()->attach(9);
		$superadmins->permissions()->attach(10);
	}

}
