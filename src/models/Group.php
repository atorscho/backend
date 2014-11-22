<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\HandleTrait;

class Group extends BaseModel {

	use HandleTrait;

	protected $fillable = ['name', 'handle', 'prefix', 'suffix'];

	public $timestamps = false;


	/**
	 * Get group's permissions.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Permission');
	}


	/**
	 * Get members of the group.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User');
	}


	/**
	 * Return number of group's members.
	 *
	 * @return mixed
	 */
	public function getUsersCountAttribute()
	{
		return $this->users()->count();
	}

}
