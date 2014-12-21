<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Setting;
use Atorscho\Backend\Models\SettingsGroup;
use Backend;
use Redirect;
use View;
use Input;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

// todo - add extension manager to settings page

class EcommerceController extends BaseController {

	public function index()
	{
		$this->layout->title = 'Ecommerce';
		$this->layout->content = View::make('backend::ecommerce.index');
	}

}
