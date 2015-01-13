<?php namespace Atorscho\Backend;

class Backend {

	/**
	 * List of extensions objects.
	 *
	 * @var array
	 */
	private $extensions = [ ];

	/**
	 * Get an array of all extension objects.
	 *
	 * @return array
	 */
	public function getExtensions()
	{
		foreach ( get_declared_classes() as $class )
		{
			if ( !preg_match('/(Extension)$/', $class) || !is_subclass_of($class, 'Atorscho\Backend\Extension') )
				continue;

			$extension = new $class;

			if ( !$extension->enabled )
				continue;

			$this->extensions[] = $extension;
		}

		return $this->extensions;
	}

	/**
	 * Find specified extension by its in the `extensions` property and then return it.
	 *
	 * @param string $name
	 *
	 * @return object|bool
	 */
	public function getExtension( $name )
	{
		foreach ( $this->extensions as $extension )
		{
			if ( strstr(strtolower($extension), strtolower($name)) )
			{
				return $extension;
			}
		}

		return false;
	}

}
