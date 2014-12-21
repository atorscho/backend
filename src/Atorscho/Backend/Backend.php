<?php namespace Atorscho\Backend;

// todo - translate

class Backend {

	public $extensions = [ ];

	public function __construct()
	{
		$files = scandir(__DIR__ . DIRECTORY_SEPARATOR . 'Extensions');
		$classes = [ ];
		array_map(function ( $value ) use(&$php)
		{
			if ( !preg_match('/^.+\.php$/i', $value) )
				return;

			$php[] = $value;
		}, $files);
		var_dump($php);
		dd(scandir(__DIR__ . DIRECTORY_SEPARATOR . 'Extensions'));
	}

	/**
	 * Return extension's object instance if it exists and is enabled.
	 *
	 * @param $name Extension's name. e.g. 'ecommerce'
	 *
	 * @return object|bool
	 */
	public function extension( $name )
	{
		$this->extensions[] = $name;

		// Get proper extension class
		$class = 'Atorscho\Backend\Extensions\\' . ucfirst($name) . 'Extension';

		// Create a new instance of extension class
		$instance = new $class;

		// If extension is disabled or it does not exist, return false
		if ( !$instance->enabled || !class_exists($instance->service) )
			return false;

		return $instance;
	}

}
