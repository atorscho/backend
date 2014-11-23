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
		$fieldGroups = UserFieldGroup::orderBy('order')->get();

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.index'), 'Fields');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Groups');

		$this->layout->title   = 'Field Groups';
		$this->layout->desc    = 'Manage User Field Groups';
		$this->layout->content = View::make('backend::users.fields.groups.index', compact('fieldGroups'));
	}

	public function create()
	{
		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.index'), 'Fields');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Groups');
		Crumbs::add(route('admin.users.fields.groups.create'), 'New Group');

		$this->layout->title   = 'New Field Group';
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

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.groups.create')->with('success', 'Field Group has been created.');
		else
			return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group has been created.');
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

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.groups.create')->with('success', 'Field Group has been updated.');
		else
			return Redirect::route('admin.users.fields.groups.show', $fieldGroup->id)->with('success', 'Field Group has been updated.');
	}

	public function destroy( UserFieldGroup $fieldGroup )
	{
		$fieldGroup->delete();

		return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group deleted.');
	}

}
