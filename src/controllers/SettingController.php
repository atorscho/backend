<?php namespace Atorscho\Backend\Controllers;

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
		$title = 'Settings';

		Crumbs::addRoute('admin.settings.index', $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Site configurations and options';
		$this->layout->content = View::make('backend::settings.index', compact('groups'));
	}

	public function show( SettingsGroup $group )
	{
		$group = $group->with('settings')->find($group->id);
		$title = $group->name;

		Crumbs::addRoute('admin.settings.index', 'Settings');
		Crumbs::addRoute('admin.settings.show', $title, $group->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::settings.show', compact('group'));
	}

	public function update()
	{
		foreach ( Setting::all() as $setting )
		{
			if ( $setting->value != Input::get($setting->handle) )
			{
				$setting->value = Input::get($setting->handle);
				$setting->save();
			}
		}

		return Redirect::back()->with('success', 'Updated');
	}

}
