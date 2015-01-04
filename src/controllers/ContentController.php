<?php namespace Atorscho\Backend\Controllers;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Crumbs;
use Flash;
use Input;
use Redirect;
use View;

// todo - translate

class ContentController extends BaseController {

	public function destroy( ContentType $contentType, Content $content )
	{
		$content->delete();

		$content->published = 0;

		Flash::success('contentDeleted');

		return Redirect::back();
	}

}
