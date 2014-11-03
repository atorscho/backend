<?php namespace Atorscho\Backend;

class Setting extends BaseModel {

	protected $fillable = ['value'];

	public $timestamps = false;

	public function group()
	{
		return $this->belongsTo('SettingsGroup');
	}

}
