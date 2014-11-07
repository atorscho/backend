<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\User;
use Atorscho\Crumbs\Facades\Crumbs;
use View;

// todo - translate

class GroupController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	/**
	 * Display a listing of the resource.
	 * GET /group
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'User Management';
		$perPage = getSetting('usersPerPage');
		$users = User::with('groups')->paginate($perPage);

		Crumbs::add(route('admin.users.index'), $title);

		$this->layout->title = $title;
		$this->layout->desc  = 'List of all users and their info';
		$this->layout->content = View::make('backend::users.index', compact('users', 'perPage'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /group/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /group
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /group/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /group/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /group/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /group/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
