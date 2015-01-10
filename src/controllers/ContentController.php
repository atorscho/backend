<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\TaxonomyType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Str;
use Validator;
use View;

// todo - Let admin modify creator and published date

class ContentController extends BaseController {

	protected $rules = [
		'categories' => 'required',
		'type_id'    => 'integer',
		'title'      => 'required|max:100',
		'slug'       => 'max:100|unique:contents',
		'published'  => 'required|boolean',
		'order'      => 'integer'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		$this->ruleFields = [
			'type_id'    => trans('backend::labels.contentType'),
			'parent_id'  => trans('backend::labels.parent'),
			'title'      => trans('backend::labels.title'),
			'slug'       => trans('backend::labels.slug'),
			'published'  => trans('backend::labels.published'),
			'order'      => trans('backend::labels.order'),
			'created_by' => trans('backend::labels.creator'),
			'created_at' => trans('backend::labels.createdAt')
		];

		// Access Filters
		$this->beforeFilter('admin.perm:showContents', ['only' => 'index']);
		$this->beforeFilter('admin.perm:createContents', [
			'only' => [
				'create',
				'store'
			]
		]);
		$this->beforeFilter('admin.perm:editContents', [
			'only' => [
				'edit',
				'update',
				'toggleStatus'
			]
		]);
		$this->beforeFilter('admin.perm:deleteContents', [ 'only' => [ 'destroy', 'forceDestroy' ] ]);
	}

	public function create( ContentType $contentType )
	{
		$categories = TaxonomyType::findSlug('categories', 'taxonomies')->taxonomies()->lists('title', 'id');

		$parent = '';
		if ( $contentType->hierarchical )
			$parent = [ 'none' => trans('backend::labels.noParent') ] + $contentType->contents()->orderBy('title')->lists('title', 'id');

		$title = trans('backend::labels.contentsNew');

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.contents.create', $title, $contentType->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.create', compact('contentType', 'categories', 'parent'));
	}

	public function store( ContentType $contentType )
	{
		$rules = $this->rules;

		// Setting up custom fields rules
		$fieldsUpdate = Input::get('fields');
		$ruleFields   = $this->ruleFields;
		$fieldsUpdate = saveUserField($rules, $ruleFields, $fieldsUpdate, 'content');

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$data            = ( Input::get('parent_id') == 'none' ) ? Input::except('parent_id') : Input::all();
		$data['type_id'] = $contentType->id;
		$content         = Content::create($data);

		// Attach taxonomies to the content vie `content_taxonomies` pivot table.
		$content->taxonomies()->sync((array) Input::get('categories'));

		// Synchronize custom content fields
		$content->fields()->sync($fieldsUpdate);

		Flash::success('contentCreated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.contents.create', $contentType->slug);
		else
			return Redirect::route('admin.content-types.show', $contentType->slug);
	}

	public function edit( ContentType $contentType, Content $content )
	{
		$categories = TaxonomyType::findSlug('categories', 'taxonomies')->taxonomies()->lists('title', 'id');

		$parent = '';
		if ( $contentType->hierarchical )
			$parent = [ 'none' => trans('backend::labels.noParent') ] + $contentType->contents()->orderBy('title')->lists('title', 'id');

		$contentCategories = $content->taxonomies()->lists('id');

		$content = $content->with('fields')->find($content->id);

		Crumbs::addRoute('admin.content-types.index', trans('backend::labels.contentTypes'));
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::add('#', Str::limit($content->title, 30));
		Crumbs::addRoute('admin.contents.edit', trans('backend::labels.edit'), [$contentType->slug, $content->id]);

		$this->layout->title   = trans('backend::labels.editName', [ 'name' => $content->title ]);
		$this->layout->content = View::make('backend::contents.edit', compact('contentType', 'content', 'categories', 'contentCategories', 'parent'));
	}

	public function update( ContentType $contentType, Content $content )
	{
		$rules = $this->rules;
		$rules['slug'] .= ',slug,' . $content->id;

		// Setting up custom fields rules
		$fieldsUpdate = Input::get('fields');
		$ruleFields   = $this->ruleFields;
		$fieldsUpdate = saveUserField($rules, $ruleFields, $fieldsUpdate, 'content');

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$content->fill(Input::all());
		$content->updated_at = time();
		$content->save();

		// Attach taxonomies to the content vie `content_taxonomies` pivot table.
		$content->taxonomies()->sync((array) Input::get('categories'));

		// Synchronize custom content fields
		$content->fields()->sync($fieldsUpdate);

		Flash::success('contentUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.contents.create', $contentType->slug);
		else
			return Redirect::route('admin.content-types.show', $contentType->slug);
	}

	/**
	 * Soft delete the content.
	 *
	 * @param Content $content
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy( Content $content )
	{
		$content->delete();

		$content->published = 0;

		Flash::success('contentDeleted');

		return Redirect::back();
	}

	/**
	 * Completely delete the content from the DB.
	 *
	 * @param Content $content
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function forceDestroy( Content $content )
	{
		$content->forceDelete();

		Flash::success('contentDeleted');

		return Redirect::back();
	}

	// todo - Make an ajax update
	public function toggleStatus( Content $content )
	{
		$validator = Validator::make(Input::all(), [
			'published' => 'required|boolean'
		]);

		if ( $validator->fails() )
			return Redirect::back();

		$content->published = Input::get('published');
		$content->save();

		Flash::success('contentUpdatedStatus');

		return Redirect::back();
	}

}
