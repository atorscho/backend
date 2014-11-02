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

		$options = new \stdClass;
		foreach ( Option::all() as $option )
			$options->{$option->handle} = $option->value;

		View::share('navmenu', toObjects($navmenu));
		View::share('template', toObjects(Config::get('backend::template')));
		View::share('options', $options);
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
