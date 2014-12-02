<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\User;
use Auth;
use Input;
use LaravelGettext;
use Redirect;
use Validator;
use View;

// todo - translate

class BackendController extends BaseController {

	public function index()
	{
		$users     = User::orderBy('id', 'desc')->take(5)->get();
		$userCount = User::all()->count();

		$this->layout->title   = 'Backend Dashboard';
		$this->layout->desc    = 'Admin Control Panel';
		$this->layout->content = View::make('backend::admin.index', compact('users', 'userCount'));
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
			'password' => 'required',
			'remember' => 'boolean'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		if ( Auth::attempt(Input::only('username', 'password'), (bool) Input::get('remember', false)) )
			return Redirect::route('admin.index')->with('success', 'Logged in successfully.');
		else
			return Redirect::back()->with('danger', 'Username with such credentials does not exist.');
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::route('admin.login');
	}

	public function lang( $locale = null )
	{
		LaravelGettext::setLocale($locale);

		return Redirect::to('/admin');

	}

}
