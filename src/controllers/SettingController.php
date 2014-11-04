<?php namespace Atorscho\Backend;

use Atorscho\Backend\Models\SettingsGroup;
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
		foreach ( Input::all as $input )
		{

		}
	}

}
