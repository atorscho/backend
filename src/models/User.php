<?php namespace Atorscho\Backend\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * Protection from mass assignment.
	 *
	 * @var array.
	 */
	protected $fillable = [
		'username',
		'email',
		'password',
		'avatar',
		'first_name',
		'last_name',
		'birthday',
		'gender',
		'created_at'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];


	/**
	 * Return user's groups.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Group');
	}


	/**
	 * Return user's permissions that he gets from groups and
	 * from its own permissions.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\Permission');
	}


	/**
	 * Return user's full name.
	 *
	 * @return bool|string
	 */
	public function getFullNameAttribute()
	{
		if ( $this->first_name && $this->last_name )
			return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
		elseif ( $this->first_name )
			return ucfirst($this->first_name);
		elseif ( $this->last_name )
			return ucfirst($this->last_name);
		else
			return false;
	}


	/**
	 * Automatically hash user password.
	 *
	 * @param $value
	 */
	public function setPasswordAttribute( $value )
	{
		$this->attributes['password'] = \Hash::make($value);
	}


	/**
	 * Ensure that the saved format is SQL Date.
	 *
	 * @param $value
	 */
	public function setBirthdayAttribute( $value )
	{
		$this->attributes['birthday'] = date('Y-m-d', strtotime($value));
	}


	/**
	 * Ensure that the saved format is SQL Datetime.
	 *
	 * @param $value
	 */
	public function setCreatedAtAttribute( $value )
	{
		$this->attributes['created_at'] = date('Y-m-d H:i:s', $value ? strtotime($value) : time());
	}


	/**
	 * The same as $user->groups->implode('name', ', '),
	 * but with links to group show routes.
	 *
	 * @return string
	 */
	public function groupsAnchorList()
	{
		$list = array();

		foreach ( $this->groups as $group )
		{
			$list[] = sprintf('<a href="%s">%s</a>', route('admin.groups.show', $group->id), $group->name);
		}

		return implode(', ', $list);
	}


	/**
	 * Check whether user has specific permission.
	 * Specify permission handle.
	 *
	 * @param $can_perm
	 *
	 * @return bool
	 */
	public function can( $can_perm )
	{
		// First check for user's group permissions
		foreach ( $this->groups as $group )
		{
			// Iterate through all role's permissions
			foreach ( Group::find($group->id)->permissions as $permission )
			{
				if ( $permission->handle == $can_perm )
					return true;
			}
		}

		// Now check for user's own permissions
		if ( $this->permissions->toArray() )
		{
			foreach ( $this->permissions as $permission )
			{
				if ( is_numeric($can_perm) && $permission->id == $can_perm )
					return true;
				else if ( $permission->handle == $can_perm )
					return true;
			}
		}

		return false;
	}


	/**
	 * Chech whether user is in specified group.
	 * You may specify group handle or an array of group handles.
	 *
	 * @param $in_group
	 *
	 * @return bool
	 */
	public function in( $in_group )
	{
		foreach ( $this->groups as $group )
		{
			if ( is_numeric($in_group) && $group->id == $in_group )
				return true;
			else if ( $group->handle == $in_group )
				return true;
		}

		return false;
	}


	public function getRememberToken()
	{
		return $this->remember_token;
	}


	public function setRememberToken( $value )
	{
		$this->remember_token = $value;
	}


	public function getRememberTokenName()
	{
		return 'remember_token';
	}

}
