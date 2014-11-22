<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleTrait;

class UserFieldGroup extends BaseModel {

	use HandleTrait;

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
