<?php namespace Atorscho\Backend;

use View;

class BackendController extends BaseController {

	protected $layout = 'backend::layouts.master';

	public function index()
	{
		$this->layout->content = View::make('backend::admin.index');
	}

}
