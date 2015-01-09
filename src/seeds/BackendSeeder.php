<?php

use Illuminate\Database\Seeder;

class BackendSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('BackendSettingsSeeder');
		$this->call('BackendGroupsSeeder');
		$this->call('BackendPermissionsSeeder');
		$this->call('BackendUserFieldsSeeder');
		$this->call('BackendContentsSeeder');
		$this->call('BackendTaxonomiesSeeder');
	}

}
