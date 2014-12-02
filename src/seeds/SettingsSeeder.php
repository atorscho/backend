<?php namespace Atorscho\Backend\Seeds;

use Atorscho\Backend\Models\SettingsGroup;
use Atorscho\Backend\Models\Setting;
use DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Setting::truncate();
		SettingsGroup::truncate();

		\Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$groups = [
			[
				'name'     => 'General Settings',
				'handle'   => 'general',
				'settings' => [
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
						'name' => 'Site Front',
						'handle' => 'siteFront',
						'value' => '/',
						'default' => '/',
						'description' => 'URL to the front page of your site.'
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
					]
				]
			],
			[
				'name'     => 'User Settings',
				'handle'   => 'users',
				'settings' => [
					[
						'name'        => 'Default Group',
						'handle'      => 'defaultGroup',
						'value'       => '1',
						'default'     => '1',
						'description' => 'The default group for new registered users.'
					],
					[
						'name'        => 'Users Per Page',
						'handle'      => 'usersPerPage',
						'value'       => '10',
						'default'     => '10',
						'description' => 'How many users to show on index page.'
					]
				]
			],
			[
				'name'     => 'Template Settings',
				'handle'   => 'template',
				'settings' => [
					[
						'name'        => 'Title Separator',
						'handle'      => 'titleSep',
						'value'       => ' » ',
						'default'     => ' » ',
						'description' => 'The separator that is used in "title" tag and headings.'
					],
					[
						'name'        => 'Breadcrumbs Home',
						'handle'      => 'crumbsHome',
						'value'       => 'Dashboard',
						'default'     => 'Dashboard',
						'description' => 'Title of the first item in breadcrumbs.'
					]
				]
			],
			[
				'name'     => 'File System',
				'handle'   => 'files',
				'settings' => [
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
				]
			]
		];

		foreach ( $groups as $seedGroup )
		{
			$settingsGroup = SettingsGroup::create([
				'name'   => $seedGroup['name'],
				'handle' => $seedGroup['handle']
			]);

			foreach ( $seedGroup['settings'] as $seedSetting )
			{
				$setting = Setting::create([
					'group_id'    => $settingsGroup->id,
					'name'        => $seedSetting['name'],
					'handle'      => $seedSetting['handle'],
					'value'       => $seedSetting['value'],
					'default'     => $seedSetting['default'],
					'description' => $seedSetting['description']
				]);
			}
		}
	}

}
