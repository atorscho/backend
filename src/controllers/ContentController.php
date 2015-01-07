<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Str;
use Validator;
use View;

// todo - translate

class ContentController extends BaseController {

	protected $rules = [
		'type_id'   => 'integer',
		'title'     => 'required|max:100',
		'slug'      => 'max:100|unique:contents',
		'published' => 'required|boolean',
		'order'     => 'integer'
	];

	protected $ruleFields = [ ];

	public function __construct()
	{
		parent::__construct();

		// todo - translate
		$this->ruleFields = [
			'type_id'    => 'Content Type',
			'parent_id'  => 'Parent',
			'title'      => 'Title',
			'slug'       => 'slug',
			'published'  => 'Published',
			'order'      => 'Order',
			'created_by' => 'Creator',
			'created_at' => 'Created at'
		];

		// todo - access permissions
	}

	public function create( ContentType $contentType )
	{
		$title = trans('backend::labels.contentsNew');

		Crumbs::addRoute('admin.content-types.index', 'Content Types');
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::addRoute('admin.contents.create', $title, $contentType->slug);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.create', compact('contentType'));
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

		$data            = Input::all();
		$data['type_id'] = $contentType->id;
		$content         = Content::create($data);

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
		$content = $content->with('fields')->find($content->id);

		Crumbs::addRoute('admin.content-types.index', 'Content Types');
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::add('#', Str::limit($content->title, 30));
		Crumbs::addRoute('admin.contents.edit', trans('backend::labels.edit'), [ $contentType->slug, $content->id ]);

		$this->layout->title   = trans('backend::labels.editName', [ 'name' => $content->title ]);
		$this->layout->content = View::make('backend::contents.edit', compact('contentType', 'content'));
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

		// Synchronize custom content fields
		$content->fields()->sync($fieldsUpdate);

		Flash::success('contentUpdated');

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.contents.create', $contentType->slug);
		else
			return Redirect::route('admin.content-types.show', $contentType->slug);
	}

	public function destroy( ContentType $contentType, Content $content )
	{
		$content->delete();

		$content->published = 0;

		Flash::success('contentDeleted');

		return Redirect::back();
	}

	// todo - make an ajax update
	public function toggleStatus( Content $content )
	{
		$validator = Validator::make(Input::all(), [
			'published' => 'required|boolean'
		]);

		if ( $validator->fails() )
			return Redirect::back();

		$content->published = Input::get('published');
		$content->save();

		Flash::success('contentStatusUpdate');

		return Redirect::back();
	}

}
