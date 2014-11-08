<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;
use Atorscho\Crumbs\Facades\Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

// todo - CREATE PHPUNIT TESTS!!!!!!!!!
// todo - forgotten password

class UserController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	protected $rules = [
		'birthday'   => 'date',
		'gender'     => 'in:N,M,F',
		'groups'     => 'required',
		'registered' => 'date'
	];

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('csrf', [ 'on' => 'post' ]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title   = 'User Management';
		$users   = User::with('groups')->paginate((int) getSetting('usersPerPage'));

		Crumbs::add(route('admin.users.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'List of all users and their info';
		$this->layout->content = View::make('backend::users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'New User';

		// Get an array of groups: id such as a key, group name such as a key value
		$groups = Group::lists('name', 'id');
		// Remove Super-Administrators from the array
		unset( $groups[5] );

		$gender = [
			'N' => 'Unknown',
			'M' => 'Male',
			'F' => 'Female'
		];

		Crumbs::add(route('admin.users.index'), 'User Management');
		Crumbs::add(route('admin.users.create'), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.create', compact('groups', 'gender'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules             = $this->rules;
		$rules['username'] = 'required|max:20|unique:users';
		$rules['email']    = 'required|email|max:40|unique:users';
		$rules['password'] = 'required|confirmed';

		$validator = Validator::make(Input::all(), $rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user = User::create(Input::except('groups'));
		$user->groups()->sync(Input::get('groups'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.create')->with('success', 'User has been created.');
		else
			return Redirect::route('admin.users.index')->with('success', 'User has been created.');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User $user
	 *
	 * @return User
	 */
	public function edit( User $user )
	{
		$title = 'Edit';

		// Get an array of groups: id such as a key, group name such as a key value
		$groups     = Group::lists('name', 'id');
		$usergroups = $user->groups()->lists('id');

		$gender = [
			'N' => 'Unknown',
			'M' => 'Male',
			'F' => 'Female'
		];

		Crumbs::add(route('admin.users.index'), 'User Management');
		Crumbs::add(route('admin.users.show', $user->username), $user->username);
		Crumbs::add(route('admin.users.edit', $user->id), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.edit', compact('user', 'groups', 'usergroups', 'gender'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  User $user
	 *
	 * @return Response
	 */
	public function update( User $user )
	{
		$rules = $this->rules;
		if ( Input::has('password') )
			$rules['password'] = 'confirmed';
		$validator = Validator::make(Input::all(), $rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		if ( Input::has('password') )
			$user->password = Input::get('password');
		$user->first_name = Input::get('first_name');
		$user->last_name  = Input::get('last_name');
		if ( Input::has('birthday') )
			$user->birthday = Input::get('birthday');
		$user->gender     = Input::get('gender');
		$user->created_at = Input::get('created_at');
		$user->save();
		$user->groups()->sync(Input::get('groups'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.create')->with('success', 'User has been created.');
		else
			return Redirect::route('admin.users.index')->with('success', 'User has been updated.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  User $user
	 *
	 * @return Response
	 */
	public function destroy( User $user )
	{
		$user->delete();

		return Redirect::route('admin.users.index')->with('success', 'User has been deactivated.');
	}


}
