<?php

use Illuminate\Database\Seeder;

// todo - improve permissions. let reseed.

class BackendSeeder extends Seeder {

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
		$this->call('UserFieldsSeeder');
		$this->call('ContentsSeeder');
	}

}
