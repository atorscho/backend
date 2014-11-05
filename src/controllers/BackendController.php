<?php namespace Atorscho\Backend;

use Auth;
use View;

// todo - translate

class BackendController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	public function index()
	{
		$this->layout->title   = 'Backend Dashboard';
		$this->layout->desc    = 'Admin Cotrol Panel';
		$this->layout->content = View::make('backend::admin.index');
	}

	public function login()
	{
		$this->layout          = 'backend::layouts.auth';
		$this->layout->title   = 'Backend Dashboard';
		$this->layout->desc    = 'Admin Cotrol Panel';
		$this->layout->content = View::make('backend::admin.llogin');
	}

	public function logout()
	{
		Auth::logout();
	}

}
