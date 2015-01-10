<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Validator;
use View;

class ContentTypeController extends BaseController {

	protected $rules = [
		'name'         => 'required|max:50',
		'slug'         => 'max:50|unique:content_types,slug',
		'description'  => 'max:255',
		'icon'         => 'required',
		'hierarchical' => 'boolean'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		$this->ruleFields = [
			'name'         => trans('backend::labels.name'),
			'slug'         => trans('backend::labels.slug'),
			'description'  => trans('backend::labels.description'),
			'icon'         => trans('backend::labels.icon'),
			'hierarchical' => trans('backend::labels.hierarchical')
		];

		// todo - access permissions
	}

	public function index()
	{
		$perPage      = Input::get('perPage', 10);
		$contentTypes = ContentType::paginate($perPage);
		$counter      = counter($perPage);

		$title = trans('backend::labels.contentTypes');

		Crumbs::addRoute('admin.content-types.index', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.types.index', compact('contentTypes', 'counter'));
	}

	public function create()
	{
		$icons = iconList();

		$title = trans('backend::labels.contentTypesNew');

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.create', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.types.create', compact('icons'));
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		ContentType::create(Input::all());

		Flash::success('contentTypeCreated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.content-types.create');
		else
			return Redirect::route('admin.content-types.index');
	}

	// todo - hierarchical view (- -- --- etc)
	public function show( ContentType $contentType )
	{
		$perPage = Input::get('perPage', 10);

		// If parameter exists, show only trashed records.
		if ( Input::get('trashed') == 'yes' )
			$contents = $contentType->contents()->onlyTrashed()->paginate($perPage);
		else
			$contents = $contentType->contents()->paginate($perPage);

		$counter = counter($perPage);

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);

		if ( Input::get('trashed') == 'yes' )
			$this->layout->title = 'All ' . $contentType->name . ': ' . trans('backend::labels.trashedOnly');
		else
			$this->layout->title = 'All ' . $contentType->name;
		$this->layout->content = View::make('backend::contents.types.show', compact('contentType', 'contents', 'counter'));
	}

	public function edit( ContentType $contentType )
	{
		$icons = iconList();

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.content-types.edit', trans('backend::labels.edit'), $contentType->slug);

		$this->layout->title   = trans('backend::labels.contentTypesEditName', [ 'name' => $contentType->name ]);
		$this->layout->content = View::make('backend::contents.types.edit', compact('contentType', 'icons'));
	}

	public function update( ContentType $contentType )
	{
		$rules = $this->rules;
		$rules['slug'] .= ',' . $contentType->id;

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$contentType->fill(Input::all());
		$contentType->save();

		Flash::success('contentTypeUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.content-types.create');
		else
			return Redirect::route('admin.content-types.show', $contentType->slug);
	}

	public function destroy( ContentType $contentType )
	{
		if ( in_array($contentType->slug, ['pages', 'articles']) )
		{
			Flash::warning('contentTypeProtected');
		}
		else
		{
			Flash::success('contentTypeDeleted');
			$contentType->delete();
		}

		return Redirect::route('admin.content-types.index');
	}

}
