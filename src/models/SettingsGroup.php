<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleTrait;

class SettingsGroup extends BaseModel {

	use HandleTrait;

	protected $fillable = [];

	public $timestamps = false;

	public function settings()
	{
		return $this->hasMany('Atorscho\Backend\Models\Setting', 'group_id');
	}

}
