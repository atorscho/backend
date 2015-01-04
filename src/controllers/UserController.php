<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;
use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - forgotten password

// todo - let add to user his own permissions

// todo - Avatar

// todo - improve eager loadings

class UserController extends BaseController {

	protected $rules = [
		'username'   => 'required|max:20|unique:users',
		'birthday'   => 'date',
		'gender'     => 'in:N,M,F',
		'groups'     => 'required',
		'registered' => 'date'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		$this->ruleFields = [
			'username'   => trans('backend::labels.username'),
			'email'      => trans('backend::labels.email'),
			'password'   => trans('backend::labels.password'),
			'first_name' => trans('backend::labels.firstName'),
			'last_name'  => trans('backend::labels.lastName'),
			'birthday'   => trans('backend::labels.birthday'),
			'gender'     => trans('backend::labels.gender'),
			'created_at' => trans('backend::labels.registered'),
			'groups'     => trans('backend::labels.groups')
		];

		// Access Filters
		$this->beforeFilter('admin.perm:showUsers', [
			'only' => [
				'index',
				'show'
			]
		]);
		$this->beforeFilter('admin.perm:createUsers', [
			'only' => [
				'create',
				'store'
			]
		]);
		$this->beforeFilter('admin.perm:editUsers', [
			'only' => [
				'edit',
				'update'
			]
		]);
		$this->beforeFilter('admin.perm:deleteUsers', [ 'only' => [ 'destroy' ] ]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$perPage = Input::get('perPage', 10);

		$users = User::with('groups')->paginate($perPage);

		$counter = counter($perPage);

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));

		$this->layout->title   = trans('backend::labels.usersManagement');
		$this->layout->desc    = trans('backend::labels.usersDesc');
		$this->layout->content = View::make('backend::users.index', compact('users', 'counter'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = trans('backend::labels.usersNew');

		// Get an array of groups: id such as a key, group name such as a key value
		$groups = Group::lists('name', 'id');
		// Remove Super-Administrators from the array
		unset( $groups[5] );

		$fieldGroups = UserFieldGroup::with('fields')->get();

		$gender = [
			'N' => trans('backend::labels.genderUnknown'),
			'M' => trans('backend::labels.genderMale'),
			'F' => trans('backend::labels.genderFemale')
		];

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.create', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.create', compact('groups', 'gender', 'fieldGroups'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules             = $this->rules;
		$rules['email']    = 'required|email|max:40|unique:users';
		$rules['password'] = 'required|confirmed';

		// Setting up custom fields rules
		$fieldsUpdate = Input::get('fields');
		$ruleFields  = $this->ruleFields;
		$fieldsUpdate = saveUserField($rules, $ruleFields, $fieldsUpdate);

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user = User::create(Input::except('groups'));
		$user->groups()->sync(Input::get('groups'));

		// Synchronize custom user fields
		$user->fields()->sync($fieldsUpdate);

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.create')->with('success', trans('backend::labels.userCreated'));
		else
			return Redirect::route('admin.users.index')->with('success', trans('backend::labels.userCreated'));
	}


	public function show( User $user )
	{
		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.show', $user->username, $user->id);

		$this->layout->title   = trans('backend::labels.usersName', [ 'name' => $user->username ]);
		$this->layout->content = View::make('backend::users.show', compact('user'));
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
		// Eager-loading
		$user = $user->with('fields')->find($user->id);

		// Get an array of groups: id such as a key, group name such as a key value
		$groups      = Group::lists('name', 'id');
		$usergroups  = $user->groups()->lists('id');
		$fieldGroups = UserFieldGroup::with('fields')->get();

		$gender = [
			'N' => trans('backend::labels.genderUnknown'),
			'M' => trans('backend::labels.genderMale'),
			'F' => trans('backend::labels.genderFemale')
		];

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.show', $user->username, $user->id);
		Crumbs::addRoute('admin.users.edit', trans('backend::labels.edit'), $user->id);

		$this->layout->title   = trans('backend::labels.usersEditName', [ 'name' => $user->username ]);
		$this->layout->content = View::make('backend::users.edit', compact('user', 'groups', 'usergroups', 'gender', 'fieldGroups'));
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
		$rules['username'] .= ',username,' . $user->id;
		if ( Input::has('password') )
			$rules['password'] = 'confirmed';

		// Setting up custom fields rules
		$fieldsUpdate = Input::get('fields');
		$ruleFields  = $this->ruleFields;
		$fieldsUpdate = saveUserField($rules, $ruleFields, $fieldsUpdate);

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user->username = Input::get('username');
		if ( Input::has('password') )
			$user->password = Input::get('password');
		$user->first_name = Input::get('first_name');
		$user->last_name  = Input::get('last_name');
		$user->birthday   = Input::get('birthday');
		$user->gender     = Input::get('gender');
		$user->created_at = Input::get('created_at');
		$user->save();
		$user->groups()->sync(Input::get('groups'));

		// Synchronize custom user fields
		$user->fields()->sync($fieldsUpdate);

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.create')->with('success', trans('backend::messages.userUpdated'));
		else
			return Redirect::route('admin.users.show', $user->id)->with('success', trans('backend::messages.userUpdated'));
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
		if ( $user->id != 1 )
			$user->delete();

		return Redirect::route('admin.users.index')->with('success', trans('backend::messages.userDeactivated'));
	}


}
