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

	/**
	 * Extension's settings group slug.
	 *
	 * @var string
	 */
	public $settings = '';

	/**
	 * Return array of fields as JSON when casting the class to a string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		$fields = [
			'enabled'  => $this->enabled,
			'name'     => $this->name,
			'service'  => $this->service,
			'uri'      => $this->uri,
			'route'    => $this->route,
			'icon'     => $this->icon,
			'settings' => $this->settings,
		];

		return json_encode($fields);
	}

}
