<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\TaxonomyType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Validator;
use View;

// todo - translate

class TaxonomyTypeController extends BaseController {

	protected $rules = [
		'name'         => 'required|max:50',
		'slug'         => 'max:50|unique:taxonomy_types,slug',
		'description'  => 'max:255',
		'icon'         => 'required',
		'hierarchical' => 'boolean'
	];

	protected $ruleFields = [
		'name'         => 'Name',
		'slug'         => 'Slug',
		'description'  => 'Description',
		'icon'         => 'Icon',
		'hierarchical' => 'Hierarchical'
	];

	public function __construct()
	{
		parent::__construct();

		// todo - access permissions
	}

	public function index()
	{
		$perPage       = Input::get('perPage', 10);
		$taxonomyTypes = TaxonomyType::paginate($perPage);
		$counter       = counter($perPage);

		$title = trans('backend::labels.taxonomyTypes');

		// Table Heading Rows
		$rows = [
			'#'            => 'width-50',
			'Name',
			'Slug',
			'Hierarchical' => 'text-center width-50',
			'ID'           => 'text-center width-80',
			'Actions'      => 'text-center width-90'
		];

		Crumbs::addRoute('admin.taxonomy-types.index', $title);

		$this->layout->title    = $title;
		$this->layout->taxonomy = View::make('backend::taxonomies.types.index', compact('taxonomyTypes', 'rows', 'counter'));
	}

	public function create()
	{
		$icons = iconList();

		$title = trans('backend::labels.taxonomyTypesNew');

		Crumbs::addRoute('admin.taxonomy-types.index', trans('backend::labels.taxonomyTypes'));
		Crumbs::addRoute('admin.taxonomy-types.create', $title);

		$this->layout->title    = $title;
		$this->layout->taxonomy = View::make('backend::taxonomies.types.create', compact('icons'));
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		TaxonomyType::create(Input::all());

		Flash::success('Taxonomy type created.');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.taxonomy-types.create');
		else
			return Redirect::route('admin.taxonomy-types.index');
	}

	// todo - hierarchical view (- -- --- etc)
	public function show( TaxonomyType $taxonomyType )
	{
		$perPage = Input::get('perPage', 10);

		$taxonomies = $taxonomyType->taxonomies()->paginate($perPage);

		$counter = counter($perPage);

		// Table Heading Rows
		$rows = [
			'#'         => 'width-50',
			'Title',
			'Slug',
			'ID'        => 'text-center width-80',
			'Actions'   => 'text-center width-90'
		];

		Crumbs::addRoute('admin.taxonomy-types.index', 'Taxonomy Types');
		Crumbs::addRoute('admin.taxonomy-types.show', $taxonomyType->name, $taxonomyType->slug);

		$this->layout->title = 'All ' . $taxonomyType->name;
		$this->layout->taxonomy = View::make('backend::taxonomies.types.show', compact('taxonomyType', 'taxonomies', 'rows', 'counter'));
	}

	public function edit( TaxonomyType $taxonomyType )
	{
		$icons = iconList();

		Crumbs::addRoute('admin.taxonomy-types.index', trans('backend::labels.taxonomyTypes'));
		Crumbs::addRoute('admin.taxonomy-types.show', $taxonomyType->name, $taxonomyType->slug);
		Crumbs::addRoute('admin.taxonomy-types.edit', 'Edit', $taxonomyType->slug);

		$this->layout->title    = trans('backend::labels.taxonomyTypesEditName', [ 'name' => $taxonomyType->name ]);
		$this->layout->taxonomy = View::make('backend::taxonomies.types.edit', compact('taxonomyType', 'icons'));
	}

	public function update( TaxonomyType $taxonomyType )
	{
		$rules = $this->rules;
		$rules['slug'] .= ',' . $taxonomyType->id;

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$taxonomyType->fill(Input::all());
		$taxonomyType->save();

		Flash::success('Taxonomy type updated.');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.taxonomy-types.create');
		else
			return Redirect::route('admin.taxonomy-types.show', $taxonomyType->slug);
	}

	public function destroy( TaxonomyType $taxonomyType )
	{
		if ( in_array($taxonomyType->slug, ['categories', 'tags']) )
		{
			Flash::warning('This taxonomy type is protected. You cannot delete it.');
		}
		else
		{
			Flash::success('Taxonomy type deleted.');
			$taxonomyType->delete();
		}

		return Redirect::route('admin.taxonomy-types.index');
	}

}
