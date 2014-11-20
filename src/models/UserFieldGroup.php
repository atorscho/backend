<?php namespace Atorscho\Backend\Models;

class UserFieldGroup extends BaseModel {

	protected $fillable = ['name', 'handle'];

	public $timestamps = false;

	/**
	 * Return group fields.
	 *
	 * @return $this
	 */
	public function fields()
	{
		return $this->hasMany('Atorscho\Backend\Models\UserField', 'group_id');
	}

}
