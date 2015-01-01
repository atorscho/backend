<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;
use Atorscho\Backend\Traits\OrderAttributeTrait;
use Atorscho\Backend\Traits\TypeNameAttributeTrait;

class ContentField extends BaseModel {

	use HandleAttributeTrait, OrderAttributeTrait, TypeNameAttributeTrait;

	protected $fillable = [
		'content_type_id',
		'type',
		'name',
		'handle',
		'description',
		'required',
		'min',
		'max',
		'step',
		'rows',
		'maxlength',
		'pattern',
		'order'
	];

	public $timestamps = false;

	/**
	 * Return the Content Type the field belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function type()
	{
		return $this->belongsTo('Atorscho\Backend\Models\ContentType');
	}

}
