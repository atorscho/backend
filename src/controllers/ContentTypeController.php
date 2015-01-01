<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\ContentType;
use View;

class ContentTypeController extends BaseController {
	
	public function index()
	{
		$types = ContentType::all();

		$this->layout->title   = 'Content Types';
		$this->layout->content = View::make('backend::contents.types.index');
	}

}
