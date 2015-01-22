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
	 * @param string $value
	 */
	public function setSlugAttribute( $value )
	{
		if ( $value )
			$this->attributes['slug'] = \Str::slug($value);
		else
			$this->attributes['slug'] = \Str::slug($this->title ?: $this->name);
	}

} 
