<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;

class ContentType extends BaseModel {

	use HandleAttributeTrait;

	protected $fillable = [
		'name',
		'handle'
	];

	public $timestamps = false;

	/**
	 * Return the fields that belongs to the current content type.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function fields()
	{
		return $this->hasMany('Atorscho\Backend\Models\ContentField');
	}

}
