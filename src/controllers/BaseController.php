<?php namespace Atorscho\Backend;

use Config;
use Controller;
use View;

class BaseController extends Controller {

	public function __construct()
	{
		// todo - translate
		$navmenu = [
			[
				'title' => 'Dashboard',
				'route' => 'admin.index',
				'group' => '',
				'perm'  => ''
			]
		];

		$settings = new \stdClass;
		foreach ( Setting::all() as $setting )
			$settings->{$setting->handle} = $setting->value;

		View::share('navmenu', toObjects($navmenu));
		View::share('template', toObjects(Config::get('backend::template')));
		View::share('settings', $settings);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( !is_null($this->layout) )
		{
			$this->layout = View::make($this->layout);
		}
	}

}
