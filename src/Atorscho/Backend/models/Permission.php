<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleAttributeTrait;

class Permission extends BaseModel {

	use HandleAttributeTrait;

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
