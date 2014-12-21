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
	 * Extension's public name.
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Service Provider of the extension.
	 *
	 * e.g. 'Atorscho\Backend\BackendServiceProvider' for this Backend package.
	 *
	 * @var string|null
	 */
	public $service = null;

	/**
	 * URI to extension's home page.
	 *
	 * @var string
	 */
	public $uri = '';

	/**
	 * If needed you may also specify route name for extension's home page.
	 *
	 * @var string
	 */
	public $route = '';

	/**
	 * Any Font-Awesome icon to represent the extension.
	 *
	 * e.g. 'comments' for 'fa fa-comments'
	 *
	 * @var string
	 */
	public $icon = '';

}
