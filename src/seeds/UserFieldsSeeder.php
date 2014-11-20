<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
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
		UserField::truncate();
		UserFieldGroup::truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$user = User::find(1);
		if ( $user )
		{
			$user->fields()->detach();
		}

		$fieldGroups = [
			[
				'name'   => 'Social Networks',
				'handle' => 'socialNetworks',
				'fields' => [
					[
						'type' => 'url',
						'name' => 'Facebook',
						'handle' => 'facebook'
					],
					[
						'type' => 'url',
						'name' => 'Twitter',
						'handle' => 'twitter'
					]
				]
			]
		];

		foreach ( $fieldGroups as $fieldGroup )
		{
			$group = UserFieldGroup::create([
				'name'   => $fieldGroup['name'],
				'handle' => $fieldGroup['handle']
			]);

			foreach ( $fieldGroup['fields'] as $field )
			{
				$field = UserField::create([
					'group_id' => $group->id,
					'type'     => $field['type'],
					'name'     => $field['name'],
					'handle'   => $field['handle']
				]);
			}
		}

		if ( $user )
		{
			$user->fields()->attach(1, ['value' => 'http://facebook.com']);
			$user->fields()->attach(2, ['value' => 'http://twitter.com']);
		}

		// todo - add permissions
	}

}
