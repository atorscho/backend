<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Setting;
use Atorscho\Backend\Models\SettingsGroup;
use Backend;
use Redirect;
use View;
use Input;
use Atorscho\Crumbs\Facades\Crumbs;

// todo - translate

class EcommerceController extends BaseController {

	public function index()
	{
		Backend::extension('name');
	}

}
