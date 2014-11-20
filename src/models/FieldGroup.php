<?php namespace Atorscho\Backend\Models;

class FieldGroup extends BaseModel {

	protected $fillable = ['name', 'handle'];

	public $timestamps = false;

	public function fields()
	{
		return $this->hasMany('Atorscho\Backend\Models\Field');
	}

}
