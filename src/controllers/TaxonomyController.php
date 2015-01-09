<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Taxonomy;
use Atorscho\Backend\Models\TaxonomyType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Str;
use Validator;
use View;

// todo - translate

class TaxonomyController extends BaseController {

	protected $rules = [
		'type_id'   => 'integer',
		'title'     => 'required|max:100',
		'slug'      => 'max:100|unique:taxonomies',
		'order'     => 'integer'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		// todo - translate
		$this->ruleFields = [
			'type_id'    => 'Taxonomy Type',
			'parent_id'  => 'Parent',
			'title'      => 'Title',
			'slug'       => 'slug',
			'order'      => 'Order',
		];

		// todo - access permissions
	}

	public function create( TaxonomyType $taxonomyType )
	{
		$parent = '';
		if ( $taxonomyType->hierarchical )
			$parent = ['none' => trans('backend::labels.noParent')] + $taxonomyType->taxonomies()->orderBy('title')->lists('title', 'id');

		$title = trans('backend::labels.taxonomiesNew');

		Crumbs::addRoute('admin.taxonomy-types.index', 'Taxonomy Types');
		Crumbs::addRoute('admin.taxonomy-types.show', $taxonomyType->name, $taxonomyType->slug);
		Crumbs::addRoute('admin.taxonomies.create', $title, $taxonomyType->slug);

		$this->layout->title   = $title;
		$this->layout->taxonomy = View::make('backend::taxonomies.create', compact('taxonomyType', 'parent'));
	}

	public function store( TaxonomyType $taxonomyType )
	{
		$rules = $this->rules;

		$validator = Validator::make(Input::all(), $this->rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$data            = (Input::get('parent_id') == 'none') ? Input::except('parent_id') : Input::all();
		$data['type_id'] = $taxonomyType->id;
		Taxonomy::create($data);

		Flash::success('taxonomyCreated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.taxonomies.create', $taxonomyType->slug);
		else
			return Redirect::route('admin.taxonomy-types.show', $taxonomyType->slug);
	}

	public function edit( TaxonomyType $taxonomyType, Taxonomy $taxonomy )
	{
		$parent = '';
		if ( $taxonomyType->hierarchical )
			$parent = ['none' => trans('backend::labels.noParent')] + $taxonomyType->taxonomies()->orderBy('title')->lists('title', 'id');

		Crumbs::addRoute('admin.taxonomy-types.index', 'Taxonomy Types');
		Crumbs::addRoute('admin.taxonomy-types.show', $taxonomyType->name, $taxonomyType->slug);
		Crumbs::add('#', str_limit($taxonomy->title, 30));
		Crumbs::addRoute('admin.taxonomies.edit', trans('backend::labels.edit'), [ $taxonomyType->slug, $taxonomy->id ]);

		$this->layout->title   = trans('backend::labels.editName', [ 'name' => $taxonomy->title ]);
		$this->layout->taxonomy = View::make('backend::taxonomies.edit', compact('taxonomyType', 'taxonomy', 'parent'));
	}

	public function update( TaxonomyType $taxonomyType, Taxonomy $taxonomy )
	{
		$rules = $this->rules;
		$rules['slug'] .= ',slug,' . $taxonomy->id;

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($this->ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$taxonomy->fill(Input::all());
		$taxonomy->updated_at = time();
		$taxonomy->save();

		Flash::success('taxonomyUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.taxonomies.create', $taxonomyType->slug);
		else
			return Redirect::route('admin.taxonomy-types.show', $taxonomyType->slug);
	}

	/**
	 * Soft delete the taxonomy.
	 *
	 * @param Taxonomy $taxonomy
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy( Taxonomy $taxonomy )
	{
		$taxonomy->delete();

		Flash::success('taxonomyDeleted');

		return Redirect::back();
	}

}
