<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Facades\Template;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Input;
use View;

// todo - translate

class ContentTypeController extends BaseController {

	public function index()
	{
		$this->layout->title   = 'Content Types';
		$this->layout->content = View::make('backend::contents.types.index');
	}

	public function show( ContentType $contentType )
	{
		$perPage = Input::get('perPage', 10);

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

		$this->layout->title   = 'All ' . $contentType->name;
		$this->layout->content = View::make('backend::contents.types.show', compact('contentType', 'contents', 'rows', 'counter'));
	}

}
