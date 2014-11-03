<?php namespace Atorscho\Backend;

use View;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

class SettingController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	public function index()
	{
		$settingsgroups = SettingsGroup::all();

		$title = 'Settings';
		Crumbs::add(route('admin.settings'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Site configurations and options';
		$this->layout->content = View::make('backend::settings.index', compact('settingsgroups'));
	}

}
