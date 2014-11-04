<?php namespace Atorscho\Backend\Models;

class BaseModel extends \Eloquent {

	protected $stiClassField = null;
	protected $stiBaseClass = null;

	public function __construct($attributes = array())
	{
		parent::__construct($attributes);

		// Set the 'type' attribute to match class name
		if ( $this->useSti() )
		{
			$this->setAttribute($this->stiClassField, get_class($this));
		}
	}

	/*
	 * Retrict retrieved records to 'type' class name
	 */
	public function newQuery( $excludeDeleted = true )
	{
		$builder = parent::newQuery($excludeDeleted);

		/*
		 * If I am using STI and I'm not the base class,
		 * then filter on the 'type' class name.
		 */
		if ( $this->useSti() && get_class(new $this->stiBaseClass) !== get_class($this) )
			$builder->where($this->stiClassField, '=', get_class($this));

		return $builder;
	}

	/*
	 * Ensuring an object of the proper class is returned.
	 */
	public function newFromBuilder( $attributes = array())
	{
		if ( $this->useSti() && $attributes->{$this->stiClassField} )
		{
			$class = $attributes->{$this->stiClassField};
			$instance = new $class;
			$instance->exists = true;
			$instance->setRawAttributes((array) $attributes, true);

			return $instance;
		}
		else
		{
			return parent::newFromBuilder($attributes);
		}
	}

	private function useSti()
	{
		return ( $this->stiClassField && $this->stiBaseClass );
	}

}
