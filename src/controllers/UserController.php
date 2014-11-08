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
		$title  = 'New User';

		// Get an array of groups: id such as a key, group name such as a key value
		$groups = array_pluck(Group::all(), 'name', 'id');
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
			'username'   => 'required|max:20',
			'email'      => 'required|email|max:40',
			'password'   => 'required|confirmed',
			'birthday'   => 'date',
			'gender'     => 'in:N,M,F',
			'registered' => 'date'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user = new User;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit( $id )
	{
		//
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
