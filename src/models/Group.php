<?php namespace Atorscho\Backend\Models;

class Group extends BaseModel {

	protected $fillable = ['name', 'handle', 'prefix', 'suffix'];

	public $timestamps = false;

	public function permissions()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Permission');
	}

	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User');
	}

}
