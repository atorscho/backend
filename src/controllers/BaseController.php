<?php namespace Atorscho\Backend\Controllers;

use Config;
use Controller;
use View;
use Atorscho\Backend\Models\Setting;

class BaseController extends Controller {

	protected $layout = 'backend::layouts.backend';

	public function __construct()
	{
		// CSRF Protection
		$this->beforeFilter('csrf', [ 'on' => 'post' ]);

		// todo - translate
		$navmenu = [
			[
				'title' => 'Dashboard',
				'route' => 'admin.index',
				'group' => '',
				'perm'  => ''
			]
		];

		View::share('navmenu', toObjects($navmenu));
		View::share('template', toObjects(Config::get('backend::template')));
		View::share('settings', toObjects(Setting::lists('value', 'handle')));
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
