<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

class UserFieldGroupController extends BaseController {

	protected $layout = 'backend::layouts.backend';

	public function __construct()
	{
		parent::__construct();

		// Access Filters
		$this->beforeFilter('admin.perm:showFields', [
			'only' => [
				'index',
				'show'
			]
		]);
		$this->beforeFilter('admin.perm:createFields', [
			'only' => [
				'create',
				'store'
			]
		]);
		$this->beforeFilter('admin.perm:editFields', [
			'only' => [
				'edit',
				'update'
			]
		]);
		$this->beforeFilter('admin.perm:deleteFields', [ 'only' => [ 'destroy' ] ]);
	}

	public function index()
	{
		$title = 'Field Groups';

		$fieldGroups = UserFieldGroup::all();

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Manage User Field Groups';
		$this->layout->content = View::make('backend::users.fields.groups.index', compact('fieldGroups'));
	}

	public function show()
	{
		$title = 'Field Groups';

		$fieldGroups = UserFieldGroup::all();

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'Manage User Field Groups';
		$this->layout->content = View::make('backend::users.fields.groups.index', compact('fieldGroups'));
	}

}
