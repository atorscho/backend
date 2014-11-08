<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;
use Atorscho\Crumbs\Facades\Crumbs;
use Hash;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

// todo - CREATE PHPUNIT TESTS!!!!!!!!!

class UserController extends BaseController {

	protected $layout = 'backend::layouts.backend';

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
		$perPage = 10;
		$users   = User::with('groups')->paginate($perPage);

		Crumbs::add(route('admin.users.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'List of all users and their info';
		$this->layout->content = View::make('backend::users.index', compact('users', 'perPage'));
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
		$groups = array_pluck(Group::all(), 'name', 'id');
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
		$validator = Validator::make(Input::all(), [
			'username'   => 'required|max:20|unique:users',
			'email'      => 'required|email|max:40|unique:users',
			'password'   => 'required|confirmed',
			'birthday'   => 'date',
			'gender'     => 'in:N,M,F',
			'groups'     => 'required',
			'registered' => 'date'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user = User::create(Input::except('groups'));
		$user->groups()->sync(Input::get('groups'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::back()->with('success', 'User has been created.');
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
		$groups = array_pluck(Group::all(), 'name', 'id');

		$gender = [
			'N' => 'Unknown',
			'M' => 'Male',
			'F' => 'Female'
		];

		Crumbs::add(route('admin.users.index'), 'User Management');
		Crumbs::add(route('admin.users.show', $user->username), $user->username);
		Crumbs::add(route('admin.users.edit', $user->id), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.edit', compact('user', 'groups', 'gender'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update( $id )
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy( $id )
	{
		//
	}


}
