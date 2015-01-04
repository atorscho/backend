<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use Str;
use View;

// todo - translate

class ContentController extends BaseController {

	protected $rules = [
		'type_id'   => 'integer',
		'title'     => 'required|max:100',
		'slug'      => 'max:100',
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
			'title'      => 'Title',
			'slug'       => 'slug',
			'published'  => 'Published',
			'order'      => 'Order',
			'created_by' => 'Creator',
			'created_at' => 'Created at'
		];

		// todo - access permissions
	}

	public function edit( ContentType $contentType, Content $content )
	{
		$content = $content->with('fields')->find($content->id);

		Crumbs::addRoute('admin.content-types.index', 'Content Types');
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);
		Crumbs::add('#', Str::limit($content->title, 30));
		Crumbs::addRoute('admin.contents.edit', trans('backend::labels.edit'), [$contentType->slug, $content->id]);

		$this->layout->title   = trans('backend::labels.editName', [ 'name' => $content->title ]);
		$this->layout->content = View::make('backend::contents.edit', compact('contentType', 'content'));
	}

	public function update( ContentType $contentType, Content $content )
	{
		$rules             = $this->rules;
		$rules['email']    = 'required|email|max:40|unique:users';
		$rules['password'] = 'required|confirmed';

		// Setting up custom fields rules
		$fieldsUpdate = Input::get('fields');
		$ruleFields  = $this->ruleFields;
		$fieldsUpdate = saveUserField($rules, $ruleFields, $fieldsUpdate);

		$validator = Validator::make(Input::all(), $rules);
		$validator->setAttributeNames($ruleFields);

		if ( $validator->fails() )
			return Redirect::back()->withErrors($validator)->withInput();

		$user = User::create(Input::except('groups'));
		$user->groups()->sync(Input::get('groups'));

		// Synchronize custom user fields
		$user->fields()->sync($fieldsUpdate);

		if ( Input::get('submit') == 'save_new' )
			return Redirect::route('admin.users.create')->with('success', trans('backend::labels.userCreated'));
		else
			return Redirect::route('admin.users.index')->with('success', trans('backend::labels.userCreated'));
	}

	public function destroy( ContentType $contentType, Content $content )
	{
		$content->delete();

		$content->published = 0;

		Flash::success('contentDeleted');

		return Redirect::back();
	}

}
