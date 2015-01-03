<?php namespace Atorscho\Backend\Traits;

use Input;

trait OrderAttributeTrait {

	/**
	 * Automatically set order attribute.
	 * Always use the highest order and increment it.
	 */
	public function setOrderAttribute()
	{
		if ( Input::has('order') )
			$this->attributes['order'] = Input::get('order');
		else
		{
			if($this->orderBy('order', 'desc')->first())
				$order = $this->orderBy('order', 'desc')->first()->order + 1;
			else
				$order = 1;

			$this->attributes['order'] = $order;
		}
	}

} 
