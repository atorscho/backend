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

	protected $rules = [
		'name' => 'required'
	];

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

	public function create()
	{
		$title = 'New Field Group';

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Field Groups');
		Crumbs::add(route('admin.users.fields.groups.create'), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.fields.groups.create');
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);

		if($validator->fails())
			return Redirect::back()->withErrors($validator)->withInput();

		UserFieldGroup::create(Input::all());

		return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group created.');
	}

	public function show(UserFieldGroup $fieldGroup)
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
