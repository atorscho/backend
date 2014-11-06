<?php namespace Atorscho\Backend\Models;

class Usermeta extends BaseModel {

	protected $table = 'usermeta';

	protected $fillable = ['user_id', 'name', 'handle', 'value'];

	public function user()
	{
		return $this->belongsTo('\Atorscho\Backend\Models\User');
	}

}
