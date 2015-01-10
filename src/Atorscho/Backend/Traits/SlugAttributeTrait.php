<?php namespace Atorscho\Backend\Traits;

trait SlugAttributeTrait {

	/**
	 * Find a record by its slug.
	 *
	 * @param string $query
	 * @param string $slug
	 * @param string $with
	 *
	 * @return mixed
	 */
	public function scopeFindSlug( $query, $slug, $with = '' )
	{
		if ( $with )
			return $query->where('slug', $slug)->with($with)->first();

		return $query->where('slug', $slug)->first();
	}

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
			$this->attributes['slug'] = snake_case($value);
		else
			$this->attributes['slug'] = snake_case($this->$title);
	}

} 
