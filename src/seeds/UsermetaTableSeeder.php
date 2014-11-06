<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\Usermeta;
use Illuminate\Database\Seeder;

class UsermetaTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Usermeta::truncate();

		$meta = [
			[

			]
		];
	}

}
