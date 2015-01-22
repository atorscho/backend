<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;
use Atorscho\Backend\Traits\OrderAttributeTrait;

class UserFieldGroup extends BaseModel {

	use HandleAttributeTrait, OrderAttributeTrait;

	protected $fillable = ['name', 'handle', 'order'];

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
