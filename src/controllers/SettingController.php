<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Setting;
use Atorscho\Backend\Models\SettingsGroup;
use Redirect;
use View;
use Input;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

class SettingController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	public function index()
	{
		$groups = SettingsGroup::with('settings')->get();
		$title = 'Settings';

		Crumbs::add(route('admin.settings'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Site configurations and options';
		$this->layout->content = View::make('backend::settings.index', compact('groups'));
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

		return Redirect::route('admin.settings')->with('success', 'Updated');
	}

}
