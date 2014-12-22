<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Permission;
use Crumbs;
use View;

// todo - translate

class PermissionController extends BaseController {

	public function __construct()
	{
		parent::__construct();

		// Access Filters
		$this->beforeFilter('admin.perm:showPermissions', ['only' => 'index']);
	}

	/**
	 * Display a listing of the resource.
	 * GET /permissions
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Permissions';

		$permissions = Permission::all();

		Crumbs::addRoute('admin.users.index', 'Users');
		Crumbs::addRoute('admin.users.permissions.index', $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Group permissions';
		$this->layout->content = View::make('backend::users.permissions.index', compact('permissions'));
	}

}
