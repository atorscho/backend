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
			]
		];
	}

	public function run()
	{
		$permHandles = array_map(function ($item)
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
				'description'  => 'List of all static pages.',
				'icon'         => 'file-text',
				'hierarchical' => 1,
				'fields'       => [
					[
						'type'     => 'textarea',
						'name'     => 'Body',
						'handle'     => 'body',
						'required' => 1,
					]
				]
			],
			[
				'name'         => 'Articles',
				'description'  => 'Site news, articles and posts.',
				'icon'         => 'file-image-o',
				'hierarchical' => 0,
				'fields'       => [
					[
						'type'     => 'textarea',
						'name'     => 'Body',
						'handle'     => 'body',
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
					'handle'        => $field['handle'],
					'placeholder' => '',
					'required'    => $field['required'],
					'order'       => ''
				]);
			}
		}

		// Seed Pages with some fake data.
		/*foreach ( range(1, 10) as $i )
		{
			$userID = User::orderByRaw("RAND()")->first()->id;

			$content = Content::create([
				'type_id'    => ContentType::findSlug('pages')->first()->id,
				'title'      => $name = $faker->sentence(4),
				'slug'       => $name,
				'published'  => rand(0, 1),
				'order'      => '',
				'created_by' => $userID,
				'updated_by' => $userID
			]);

			$content->fields()->attach($contentField['pages.body']->id, [ 'value' => $faker->paragraph(4) ]);
		}*/

		// Seed Articles with some fake data.
		/*foreach ( range(1, 10) as $i )
		{
			$userID = User::orderByRaw("RAND()")->first()->id;

			$content = Content::create([
				'type_id'    => ContentType::findSlug('articles')->first()->id,
				'title'      => $name = $faker->sentence(4),
				'slug'       => $name,
				'published'  => rand(0, 1),
				'order'      => '',
				'created_by' => $userID,
				'updated_by' => $userID
			]);

			$content->fields()->attach($contentField['articles.body']->id, [ 'value' => $faker->paragraph(4) ]);
		}*/

		$this->permissions();
	}

	protected function permissions()
	{
		foreach ( $this->permissions as $permission )
			Permission::create($permission);

		addPermissionsToGroup('members', 'showContents');
		addPermissionsToGroup('moderators', 'showContents');
		addPermissionsToGroup('supermods', ['showContents', 'editContents']);
		addPermissionsToGroup('admins', ['createContents', 'showContents', 'editContents', 'deleteContents', 'showContentTypes', 'editContentTypes']);
		addPermissionsToGroup('superadmins', ['createContents', 'showContents', 'editContents', 'deleteContents', 'createContentTypes', 'showContentTypes', 'editContentTypes', 'deleteContentTypes']);
	}

}
