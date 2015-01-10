<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\ContentField;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Validator;
use View;

class ContentFieldController extends BaseController {

	protected $rules = [
		'type'        => 'required',
		'name'        => 'required|max:40',
		'handle'      => 'max:40|unique:user_fields',
		'placeholder' => 'max:255',
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
			'type'        => trans('backend::labels.type'),
			'name'        => trans('backend::labels.name'),
			'handle'      => trans('backend::labels.handle'),
			'placeholder' => trans('backend::labels.placeholder'),
			'description' => trans('backend::labels.description'),
			'required'    => trans('backend::labels.required'),
			'step'        => trans('backend::labels.step'),
			'min'         => trans('backend::labels.min'),
			'max'         => trans('backend::labels.max'),
			'order'       => trans('backend::labels.order')
		];

		// Access Filters
		$this->beforeFilter('admin.perm:showContentFields', [
			'only' => 'index'
		]);
		$this->beforeFilter('admin.perm:createContentFields', [
			'only' => [
				'create',
				'store'
			]
		]);
		$this->beforeFilter('admin.perm:editContentFields', [
			'only' => [
				'edit',
				'update'
			]
		]);
		$this->beforeFilter('admin.perm:deleteContentFields', [ 'only' => [ 'destroy' ] ]);
	}

	public function index( ContentType $contentType )
	{
		$contentType = $contentType->with('fields')->find($contentType->id);
		$title = trans('backend::labels.fields');

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.content-types.fields.index', $title, $contentType->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.fields.index', compact('contentType'));
	}

	public function create( ContentType $contentType )
	{
		$contentType = $contentType->with('fields')->find($contentType->id);

		$title = trans('backend::labels.fieldsNew');

		$types = [
			'text'     => trans('backend::labels.text'),
			'textarea' => trans('backend::labels.textarea'),
			'email'    => trans('backend::labels.email'),
			'url'      => trans('backend::labels.url'),
			'select'   => trans('backend::labels.selectBox'),
			'radio'    => trans('backend::labels.radioBox'),
			'checkbox' => trans('backend::labels.checkBox')
		];

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.content-types.fields.index', trans('backend::labels.fields'), $contentType->slug);
		Crumbs::addRoute('admin.content-types.fields.create', $title, $contentType->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.fields.create', compact('contentType', 'types'));
	}

	public function store( ContentType $contentType )
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$data            = Input::all();
		$data['type_id'] = $contentType->id;
		ContentField::create($data);

		Flash::success('contentFieldCreated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.content-types.fields.create', $contentType->slug);
		else
			return Redirect::route('admin.content-types.fields.index', $contentType->slug);
	}

	public function edit( ContentType $contentType, ContentField $contentField )
	{
		$contentType = $contentType->with('fields')->find($contentType->id);

		$title = trans('backend::labels.fieldsEditName', ['name' => $contentField->name]);

		$types = [
			'text'     => trans('backend::labels.text'),
			'textarea' => trans('backend::labels.textarea'),
			'email'    => trans('backend::labels.email'),
			'url'      => trans('backend::labels.url'),
			'select'   => trans('backend::labels.selectBox'),
			'radio'    => trans('backend::labels.radioBox'),
			'checkbox' => trans('backend::labels.checkBox')
		];

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.content-types.fields.index', trans('backend::labels.fields'), $contentType->slug);
		Crumbs::addRoute('admin.content-types.fields.edit', $title, [$contentType->slug, $contentField->id]);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.fields.edit', compact('contentType', 'contentField', 'types'));
	}

	public function update( ContentType $contentType, ContentField $contentField )
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$contentField->fill(Input::all());
		$contentField->save();

		Flash::success('contentFieldUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.content-types.fields.create', $contentType->slug);
		else
			return Redirect::route('admin.content-types.fields.index', $contentType->slug);
	}

	public function destroy( ContentType $contentType, ContentField $contentField )
	{
		$contentField->delete();

		Flash::success('contentFieldDeleted');

		return Redirect::route('admin.content-types.fields.index', $contentField->slug);
	}

}
