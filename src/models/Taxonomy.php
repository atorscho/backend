<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\OrderAttributeTrait;
use Atorscho\Backend\Traits\SlugAttributeTrait;

class Taxonomy extends BaseModel {

	use OrderAttributeTrait, SlugAttributeTrait;

	protected $fillable = [
		'type_id',
		'parent_id',
		'title',
		'slug',
		'order'
	];

	public $timestamps = false;

	/**
	 * The list of taxonomy's contents.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function contents()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Content');
	}

	/**
	 * The type of the taxonomy.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function taxonomyType()
	{
		return $this->belongsTo('Atorscho\Backend\Models\TaxonomyType', 'type_id');
	}

}
