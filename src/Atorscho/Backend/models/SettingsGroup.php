<?php namespace Atorscho\Backend\Models;


use Atorscho\Backend\Traits\SlugAttributeTrait;

class SettingsGroup extends BaseModel {

	use SlugAttributeTrait;

	protected $fillable = [];

	public $timestamps = false;

	public function settings()
	{
		return $this->hasMany('Atorscho\Backend\Models\Setting', 'group_id');
	}

}
