<?php

use Atorscho\Backend\OptGroup;
use Atorscho\Backend\Option;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Option::truncate();

		$optgroups = [
			[
				'name'   => 'General Settings',
				'handle' => 'general'
			],
			[
				'name'   => 'User Settings',
				'handle' => 'users'
			],
			[
				'name'   => 'Template Settings',
				'handle' => 'template'
			],
			[
				'name'   => 'File System',
				'handle' => 'files'
			]
		];

		$options = [
			[
				'optgroup_id' => 1,
				'name'        => 'Site Name',
				'handle'      => 'siteName',
				'value'       => 'Verge',
				'default'     => 'Verge',
				'description' => 'Will be used in "title" tag and headings.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'Slogan',
				'handle'      => 'slogan',
				'value'       => 'Admin',
				'default'     => 'Admin',
				'description' => 'Some short description of the site.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'Established',
				'handle'      => 'established',
				'value'       => '2014',
				'default'     => '2014',
				'description' => 'Year the site was established.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'Owner',
				'handle'      => 'owner',
				'value'       => 'Alex Torscho',
				'default'     => 'Alex Torscho',
				'description' => 'Name of the site creator.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'Copyright',
				'handle'      => 'copyright',
				'value'       => 'All rights reserved',
				'default'     => 'All rights reserved',
				'description' => 'Your custom copyright text that is displayed in site footer.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'Date Format',
				'handle'      => 'dateFormat',
				'value'       => 'M d Y',
				'default'     => 'M d Y',
				'description' => 'Specify your prefered date format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'optgroup_id' => 1,
				'name'        => 'DateTime Format',
				'handle'      => 'dateTimeFormat',
				'value'       => 'M d Y, H:i',
				'default'     => 'M d Y, H:i',
				'description' => 'Specify your prefered datetime format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'optgroup_id' => 2,
				'name'        => 'Default Group',
				'handle'      => 'defaultGroup',
				'value'       => '1',
				'default'     => '1',
				'description' => 'The default group for new registered users.'
			],
			[
				'optgroup_id' => 3,
				'name'        => 'Title Separator',
				'handle'      => 'titleSep',
				'value'       => ' | ',
				'default'     => ' | ',
				'description' => 'The separator that is used in "title" tag and headings.'
			],
			[
				'optgroup_id' => 4,
				'name'        => 'Images Folder',
				'handle'      => 'folderImg',
				'value'       => 'images/',
				'default'     => 'images/',
				'description' => 'Main folder for uploaded images.'
			],
			[
				'optgroup_id' => 4,
				'name'        => 'Avatars Folder',
				'handle'      => 'folderAvatars',
				'value'       => 'images/avatars/',
				'default'     => 'images/avatars/',
				'description' => 'Folder for uploaded user avatars.'
			]
		];

		foreach ( $optgroups as $seed )
		{
			$optgroup         = new OptGroup;
			$optgroup->name   = $seed['name'];
			$optgroup->handle = $seed['handle'];
			$optgroup->save();
		}

		foreach ( $options as $seed )
		{
			$option              = new Option;
			$option->optgroup_id = $seed['optgroup_id'];
			$option->name        = $seed['name'];
			$option->handle      = $seed['handle'];
			$option->value       = $seed['value'];
			$option->default     = $seed['default'];
			$option->description = $seed['description'];
			$option->save();
		}
	}

}
