<?php

use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
use Illuminate\Database\Seeder;

class BackendUserFieldsSeeder extends Seeder {

	protected $permissions;

	public function __construct()
	{
		$this->permissions = [
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
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$permHandles = array_map(function ($item)
		{
			return $item['handle'];
		}, $this->permissions);

		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		UserField::truncate();
		UserFieldGroup::truncate();
		Permission::whereIn('handle', $permHandles)->delete();

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
		foreach ( $this->permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', 'showFields');
		addPermissionsToGroup('moderators', 'showFields');
		addPermissionsToGroup('supermods', ['showFields', 'editFields']);
		addPermissionsToGroup('admins', ['createFields', 'showFields', 'editFields', 'deleteFields', 'showFieldGroups', 'editFieldGroups']);
		addPermissionsToGroup('superadmins', ['createFields', 'showFields', 'editFields', 'deleteFields', 'showFieldGroups', 'editFieldGroups']);
	}

}
