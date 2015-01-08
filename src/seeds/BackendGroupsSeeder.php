<?php

use Atorscho\Backend\Models\Group;
use Illuminate\Database\Seeder;

class BackendGroupsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Group::truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

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

		foreach ( $groups as $group )
			Group::create($group);
	}

}
