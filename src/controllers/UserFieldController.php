<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

// todo - add order to field groups and to fields

// todo - save or save & new

// todo - add SELECT type (+ options)

class UserFieldController extends BaseController {

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
		$title = 'Fields';

		$fields = UserField::all();

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.index'), $title);

		$this->layout->title   = $title;
		$this->layout->desc    = 'List of all custom fields';
		$this->layout->content = View::make('backend::users.fields.index', compact('fields'));
	}

	public function create()
	{
		$title = 'New Custom Field';

		$fieldGroups = UserFieldGroup::orderBy('name')->lists('name', 'id');
		$types = [
			'text'     => 'Text',
			'textarea' => 'Text Box',
			'email'    => 'Email',
			'url'      => 'URL',
			'select'   => 'Select Box',
			'radio'    => 'Radio',
			'checkbox' => 'Checkbox'
		];

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.index'), 'Fields');
		Crumbs::add(route('admin.users.fields.create'), $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.fields.create', compact('fieldGroups', 'types'));
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), [
			'group_id'    => 'required|integer',
			'type'        => 'required',
			'name'        => 'required|max:40',
			'handle'      => 'max:40',
			'description' => 'max:255',
			'required'    => 'boolean',
			'step'        => 'integer',
			'maxlength'   => 'integer',
			'order'       => 'integer'
		]);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		UserField::create(Input::all());

		return Redirect::route('admin.users.fields.index')->with('success', 'Field created.');
	}

	public function show( UserField $fieldGroup )
	{
		// Eager-loading
		$fieldGroup = $fieldGroup->with('fields')->find($fieldGroup->id);

		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Field Groups');
		Crumbs::add(route('admin.users.fields.groups.show', $fieldGroup->id), $fieldGroup->name);

		$this->layout->title   = 'Field Group: ' . $fieldGroup->name;
		$this->layout->content = View::make('backend::users.fields.groups.show', compact('fieldGroup'));
	}

	public function edit( UserField $fieldGroup )
	{
		Crumbs::add(route('admin.users.index'), 'Users');
		Crumbs::add(route('admin.users.fields.groups.index'), 'Field Groups');
		Crumbs::add(route('admin.users.fields.groups.show', $fieldGroup->id), $fieldGroup->name);
		Crumbs::add(route('admin.users.fields.groups.edit', $fieldGroup->id), 'Edit');

		$this->layout->title   = 'Edit Field Group: ' . $fieldGroup->name;
		$this->layout->content = View::make('backend::users.fields.groups.edit', compact('fieldGroup'));
	}

	public function update( UserField $fieldGroup)
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

	public function destroy( UserField $fieldGroup )
	{
		$fieldGroup->delete();

		return Redirect::route('admin.users.fields.groups.index')->with('success', 'Field Group deleted.');
	}

}
