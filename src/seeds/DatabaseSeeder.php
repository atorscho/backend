<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SettingsSeeder');
		$this->call('GroupsSeeder');
		$this->call('PermissionsSeeder');
	}

}
