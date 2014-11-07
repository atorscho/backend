<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\User;
use Atorscho\Crumbs\Facades\Crumbs;
use View;

// todo - translate

class UserController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'User Management';
		$perPage = 10;
		$users = User::with('groups')->paginate($perPage);

		Crumbs::add(route('admin.users.index'), $title);

		$this->layout->title = $title;
		$this->layout->desc  = 'List of all users and their info';
		$this->layout->content = View::make('backend::users.index', compact('users', 'perPage'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
