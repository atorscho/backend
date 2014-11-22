<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleTrait;

class Permission extends BaseModel {

	use HandleTrait;

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
