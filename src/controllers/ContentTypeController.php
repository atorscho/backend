<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Input;
use View;

// todo - translate

class ContentTypeController extends BaseController {

	public function __construct()
	{
		parent::__construct();

		// todo - access permissions
	}

	public function index()
	{
		$perPage = Input::get('perPage', 10);
		$contentTypes = ContentType::paginate($perPage);
		$counter = counter($perPage);

		$title = trans('backend::labels.contentTypes');

		// Table Heading Rows
		$rows = [
			'#'         => 'width-50',
			'Title',
			'Slug',
			'Published' => 'width-50',
			'Author'    => 'text-center width-100',
			'ID'        => 'text-center width-80',
			'Actions'   => 'text-center width-90'
		];

		Crumbs::addRoute('admin.content-types.index', $title);

		$this->layout->title   = $title;
		$this->layout->content = View::make('backend::contents.types.index', compact('contentTypes', 'rows', 'counter'));
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

		// Table Heading Rows
		$rows = [
			'#'         => 'width-50',
			'Title',
			'Slug',
			'Published' => 'width-50',
			'Author'    => 'text-center width-100',
			'ID'        => 'text-center width-80',
			'Actions'   => 'text-center width-90'
		];

		Crumbs::addRoute('admin.content-types.index', 'Content Types');
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);

		if ( Input::get('trashed') == 'yes' )
			$this->layout->title = 'All ' . $contentType->name . ': ' . trans('backend::labels.trashedOnly');
		else
			$this->layout->title = 'All ' . $contentType->name;
		$this->layout->content = View::make('backend::contents.types.show', compact('contentType', 'contents', 'rows', 'counter'));
	}

}
