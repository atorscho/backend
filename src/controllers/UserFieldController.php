<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\UserField;
use Atorscho\Backend\Models\UserFieldGroup;
use Crumbs;
use Input;
use Redirect;
use Validator;
use View;

// todo - add SELECT type (+ options)

class UserFieldController extends BaseController {

	protected $rules = [
		'group_id'    => 'required|integer',
		'type'        => 'required',
		'name'        => 'required|max:40',
		'handle'      => 'max:40|unique:user_fields',
		'description' => 'max:255',
		'required'    => 'boolean',
		'min'         => 'integer',
		'max'         => 'integer',
		'step'        => 'integer',
		'order'       => 'integer'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		// Form Fields Names
		$this->ruleFields = [
			'group_id'    => trans('backend::labels.group'),
			'type'        => trans('backend::labels.type'),
			'name'        => trans('backend::labels.name'),
			'handle'      => trans('backend::labels.handle'),
			'description' => trans('backend::labels.description'),
			'required'    => trans('backend::labels.required'),
			'step'        => trans('backend::labels.step'),
			'min'         => trans('backend::labels.min'),
			'max'         => trans('backend::labels.max'),
			'order'       => trans('backend::labels.order')
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
		$title = trans('backend::labels.userFields');

		$fields = UserField::all();

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', $title);

		$this->layout->title   = $title;
		$this->layout->desc    = trans('backend::labels.userFieldsDesc');
		$this->layout->content = View::make('backend::users.fields.index', compact('fields'));
	}

	public function create()
	{
		$title = trans('backend::labels.userFieldsNew');

		$fieldGroups = UserFieldGroup::orderBy('name')->lists('name', 'id');
		$types       = [
			'text'     => trans('backend::labels.text'),
			'textarea' => trans('backend::labels.textarea'),
			'email'    => trans('backend::labels.email'),
			'url'      => trans('backend::labels.url'),
			'select'   => trans('backend::labels.selectBox'),
			'radio'    => trans('backend::labels.radioBox'),
			'checkbox' => trans('backend::labels.checkBox')
		];

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::addRoute('admin.users.fields.create', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::users.fields.create', compact('fieldGroups', 'types'));
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		UserField::create(Input::all());

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.create')->with('success', trans('backend::messages.userFieldCreated'));
		else
			return Redirect::route('admin.users.fields.index')->with('success', trans('backend::messages.userFieldCreated'));
	}

	public function edit( UserField $field )
	{
		$title = trans('backend::labels.userFieldsEditName', ['name' => $field->name]);

		$fieldGroups = UserFieldGroup::orderBy('name')->lists('name', 'id');
		$types       = [
			'text'     => trans('backend::labels.text'),
			'textarea' => trans('backend::labels.textarea'),
			'email'    => trans('backend::labels.email'),
			'url'      => trans('backend::labels.url'),
			'select'   => trans('backend::labels.selectBox'),
			'radio'    => trans('backend::labels.radioBox'),
			'checkbox' => trans('backend::labels.checkBox')
		];

		Crumbs::addRoute('admin.users.index', trans('backend::labels.users'));
		Crumbs::addRoute('admin.users.fields.index', trans('backend::labels.userFields'));
		Crumbs::add('#', $field->name, $field->id);
		Crumbs::addRoute('admin.users.fields.edit', trans('backend::labels.edit'), $field->id);

		$this->layout->title   = trans('backend::labels.userFieldsEditName', ['name' => $field->name]);
		$this->layout->content = View::make('backend::users.fields.edit', compact('field', 'fieldGroups', 'types'));
	}

	public function update( UserField $field )
	{
		// Specifying that handle must be unique excepting for current ID.
		$rules = $this->rules;
		$rules['handle'] .= ',handle,' . $field->id;

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$field->fill(Input::all());
		$field->save();

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.fields.create')->with('success', trans('backend::messages.userFieldUpdated'));
		else
			return Redirect::route('admin.users.fields.index')->with('success', trans('backend::messages.userFieldUpdated'));
	}

	public function destroy( UserField $field )
	{
		$field->delete();

		return Redirect::route('admin.users.fields.index')->with('success', trans('backend::messages.userFieldDeleted'));
	}

}
