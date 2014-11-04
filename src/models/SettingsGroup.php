<?php namespace Atorscho\Backend\Models;

class SettingsGroup extends BaseModel {

	protected $fillable = [];

	public $timestamps = false;

	public function settings()
	{
		return $this->hasMany('Atorscho\Backend\Models\Setting');
	}

}
