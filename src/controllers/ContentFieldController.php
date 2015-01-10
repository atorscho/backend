<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use View;

// todo - translate

class ContentFieldController extends BaseController {

	public function index( ContentType $contentType )
	{
		$this->layout->title   = 'Fields';
		$this->layout->content = View::make('backend::contents.fields.index');
	}

}
