<?php namespace Atorscho\Backend\Traits;

use Input;

trait OrderAttributeTrait {

	/**
	 * Automatically set order attribute.
	 *
	 * Always use the highest order and increment it.
	 */
	public function setOrderAttribute()
	{
		if( Input::has('order'))
			$this->attributes['order'] = Input::get('order');
		else
			$this->attributes['order'] = $this->orderBy('order', 'desc')->first()->order + 1;
	}

} 
