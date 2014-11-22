<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleTrait;
use Input;

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


	public function setOrderAttribute()
	{
		if( Input::has('order'))
			$this->attributes['order'] = Input::get('order');
		else
			$this->attributes['order'] = $this->count() + 1;
	}

}
