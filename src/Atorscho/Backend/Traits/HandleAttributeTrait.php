<?php namespace Atorscho\Backend\Traits;

trait HandleAttributeTrait {

	/**
	 * Find a record by its handle.
	 *
	 * @param $query
	 * @param $handle
	 *
	 * @return mixed
	 */
	public function scopeFindHandle( $query, $handle )
	{
		return $query->where('handle', $handle)->first();
	}

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
			$this->attributes['handle'] = \Str::camel($value);
		else
			$this->attributes['handle'] = \Str::camel($this->$title);
	}

} 
