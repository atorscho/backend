<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\TaxonomyType;
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
		$users     = User::orderBy('id', 'desc')->take(5)->get();
		$userCount = User::all()->count();

		// Default Content & Taxonomy Types
		$category = TaxonomyType::findSlug('categories');
		$article = ContentType::findSlug('articles', 'contents');
		$page    = ContentType::findSlug('pages', 'contents');
		$latestArticles = $article->contents()->orderBy('id', 'desc')->take(5)->get();
		$latestPages = $page->contents()->orderBy('id', 'desc')->take(5)->get();

		$this->layout->title   = trans('backend::labels.dashboardHome');
		$this->layout->desc    = trans('backend::labels.adminCP');
		$this->layout->content = View::make('backend::admin.index', compact('users', 'userCount', 'category', 'article', 'page', 'latestArticles', 'latestPages'));
	}

	public function login()
	{
		// Change master layout to authentication layout
		$this->layout = View::make('backend::layouts.auth');

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

		Flash::success('loggedOut');

		return Redirect::route('admin.login');
	}

	// todo - Possibility to change the locale
	public function lang( $locale = null )
	{
		Session::put('lang', $locale);

		Flash::success('langSwitched', [ 'lang' => trans("backend::locales.$locale") ]);

		return Redirect::route('admin.login');

	}

}
