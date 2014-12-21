<?php namespace Atorscho\Backend\Extensions;

class Extension {

	/**
	 * To enable the extension set property to true.
	 *
	 * By default: false.
	 *
	 * @var bool True to enable the extension, false to disable.
	 */
	public $enabled = false;

	/**
	 * Service Provider of the extension.
	 *
	 * e.g. 'Atorscho\Backend\BackendServiceProvider' for this Backend package.
	 *
	 * @var string|null
	 */
	public $service = null;

}
