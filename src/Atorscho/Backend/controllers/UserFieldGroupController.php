<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Validator;
use View;

class UserFieldGroupController extends BaseController {

	protected $rules = [
		'name'   => 'required',
		'handle' => 'unique:user_field_groups'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		// Form Fields Names
		$this->ruleFields = [
			'name'   => trans('backend::labels.name'),
			'handle' => trans('backend::labels.handle')
		];

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
		$fieldGroups = UserFieldGroup::orderBy('order')->get();

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::addRoute('admin.users.fields.groups.index', trans('backend::labels.groups'));

		$this->layout->title   = trans('backend::labels.userFieldGroups');
		$this->layout->desc    = trans('backend::labels.userFieldGroupsDesc');
		$this->layout->content = View::make('backend::users.fields.groups.index', compact('fieldGroups'));
	}

	public function create()
	{
		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::addRoute('admin.users.fields.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.fields.groups.create', trans('backend::labels.groupsNew'));

		$this->layout->title   = trans('backend::labels.userFieldGroupsNew');
		$this->layout->content = View::make('backend::users.fields.groups.create');
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		UserFieldGroup::create(Input::all());

		Flash::success('userFieldGroupCreated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.groups.create');
		else
			return Redirect::route('admin.users.fields.groups.index');
	}

	public function show( UserFieldGroup $fieldGroup )
	{
		// Eager-loading
		$fieldGroup = $fieldGroup->with('fields')->find($fieldGroup->id);

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::addRoute('admin.users.fields.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.fields.groups.show', $fieldGroup->name, $fieldGroup->id);

		$this->layout->title   = trans('backend::labels.userFieldGroupsName', [ 'name' => $fieldGroup->name ]);
		$this->layout->content = View::make('backend::users.fields.groups.show', compact('fieldGroup'));
	}

	public function edit( UserFieldGroup $fieldGroup )
	{
		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::addRoute('admin.users.fields.groups.index', trans('backend::labels.groups'));
		Crumbs::addRoute('admin.users.fields.groups.show', $fieldGroup->name, $fieldGroup->id);
		Crumbs::addRoute('admin.users.fields.groups.edit', trans('backend::labels.edit'), $fieldGroup->id);

		$this->layout->title   = trans('backend::labels.userFieldGroupsEditName', [ 'name' => $fieldGroup->name ]);
		$this->layout->content = View::make('backend::users.fields.groups.edit', compact('fieldGroup'));
	}

	public function update( UserFieldGroup $fieldGroup )
	{
		$rules = $this->rules;
		$rules['handle'] .= ',handle,' . $fieldGroup->id;

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$fieldGroup->fill(Input::all());
		$fieldGroup->save();

		Flash::success('userFieldGroupUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.groups.create');
		else
			return Redirect::route('admin.users.fields.groups.show', $fieldGroup->id);
	}

	public function destroy( UserFieldGroup $fieldGroup )
	{
		$fieldGroup->delete();

		Flash::success('userFieldGroupDeleted');

		return Redirect::route('admin.users.fields.groups.index');
	}

}
