<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Facades\Template;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
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
		$rows = [
			'#' => 'width-50',
			'Title',
			'Slug',
			'ID' => 'text-center width-80'
		];
		dd(Template::tableHeadings($rows));

		Crumbs::addRoute('admin.content-types.index', 'Content Types');
		Crumbs::addRoute('admin.content-types.show', $contentType->name, $contentType->slug);

		$this->layout->title   = 'All ' . $contentType->name;
		$this->layout->content = View::make('backend::contents.types.show', compact('contentType'));
	}

}
