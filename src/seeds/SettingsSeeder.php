<?php

use Atorscho\Backend\SettingsGroup;
use Atorscho\Backend\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Setting::truncate();

		$settings_groups = [
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

		$settings = [
			[
				'settings_group_id' => 1,
				'name'              => 'Site Name',
				'handle'            => 'siteName',
				'value'             => 'Verge',
				'default'           => 'Verge',
				'description'       => 'Will be used in "title" tag and headings.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'Slogan',
				'handle'            => 'slogan',
				'value'             => 'Admin',
				'default'           => 'Admin',
				'description'       => 'Some short description of the site.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'Established',
				'handle'            => 'established',
				'value'             => '2014',
				'default'           => '2014',
				'description'       => 'Year the site was established.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'Owner',
				'handle'            => 'owner',
				'value'             => 'Alex Torscho',
				'default'           => 'Alex Torscho',
				'description'       => 'Name of the site creator.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'Copyright',
				'handle'            => 'copyright',
				'value'             => 'All rights reserved',
				'default'           => 'All rights reserved',
				'description'       => 'Your custom copyright text that is displayed in site footer.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'Date Format',
				'handle'            => 'dateFormat',
				'value'             => 'M d Y',
				'default'           => 'M d Y',
				'description'       => 'Specify your prefered date format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'settings_group_id' => 1,
				'name'              => 'DateTime Format',
				'handle'            => 'dateTimeFormat',
				'value'             => 'M d Y, H:i',
				'default'           => 'M d Y, H:i',
				'description'       => 'Specify your prefered datetime format. See <a href="http://php.net/manual/en/function.date.php">PHP Documentation</a>.'
			],
			[
				'settings_group_id' => 2,
				'name'              => 'Default Group',
				'handle'            => 'defaultGroup',
				'value'             => '1',
				'default'           => '1',
				'description'       => 'The default group for new registered users.'
			],
			[
				'settings_group_id' => 3,
				'name'              => 'Title Separator',
				'handle'            => 'titleSep',
				'value'             => ' » ',
				'default'           => ' » ',
				'description'       => 'The separator that is used in "title" tag and headings.'
			],
			[
				'settings_group_id' => 4,
				'name'              => 'Images Folder',
				'handle'            => 'folderImg',
				'value'             => 'images/',
				'default'           => 'images/',
				'description'       => 'Main folder for uploaded images.'
			],
			[
				'settings_group_id' => 4,
				'name'              => 'Avatars Folder',
				'handle'            => 'folderAvatars',
				'value'             => 'images/avatars/',
				'default'           => 'images/avatars/',
				'description'       => 'Folder for uploaded user avatars.'
			]
		];

		foreach ( $settings_groups as $seed )
		{
			$settings_group         = new SettingsGroup;
			$settings_group->name   = $seed['name'];
			$settings_group->handle = $seed['handle'];
			$settings_group->save();
		}

		foreach ( $settings as $seed )
		{
			$setting                    = new Setting;
			$setting->settings_group_id = $seed['settings_group_id'];
			$setting->name              = $seed['name'];
			$setting->handle            = $seed['handle'];
			$setting->value             = $seed['value'];
			$setting->default           = $seed['default'];
			$setting->description       = $seed['description'];
			$setting->save();
		}
	}

}
