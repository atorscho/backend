<?php namespace Atorscho\Backend\Seeds;

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

		$this->call(__NAMESPACE__ . '\SettingsSeeder');
		$this->call(__NAMESPACE__ . '\GroupsSeeder');
		$this->call(__NAMESPACE__ . '\PermissionsSeeder');
		$this->call(__NAMESPACE__ . '\UserFieldsSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
