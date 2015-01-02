<?php

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentField;
use Atorscho\Backend\Models\ContentType;

class ContentsSeeder extends Seeder {

	public function run()
	{
		$faker = \Faker\Factory::create();

		// Default Content Types with its Fields
		$types = [
			[
				'name'   => 'Page',
				'fields' => [
					[
						'type' => 'textarea',
						'name' => 'Body',
						'required' => 1,
					]
				]
			],
			[
				'name'   => 'Article',
				'fields' => [
					[
						'type' => 'textarea',
						'name' => 'Body',
						'required' => 1,
					]
				]
			]
		];

		// Save the default types and its fields.
		foreach ( $types as $type )
		{
			$contentType = ContentType::create([
				'name' => $type['name'],
				'handle' => ''
			]);

			foreach ( $type['fields'] as $field )
			{
				ContentField::create([
					'type'        => $field['type'],
					'name'        => $field['name'],
					'handle'      => '',
					'placeholder' => '',
					'required'    => $field['required'],
					'order'       => ''
				]);
			}
		}

		// Seed Pages with some fake data.
		foreach ( range(1, 10) as $i )
		{
			Content::create([
				'type_id' => ContentType::findHandle('page')->id,
				'title' => $name = $faker->sentence(4),
				'slug' => $name,
				'published' => 1
			]);
		}

	}

}
