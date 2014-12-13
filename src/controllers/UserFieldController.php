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

	protected $rules = [
		'group_id'    => 'required|integer',
		'type'        => 'required',
		'name'        => 'required|max:40',
		'handle'      => 'max:40|unique:fields',
		'description' => 'max:255',
		'required'    => 'boolean',
		'step'        => 'integer',
		'maxlength'   => 'integer',
		'order'       => 'integer'
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
		$title = 'Fields';

		$fields = UserField::all();

		Crumbs::addRoute('admin.users.index', 'Users');
		Crumbs::addRoute('admin.users.fields.index', $title);

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
		$validator = Validator::make(Input::all(), $this->rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		UserField::create(Input::all());

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.create')->with('success', 'Field created.');
		else
			return Redirect::route('admin.users.fields.index')->with('success', 'Field created.');
	}

	public function show( UserField $field )
	{
		// todo - may be implemented in future
	}

	public function edit( UserField $field )
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
		$this->layout->content = View::make('backend::users.fields.edit', compact('field', 'fieldGroups', 'types'));
	}

	public function update( UserField $field)
	{
		// Specifying that handle must be unique excepting for current ID.
		$rules = $this->rules;
		$rules['handle'] .= ',handle,' . $field->id;

		$validator = Validator::make(Input::all(), $rules);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$field->fill(Input::all());
		$field->save();

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.create')->with('success', 'Field updated.');
		else
			return Redirect::route('admin.users.fields.index')->with('success', 'Field updated.');
	}

	public function destroy( UserField $field )
	{
		$field->delete();

		return Redirect::route('admin.users.fields.index')->with('success', 'Field deleted.');
	}

}
