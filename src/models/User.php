<?php namespace Atorscho\Backend\Models;

class User extends BaseModel {

	protected $fillable = ['avatar', 'first_name', 'last_name', 'gender'];

	public function groups()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Group');
	}

	public function permissions()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Permission');
	}

}
