<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

class GroupController extends BaseController {

	protected $rules = [
		'name'        => 'required|max:20',
		'handle'      => 'max:20',
		'permissions' => 'required'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		// Form Field Names
		$this->ruleFields = [
			'name'        => trans('backend::labels.name'),
			'handle'      => trans('backend::labels.handle'),
			'permissions' => trans('backend::labels.permissions')
		];

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
		$groups          = Group::all();
		$protectedGroups = [
			1,
			2,
			3,
			4,
			5,
			getSetting('defaultGroup')
		];

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.groups.index', trans('backend::labels.groups'));

		$this->layout->title   = trans('backend::labels.groupsManagement');
		$this->layout->desc    = trans('backend::labels.groupsDesc');
		$this->layout->content = View::make('backend::users.groups.index', compact('groups', 'protectedGroups'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /group/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = trans('backend::labels.groupsNew');

		$permissions = Permission::lists('name', 'id');

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.groups.create', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.groups.create', compact('permissions'));
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
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$group = Group::create(Input::except('permissions'));
		$group->permissions()->sync(Input::get('permissions'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.groups.create')->with('success', trans('backend::messages.groupCreated'));
		else
			return Redirect::route('admin.users.groups.index')->with('success', trans('backend::messages.groupCreated'));
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
		$groupUsers = Group::with('users')->find($group->id)->users()->orderBy('username')->get();

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.groups.show', $group->name, $group->id);

		$this->layout->title   = trans('backend::labels.groupsName', ['name' => $group->name]);
		$this->layout->content = View::make('backend::users.groups.show', compact('group', 'groupUsers'));
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
		// Get an array of permissions: id such as a key, permission name such as a key value
		$permissions = Permission::lists('name', 'id');
		// Populate the selectbox
		$groupperms = $group->permissions()->lists('id');

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.groups.show', $group->name, $group->id);
		Crumbs::addRoute('admin.users.groups.edit', trans('backend::labels.edit'), $group->id);

		$this->layout->title   = trans('backend::labels.groupsEditName', ['name' => $group->name]);
		$this->layout->content = View::make('backend::users.groups.edit', compact('group', 'permissions', 'groupperms'));
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
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$group->name   = Input::get('name');
		$group->handle = Input::get('handle');
		$group->prefix = Input::get('prefix');
		$group->suffix = Input::get('suffix');
		$group->save();
		$group->permissions()->sync(Input::get('permissions'));

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.groups.create')->with('success', trans('backend::messages.groupUpdated'));
		else
			return Redirect::route('admin.users.groups.index')->with('success', trans('backend::messages.groupUpdated'));
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

		return Redirect::route('admin.users.groups.index')->with('success', trans('backend::messages.groupDeleted'));
	}

}
