<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

class GroupController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	protected $rules = [
		'name'        => 'required|max:20',
		'handle'      => 'max:20',
		'permissions' => 'required'
	];

	public function __construct()
	{
		parent::__construct();

		// Access Filters
		$this->beforeFilter('admin.perm:showGroups', [
			'only' => [
				'index',
				'show'
			]
		]);
		$this->beforeFilter('admin.perm:createGroups', [
			'only' => [
				'create',
				'store'
			]
		]);
		$this->beforeFilter('admin.perm:editGroups', [
			'only' => [
				'edit',
				'update'
			]
		]);
		$this->beforeFilter('admin.perm:deleteGroups', [ 'only' => [ 'destroy' ] ]);
	}

	/**
	 * Display a listing of the resource.
	 * GET /group
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Group Management';

		$groups          = Group::all();
		$protectedGroups = [
			1,
			2,
			3,
			4,
			5,
			getSetting('defaultGroup')
		];

		Crumbs::add(route('admin.groups.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'All user groups, their members and permissions';
		$this->layout->content = View::make('backend::groups.index', compact('groups', 'protectedGroups'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /group/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'New Group';

		$permissions = Permission::lists('name', 'id');

		Crumbs::add(route('admin.groups.index'), 'Group Management');
		Crumbs::add(route('admin.groups.create'), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::groups.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /group
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$group = Group::create(Input::except('permissions'));
		$group->permissions()->sync(Input::get('permissions'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.groups.create')->with('success', 'Group has been created.');
		else
			return Redirect::route('admin.groups.index')->with('success', 'Group has been created.');
	}

	/**
	 * Display the specified resource.
	 * GET /group/{id}
	 *
	 * @param  Group $group
	 *
	 * @return Response
	 */
	public function show( Group $group )
	{
		$title = $group->name;
		$groupUsers = Group::with('users')->find($group->id)->users()->orderBy('username')->get();

		Crumbs::add(route('admin.groups.index'), 'Group Management');
		Crumbs::add(route('admin.groups.show', $group->id), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::groups.show', compact('group', 'groupUsers'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /group/{id}/edit
	 *
	 * @param  Group $group
	 *
	 * @return Response
	 */
	public function edit( Group $group )
	{
		$title = 'Edit ' . $group->name;

		// Get an array of permissions: id such as a key, permission name such as a key value
		$permissions = Permission::lists('name', 'id');
		// Populate the selectbox
		$groupperms = $group->permissions()->lists('id');

		Crumbs::add(route('admin.groups.index'), 'Group Management');
		Crumbs::add(route('admin.groups.show', $group->id), $group->name);
		Crumbs::add(route('admin.groups.edit', $group->id), 'Edit');

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::groups.edit', compact('group', 'permissions', 'groupperms'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /group/{id}
	 *
	 * @param  Group $group
	 *
	 * @return Response
	 */
	public function update( Group $group )
	{
		$validator = Validator::make(Input::all(), $this->rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$group->name   = Input::get('name');
		$group->handle = Input::get('handle');
		$group->prefix = Input::get('prefix');
		$group->suffix = Input::get('suffix');
		$group->save();
		$group->permissions()->sync(Input::get('permissions'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.groups.create')->with('success', 'Group has been created.');
		else
			return Redirect::route('admin.groups.index')->with('success', 'Group has been updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /group/{id}
	 *
	 * @param  Group $group
	 *
	 * @return Response
	 */
	public function destroy( Group $group )
	{
		// Add all group's users to the default group
		foreach ( $group->users as $user )
		{
			// Apply this to the users that are only in one group
			if ( $user->groups->count() == 1 )
				$user->groups()->sync([ getSetting('defaultGroup') => getSetting('defaultGroup') ]);
		}

		// Now delete that group
		$group->delete();

		return Redirect::route('admin.groups.index')->with('success', 'Group has been deleted.');
	}

}
