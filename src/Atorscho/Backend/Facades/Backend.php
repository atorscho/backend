<?php namespace Atorscho\Backend\Facades;

use Illuminate\Support\Facades\Facade;

class Backend extends Facade {

	/**
	 * Defining new Facade from IoC Container.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'backend';
	}

}
