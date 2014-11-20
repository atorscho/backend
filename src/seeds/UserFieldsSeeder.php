<?php

use Atorscho\Backend\Models\Field;
use Atorscho\Backend\Models\FieldGroup;
use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Illuminate\Database\Seeder;

class UserFieldsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		Field::truncate();
		FieldGroup::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$fieldGroups = [
			[
				'name'   => 'Social Networks',
				'handle' => 'socialNetworks',
				'fields' => [
					[
						'type' => 'text',
						'name' => 'Facebook',
						'handle' => 'facebook'
					]
				]
			]
		];

		foreach ( $fieldGroups as $fieldGroup )
		{
			$group = FieldGroup::create([
				'name'   => $fieldGroup['name'],
				'handle' => $fieldGroup['handle']
			]);

			foreach ( $fieldGroup['fields'] as $field )
			{
				Field::create([
					'group_id' => $group->id,
					'type'     => $field['type'],
					'name'     => $field['name'],
					'handle'   => $field['handle']
				]);
			}
		}



		// todo - add permissions
	}

}
