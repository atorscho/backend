<?php

use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\Taxonomy;
use Atorscho\Backend\Models\TaxonomyType;

// todo - add settings. e.g. taxonomy per page

class BackendTaxonomiesSeeder extends Seeder {

	protected $permissions;

	public function __construct()
	{
		$this->permissions = [
			[
				'name'   => 'Create Taxonomies',
				'handle' => 'createTaxonomies'
			],
			[
				'name'   => 'Show Taxonomies',
				'handle' => 'showTaxonomies'
			],
			[
				'name'   => 'Edit Taxonomies',
				'handle' => 'editTaxonomies'
			],
			[
				'name'   => 'Delete Taxonomies',
				'handle' => 'deleteTaxonomies'
			],
			[
				'name'   => 'Create Taxonomy Types',
				'handle' => 'createTaxonomyTypes'
			],
			[
				'name'   => 'Show Taxonomy Types',
				'handle' => 'showTaxonomyTypes'
			],
			[
				'name'   => 'Edit Taxonomy Types',
				'handle' => 'editTaxonomyTypes'
			],
			[
				'name'   => 'Delete Taxonomy Types',
				'handle' => 'deleteTaxonomyTypes'
			]
		];
	}

	public function run()
	{
		$permHandles = array_map(function ( $item )
		{
			return $item['handle'];
		}, $this->permissions);

		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Taxonomy::truncate();
		TaxonomyType::truncate();
		Permission::whereIn('handle', $permHandles)->delete();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		// Default Taxonomy Types with its Fields
		$types = [
			[
				'name'         => 'Categories',
				'name_sg'      => 'Category',
				'slug'         => '',
				'description'  => 'Some sort of folders for your content.',
				'icon'         => 'folder',
				'hierarchical' => 1
			],
			[
				'name'         => 'Tags',
				'name_sg'      => 'Tag',
				'slug'         => '',
				'description'  => 'Labels for the content.',
				'icon'         => 'tags',
				'hierarchical' => 0
			]
		];

		// Save the default types and its fields.
		foreach ( $types as $type )
		{
			TaxonomyType::create($type);
		}

		// Sample Category
		Taxonomy::create([
			'type_id' => TaxonomyType::findSlug('categories')->first()->id,
			'title'   => 'Base Category',
			'slug'    => 'base-category',
			'order'   => ''
		]);

		$this->permissions();
	}

	protected function permissions()
	{
		foreach ( $this->permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', 'showTaxonomies');
		addPermissionsToGroup('moderators', 'showTaxonomies');
		addPermissionsToGroup('supermods', [
			'showTaxonomies',
			'editTaxonomies'
		]);
		addPermissionsToGroup('admins', [
			'createTaxonomies',
			'showTaxonomies',
			'editTaxonomies',
			'deleteTaxonomies',
			'showTaxonomyTypes',
			'editTaxonomyTypes'
		]);
		addPermissionsToGroup('superadmins', [
			'createTaxonomies',
			'showTaxonomies',
			'editTaxonomies',
			'deleteTaxonomies',
			'createTaxonomyTypes',
			'showTaxonomyTypes',
			'editTaxonomyTypes',
			'deleteTaxonomyTypes'
		]);
	}

}
