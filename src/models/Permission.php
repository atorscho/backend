<?php namespace Atorscho\Backend\Models;

class Permission extends BaseModel {

	protected $fillable = ['name', 'handle'];

	public $timestamps = false;

	public function groups()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Group');
	}

	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User');
	}

}
