<?php namespace Atorscho\Backend\Traits;

trait SlugAttributeTrait {

	/**
	 * If slug has not been specified,
	 * use name to create it.
	 * Otherwise use the specified one.
	 *
	 * @param        $value
	 * @param string $title This will be used to create a slug if it is empty.
	 */
	public function setSlugAttribute( $value, $title = 'name' )
	{
		if ( $value )
			$this->attributes['slug'] = \Str::str($value);
		else
			$this->attributes['slug'] = \Str::str($this->$title);
	}

} 
