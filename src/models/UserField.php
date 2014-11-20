<?php namespace Atorscho\Backend\Models;

class UserField extends BaseModel {

	protected $fillable = [
		'group_id',
		'type',
		'name',
		'handle',
		'placeholder',
		'required',
		'min',
		'max',
		'step',
		'maxlength',
		'pattern'
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
