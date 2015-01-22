<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;
use Atorscho\Backend\Traits\OrderAttributeTrait;
use Atorscho\Backend\Traits\TypeNameAttributeTrait;

// todo - add <select> support

class UserField extends BaseModel {

	use HandleAttributeTrait, OrderAttributeTrait, TypeNameAttributeTrait;

	protected $fillable = [
		'group_id',
		'type',
		'name',
		'handle',
		'description',
		'required',
		'min',
		'max',
		'step',
		'pattern',
		'order'
	];

	public $timestamps = false;

	/**
	 * Return the User Field Group the field belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group()
	{
		return $this->belongsTo('Atorscho\Backend\Models\UserFieldGroup');
	}

	/**
	 * Return users that have filled up current field.
	 *
	 * @return $this
	 */
	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User', 'user_fields_pivot', 'field_id', 'user_id')->withPivot('value');
	}

}
