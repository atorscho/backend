<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

// todo - add order to field groups and to fields

// todo - save or save & new

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
		$validator = Validator::make(Input::all(), [
			'name' => 'required',
			'handle' => 'unique:user_field_groups'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		UserFieldGroup::create(Input::all());

		return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group created.');
	}

	public function show( UserFieldGroup $fieldGroup )
	{
		// Eager-loading
		$fieldGroup = $fieldGroup->with('fields')->find($fieldGroup->id);

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Field Groups');
		Crumbs::add(route('admin.users.fields.groups.show', $fieldGroup->id), $fieldGroup->name);

		$this->layout->title   = 'Field Group: ' . $fieldGroup->name;
		$this->layout->content = View::make('backend::users.fields.groups.show', compact('fieldGroup'));
	}

	public function edit( UserFieldGroup $fieldGroup )
	{
		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Field Groups');
		Crumbs::add(route('admin.users.fields.groups.show', $fieldGroup->id), $fieldGroup->name);
		Crumbs::add(route('admin.users.fields.groups.edit', $fieldGroup->id), 'Edit');

		$this->layout->title   = 'Edit Field Group: ' . $fieldGroup->name;
		$this->layout->content = View::make('backend::users.fields.groups.edit', compact('fieldGroup'));
	}

	public function update( UserFieldGroup $fieldGroup)
	{
		$validator = Validator::make(Input::all(), [
			'name' => 'required',
			'handle' => 'unique:user_field_groups,handle,' . $fieldGroup->id
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$fieldGroup->fill(Input::all());
		$fieldGroup->save();

		return Redirect::route('admin.users.fields.groups.show', $fieldGroup->id)->with('success', 'Field Group updated.');
	}

	public function destroy( UserFieldGroup $fieldGroup )
	{
		$fieldGroup->delete();

		return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group deleted.');
	}

}
