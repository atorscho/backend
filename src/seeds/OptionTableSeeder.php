<?php

use Atorscho\Backend\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Option::truncate();

		$seeds = [
			[
				'name'        => 'Site Name',
				'handle'      => 'siteName',
				'value'       => 'Verge',
				'default'     => 'Verge',
				'description' => 'Will be used in "title" tag and headings.'
			],
			[
				'name'        => 'Slogan',
				'handle'      => 'slogan',
				'value'       => 'Admin',
				'default'     => 'Admin',
				'description' => 'Some short description of the site.'
			],
			[
				'name'        => 'Established',
				'handle'      => 'established',
				'value'       => '2014',
				'default'     => '2014',
				'description' => 'Year the site was established.'
			],
			[
				'name'        => 'Owner',
				'handle'      => 'owner',
				'value'       => 'Alex Torscho',
				'default'     => 'Alex Torscho',
				'description' => 'Name of the site creator.'
			],
			[
				'name'        => 'Copyright',
				'handle'      => 'copyright',
				'value'       => 'All rights reserved',
				'default'     => 'All rights reserved',
				'description' => 'Your custom copyright text that is displayed in site footer.'
			],
			[
				'name'        => 'Date Format',
				'handle'      => 'dateFormat',
				'value'       => 'M d Y',
				'default'     => 'M d Y',
				'description' => 'Specify your prefered date format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'name'        => 'DateTime Format',
				'handle'      => 'dateTimeFormat',
				'value'       => 'M d Y, H:i',
				'default'     => 'M d Y, H:i',
				'description' => 'Specify your prefered datetime format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'name'        => 'Default Group',
				'handle'      => 'defaultGroup',
				'value'       => '1',
				'default'     => '1',
				'description' => 'The default group for new registered users.'
			],
			[
				'name'        => 'Title Separator',
				'handle'      => 'titleSep',
				'value'       => ' | ',
				'default'     => ' | ',
				'description' => 'The separator that is used in "title" tag and headings.'
			],
			[
				'name'        => 'Images Folder',
				'handle'      => 'folderImg',
				'value'       => 'images/',
				'default'     => 'images/',
				'description' => 'Main folder for uploaded images.'
			],
			[
				'name'        => 'Avatars Folder',
				'handle'      => 'folderAvatars',
				'value'       => 'images/avatars/',
				'default'     => 'images/avatars/',
				'description' => 'Folder for uploaded user avatars.'
			]
		];

		foreach ( $seeds as $seed )
		{
			$option              = new Option;
			$option->name        = $seed['name'];
			$option->handle      = $seed['handle'];
			$option->value       = $seed['value'];
			$option->default     = $seed['default'];
			$option->description = $seed['description'];
			$option->save();
		}
	}

}
