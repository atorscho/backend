<?php namespace Atorscho\Backend\Controllers;

use Backend;
use Config;
use Controller;
use View;
use Atorscho\Backend\Models\Setting;

class BaseController extends Controller {

	protected $layout = 'backend::layouts.backend';

	public function __construct()
	{
		$navmenu = [
			[
				'title' => trans('backend::labels.dashboard'),
				'route' => 'admin.index',
				'param' => null,
				'group' => '',
				'perm'  => ''
			],
			[
				'title' => trans('backend::labels.users'),
				'route' => 'admin.users.index',
				'param' => null,
				'perm'  => 'showUsers'
			],
			[
				'title' => trans('backend::labels.articles'),
				'route' => 'admin.content-types.show',
				'param' => 'articles'
			],
			[
				'title' => trans('backend::labels.pages'),
				'route' => 'admin.content-types.show',
				'param' => 'pages'
			],
			[
				'title' => trans('backend::labels.categories'),
				'route' => 'admin.taxonomy-types.show',
				'param' => 'categories'
			]
		];

		View::share('navmenu', toObjects($navmenu));
		View::share('template', toObjects(Config::get('backend::template')));
		View::share('settings', toObjects(Setting::lists('value', 'handle')));
		View::share('extensions', Backend::getExtensions());
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
