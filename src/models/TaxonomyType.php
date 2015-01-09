<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\SlugAttributeTrait;

class TaxonomyType extends BaseModel {

	use SlugAttributeTrait;

	protected $fillable = [
		'name',
		'slug',
		'description',
		'icon',
		'hierarchical'
	];

	public $timestamps = false;

	/**
	 * The taxonomies of the type.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function taxonomies()
	{
		return $this->hasMany('Atorscho\Backend\Models\Taxonomy', 'type_id');
	}

}
