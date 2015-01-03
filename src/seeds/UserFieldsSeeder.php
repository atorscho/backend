<?php

use Atorscho\Backend\Models\Permission;
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
				UserField::create([
					'group_id' => $group->id,
					'type'     => $field['type'],
					'name'     => $field['name'],
					'handle'   => $field['handle']
				]);
			}
		}

		$this->permissions();
	}

	protected function permissions()
	{
		$permissions = [
			[
				'name'   => 'Create Fields',
				'handle' => 'createFields'
			],
			[
				'name'   => 'Show Fields',
				'handle' => 'showFields'
			],
			[
				'name'   => 'Edit Fields',
				'handle' => 'editFields'
			],
			[
				'name'   => 'Delete Fields',
				'handle' => 'deleteFields'
			],
			[
				'name'   => 'Create Field Groups',
				'handle' => 'createFieldGroups'
			],
			[
				'name'   => 'Show Field Groups',
				'handle' => 'showFieldGroups'
			],
			[
				'name'   => 'Edit Field Groups',
				'handle' => 'editFieldGroups'
			],
			[
				'name'   => 'Delete Field Groups',
				'handle' => 'deleteFieldGroups'
			]
		];

		foreach ( $permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', 'showFields');
		addPermissionsToGroup('moderators', 'showFields');
		addPermissionsToGroup('supermods', ['showFields', 'editFields']);
		addPermissionsToGroup('admins', ['createFields', 'showFields', 'editFields', 'deleteFields', 'showFieldGroups', 'editFieldGroups']);
		addPermissionsToGroup('superadmins', ['createFields', 'showFields', 'editFields', 'deleteFields', 'showFieldGroups', 'editFieldGroups']);
	}

}
