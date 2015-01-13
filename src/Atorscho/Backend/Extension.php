<?php namespace Atorscho\Backend;

class Extension {

	/**
	 * To enable the extension set property to true.
	 *
	 * By default: false.
	 *
	 * @var bool True to enable the extension, false to disable.
	 */
	protected $enabled = false;

	/**
	 * Extension's public name.
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * URI to extension's home page.
	 *
	 * @var string
	 */
	protected $uri = '';

	/**
	 * If needed you may also specify route name for extension's home page.
	 *
	 * @var string
	 */
	protected $route = '';

	/**
	 * Any Font-Awesome icon to represent the extension.
	 *
	 * e.g. 'comments' for 'fa fa-comments'
	 *
	 * @var string
	 */
	protected $icon = '';

	/**
	 * Extension's settings group slug in DB.
	 *
	 * @var string
	 */
	protected $settings = '';

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

	/**
	 * Let only get values from properties.
	 *
	 * @param $name
	 *
	 * @return bool|string
	 */
	public function __get( $name )
	{
		if ( in_array($name, array_keys(get_class_vars(__CLASS__))) )
		{
			return $this->$name;
		}

		return false;
	}

	/**
	 * Only set `enabled` attribute to TRUE or FALSE.
	 *
	 * @param boolean $enabled
	 *
	 * @return $this
	 */
	public function setEnabled( $enabled )
	{
		$this->enabled = (bool) $enabled;
	}

}
