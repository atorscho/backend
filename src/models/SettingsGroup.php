<?php namespace Atorscho\Backend;

class SettingsGroup extends BaseModel {

	protected $table = 'settings_groups';

	protected $fillable = [];

	public $timestamps = false;

	public function options()
	{
		return $this->hasMany('Setting');
	}

}
