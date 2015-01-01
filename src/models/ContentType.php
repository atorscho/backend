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
	 * Get the values of the content's fields.
	 *
	 * @return $this
	 */
	public function contents()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\ContentField', 'contents', 'type_id', 'field_id')->withPivot('value');
	}

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
