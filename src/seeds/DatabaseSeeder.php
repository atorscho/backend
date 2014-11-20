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

		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		$this->call('SettingsSeeder');
		$this->call('GroupsSeeder');
		$this->call('PermissionsSeeder');
		$this->call('UserFieldsSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
