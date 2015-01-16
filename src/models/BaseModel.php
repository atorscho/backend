<?php namespace Atorscho\Backend\Models;

class BaseModel extends \Eloquent {

	protected $stiClassField = null;

	protected $stiBaseClass = null;

	protected $rules = array();

	public function __construct( $attributes = array() )
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
	public function newFromBuilder( $attributes = array() )
	{
		if ( $this->useSti() && $attributes->{$this->stiClassField} )
		{
			$class            = $attributes->{$this->stiClassField};
			$instance         = new $class;
			$instance->exists = true;
			$instance->setRawAttributes((array) $attributes, true);

			return $instance;
		}
		else
		{
			return parent::newFromBuilder($attributes);
		}
	}

	/**
	 * Whether the Model uses STI or not.
	 *
	 * @return bool
	 */
	private function useSti()
	{
		return ( $this->stiClassField && $this->stiBaseClass );
	}

	public function validates( $input )
	{
		foreach ( $this->rules as $i => $rule )
		{
			if ( !strpos($rule, 'unique') )
				continue;

			$rule = explode('|', $rule);

			foreach ( $rule as $j => $str )
			{
				if ( strpos($str, 'unique') >= 1 )
				{
					if ( substr_count($str, '.') == 0 )
						$str .= ', ' . $i;

					$rule[$j] = $str . ',' . $this->id;
				}
			}

			$this->rules[$i] = $rule;
		}

		var_dump($this->rules);

		die;


		dd($this->rules);

		return \Validator::make($input, $this->rules);
	}

}
