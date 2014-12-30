<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\User;
use Auth;
use Flash;
use Input;
use LaravelGettext;
use Redirect;
use Session;
use Validator;
use View;

class BackendController extends BaseController {

	public function index()
	{
		\Flash::success('loggedIn');

		$users     = User::orderBy('id', 'desc')->take(5)->get();
		$userCount = User::all()->count();

		$this->layout->title   = trans('backend::labels.dashboardHome');
		$this->layout->desc    = trans('backend::labels.adminCP');
		$this->layout->content = View::make('backend::admin.index', compact('users', 'userCount'));
	}

	public function login()
	{
		$this->layout          = View::make('backend::layouts.auth');

		$this->layout->title   = trans('backend::labels.login');
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
		{
			Flash::success('loggedIn');

			return Redirect::route('admin.index');
		}
		else
		{
			Flash::danger('userNotFound');

			return Redirect::back()->withInput();
		}
	}

	public function logout()
	{
		Auth::logout();

		// todo - bug with flash messages
		Flash::success('loggedOut');

		return Redirect::route('admin.login');
	}

	public function lang( $locale = null )
	{
		Session::put('lang', $locale);

		return Redirect::route('admin.login');

	}

}
