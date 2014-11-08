<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Permission;
use Atorscho\Crumbs\Facades\Crumbs;
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

	/**
	 * Display a listing of the resource.
	 * GET /group
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Group Management';

		$groups = Group::all();

		Crumbs::add(route('admin.groups.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'All user groups, their members and permissions';
		$this->layout->content = View::make('backend::groups.index', compact('groups'));
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
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show( $id )
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /group/{id}/edit
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
	 * PUT /group/{id}
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
	 * DELETE /group/{id}
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
