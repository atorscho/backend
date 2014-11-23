<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;

class SettingsGroup extends BaseModel {

	use HandleAttributeTrait;

	protected $fillable = [];

	public $timestamps = false;

	public function settings()
	{
		return $this->hasMany('Atorscho\Backend\Models\Setting', 'group_id');
	}

}
