<?php namespace Atorscho\Backend\Models;

class Setting extends BaseModel {

	protected $fillable = ['value'];

	public $timestamps = false;

	public function group()
	{
		return $this->belongsTo('Atorscho\Backend\Models\SettingsGroup');
	}

}
