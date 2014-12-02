<?php namespace Atorscho\Backend\Seeds;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
use DB;
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
				$field = UserField::create([
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
			]
		];

		foreach ( $permissions as $permission )
			${$permission['handle']} = Permission::create($permission);

		$members = Group::find(1);
		$members->permissions()->attach($showFields->id);

		$mods = Group::find(2);
		$mods->permissions()->attach($showFields->id);

		$supermods = Group::find(3);
		$supermods->permissions()->attach($showFields->id);
		$supermods->permissions()->attach($editFields->id);

		$admins = Group::find(4);
		$admins->permissions()->attach($showFields->id);
		$admins->permissions()->attach($createFields->id);
		$admins->permissions()->attach($editFields->id);
		$admins->permissions()->attach($deleteFields->id);

		$superadmins = Group::find(5);
		$superadmins->permissions()->attach($showFields->id);
		$superadmins->permissions()->attach($createFields->id);
		$superadmins->permissions()->attach($editFields->id);
		$superadmins->permissions()->attach($deleteFields->id);
	}

}
