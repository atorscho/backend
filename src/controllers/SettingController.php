<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Setting;
use Atorscho\Backend\Models\SettingsGroup;
use Redirect;
use View;
use Input;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

class SettingController extends BaseController {

	public function index()
	{
		$groups = SettingsGroup::with('settings')->get();
		$title  = 'Settings';

		Crumbs::addRoute('admin.settings.index', $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Site configurations and options';
		$this->layout->content = View::make('backend::settings.index', compact('groups'));
	}

	public function show( SettingsGroup $group )
	{
		$setting = new Setting;
		$group   = $group->with('settings')->find($group->id);
		$title   = $group->name;

		// User Groups except Super-Admins
		$userGroups = Group::lists('name', 'id');
		unset( $userGroups[5] );

		Crumbs::addRoute('admin.settings.index', 'Settings');
		Crumbs::addRoute('admin.settings.show', $title, $group->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::settings.show', compact('group', 'setting', 'userGroups'));
	}

	public function update()
	{
		foreach ( Input::get('settings') as $handle => $value )
		{
			$setting        = Setting::where('handle', $handle)->first();
			$setting->value = $value;
			$setting->save();
		}

		return Redirect::back()->with('success', 'Updated');
	}

}
