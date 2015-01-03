<?php

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentField;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\User;

class ContentsSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		DB::table('contents_pivot')->truncate();
		Content::truncate();
		ContentField::truncate();
		ContentType::truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$faker = \Faker\Factory::create();

		$userID = User::first()->id;

		// Default Content Types with its Fields
		$types = [
			[
				'name'   => 'Page',
				'icon'   => 'file-text',
				'fields' => [
					[
						'type'     => 'textarea',
						'name'     => 'Body',
						'handle'   => 'body',
						'required' => 1,
					]
				]
			],
			[
				'name'   => 'Article',
				'icon'   => 'file-image-o',
				'fields' => [
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
				'name'   => $type['name'],
				'handle' => '',
				'icon'   => $type['icon']
			]);

			foreach ( $type['fields'] as $field )
			{
				$contentField[$contentType->handle . '.' . $field['handle']] = ContentField::create([
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

		// Seed Pages with some fake data.
		foreach ( range(1, 10) as $i )
		{
			$content = Content::create([
				'type_id'    => ContentType::findHandle('page')->id,
				'title'      => $name = $faker->sentence(4),
				'slug'       => $name,
				'published'  => 1,
				'order'      => '',
				'created_by' => $userID,
				'updated_by' => $userID
			]);

			$content->fields()->attach($contentField['page.body']->id, [ 'value' => $faker->paragraph(4) ]);
		}

		// Seed Articles with some fake data.
		foreach ( range(1, 10) as $i )
		{
			$content = Content::create([
				'type_id'    => ContentType::findHandle('article')->id,
				'title'      => $name = $faker->sentence(4),
				'slug'       => $name,
				'published'  => 1,
				'order'      => '',
				'created_by' => $userID,
				'updated_by' => $userID
			]);

			$content->fields()->attach($contentField['article.body']->id, [ 'value' => $faker->paragraph(4) ]);
		}
	}

}
