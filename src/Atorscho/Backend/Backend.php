<?php namespace Atorscho\Backend;

class Backend {

	/**
	 * List of extensions objects.
	 *
	 * @var array
	 */
	private $extensions = [ ];

	/**
	 * Get an array of all extensions objects.
	 *
	 * @return array
	 */
	public function getExtensions()
	{
		// Get all files in Extensions folder.
		$files = scandir(__DIR__ . DIRECTORY_SEPARATOR . 'Extensions');

		$extensions = [ ];

		// Filter through the directory to get only .php files.
		array_map(function ( $value ) use ( &$extensions )
		{
			if ( !preg_match('/^.+\.php$/i', $value) || $value == 'Extension.php' )
				return;

			$value = str_replace('.php', '', $value);

			if ( $extension = $this->extension($value, true) )
				$extensions[] = $extension;
		}, $files);

		return $this->extensions = $extensions;
	}

	/**
	 * Return extension's object instance if it exists and is enabled.
	 *
	 * @param string $name      Extension's name. e.g. 'ecommerce'
	 * @param bool   $className Whether the name parameter is a class name or extension's name.
	 *
	 * @return bool|object
	 */
	public function extension( $name, $className = false )
	{
		$this->extensions[] = $name;

		// Get proper extension class
		$class = 'Atorscho\Backend\Extensions\\' . ucfirst($name) . ( $className ? '' : 'Extension' );

		// Create a new instance of extension class
		$instance = new $class;

		// If extension is disabled or it does not exist, return false
		if ( !$instance->enabled || !class_exists($instance->service) )
			return false;

		return $instance;
	}

}
