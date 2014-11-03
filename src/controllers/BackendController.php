<?php namespace Atorscho\Backend;

use View;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

class BackendController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	public function index()
	{
		$this->layout->title   = 'Backend Dashboard';
		$this->layout->desc    = 'Admin Cotrol Panel';
		$this->layout->content = View::make('backend::admin.index');
	}

}
