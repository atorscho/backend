<?php

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentField;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\Permission;
use Atorscho\Backend\Models\User;

// todo - add settings. e.g. content per page

class BackendContentsSeeder extends Seeder {

	protected $permissions;

	public function __construct()
	{
		$this->permissions = [
			[
				'name'   => 'Create Contents',
				'handle' => 'createContents'
			],
			[
				'name'   => 'Show Contents',
				'handle' => 'showContents'
			],
			[
				'name'   => 'Edit Contents',
				'handle' => 'editContents'
			],
			[
				'name'   => 'Delete Contents',
				'handle' => 'deleteContents'
			],
			[
				'name'   => 'Create Content Types',
				'handle' => 'createContentTypes'
			],
			[
				'name'   => 'Show Content Types',
				'handle' => 'showContentTypes'
			],
			[
				'name'   => 'Edit Content Types',
				'handle' => 'editContentTypes'
			],
			[
				'name'   => 'Delete Content Types',
				'handle' => 'deleteContentTypes'
			],
			[
				'name'   => 'Create Content Fields',
				'handle' => 'createContentFields'
			],
			[
				'name'   => 'Show Content Fields',
				'handle' => 'showContentFields'
			],
			[
				'name'   => 'Edit Content Fields',
				'handle' => 'editContentFields'
			],
			[
				'name'   => 'Delete Content Fields',
				'handle' => 'deleteContentFields'
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

		DB::table('contents_pivot')->truncate();
		Content::truncate();
		ContentField::truncate();
		ContentType::truncate();
		Permission::whereIn('handle', $permHandles)->delete();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		// Default Content Types with its Fields
		$types = [
			[
				'name'         => 'Pages',
				'name_sg'      => 'Page',
				'description'  => 'List of all static pages.',
				'icon'         => 'file-text',
				'hierarchical' => 1,
				'fields'       => [
					[
						'type'     => 'textarea',
						'name'     => 'Body',
						'handle'   => 'body',
						'required' => 1,
					]
				]
			],
			[
				'name'         => 'Articles',
				'name_sg'      => 'Article',
				'description'  => 'Site news, articles and posts.',
				'icon'         => 'file-image-o',
				'hierarchical' => 0,
				'fields'       => [
					[
						'type'     => 'textarea',
						'name'     => 'Body',
						'handle'   => 'body',
						'required' => 1,
					]
				]
			]
		];

		// Save the default types and its fields.
		foreach ( $types as $type )
		{
			$contentType = ContentType::create([
				'name'         => $type['name'],
				'name_sg'      => $type['name_sg'],
				'slug'         => '',
				'description'  => $type['description'],
				'icon'         => $type['icon'],
				'hierarchical' => $type['hierarchical']
			]);

			foreach ( $type['fields'] as $field )
			{
				$contentField[$contentType->slug . '.' . $field['handle']] = ContentField::create([
					'type_id'     => $contentType->id,
					'type'        => $field['type'],
					'name'        => $field['name'],
					'handle'      => $field['handle'],
					'placeholder' => '',
					'required'    => $field['required'],
					'order'       => ''
				]);
			}
		}

		$this->permissions();
	}

	protected function permissions()
	{
		foreach ( $this->permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', 'showContents');
		addPermissionsToGroup('moderators', 'showContents');
		addPermissionsToGroup('supermods', [
			'showContents',
			'editContents'
		]);
		addPermissionsToGroup('admins', [
			'createContents',
			'showContents',
			'editContents',
			'deleteContents',
			'showContentTypes',
			'editContentTypes',
			'showContentFields',
			'createContentFields',
			'editContentFields',
			'deleteContentFields'
		]);
		addPermissionsToGroup('superadmins', [
			'createContents',
			'showContents',
			'editContents',
			'deleteContents',
			'createContentTypes',
			'showContentTypes',
			'editContentTypes',
			'deleteContentTypes',
			'showContentFields',
			'createContentFields',
			'editContentFields',
			'deleteContentFields'
		]);
	}

}
