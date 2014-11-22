<?php namespace Atorscho\Backend\Traits;

trait HandleTrait {

	/**
	 * If handle has not been specified,
	 * use name to create it.
	 * Otherwise use the specified one.
	 *
	 * @param        $value
	 * @param string $title This will be used to create a handle if it is empty.
	 */
	public function setHandleAttribute( $value, $title = 'name' )
	{
		if ( $value )
			$this->attributes['handle'] = \Str::slug($value);
		else
			$this->attributes['handle'] = \Str::slug($this->$title);
	}

} 
