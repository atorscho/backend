<?php namespace Atorscho\Backend;

use Auth;
use Input;
use Redirect;
use Validator;
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
		$this->layout          = View::make('backend::layouts.auth');
		$this->layout->title   = 'Login';
		$this->layout->content = View::make('backend::admin.login');
	}

	public function loginPost()
	{
		$validator = Validator::make(Input::all(), [
			'username' => 'required',
			'password' => 'required'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		if ( Auth::attempt(Input::only('username', 'password')) )
			return Redirect::route('admin.index')->with('success', 'Logged in successfully.');
		else
			return Redirect::back()->with('danger', 'Username with such credentials does not exist.');
	}

	public function logout()
	{
		Auth::logout();
	}

}
