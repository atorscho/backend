<?php namespace Atorscho\Backend\Models;

class Field extends BaseModel {

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

	public function group()
	{
		return $this->belongsTo('Atorscho\Backend\Models\FieldGroup');
	}

	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User', 'user_fields');
	}

}
