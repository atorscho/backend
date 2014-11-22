<?php namespace Atorscho\Backend\Models;

class UserField extends BaseModel {

	protected $fillable = [
		'group_id',
		'type',
		'name',
		'handle',
		'placeholder',
		'required',
		'min',
		'max',
		'step',
		'maxlength',
		'pattern'
	];

	public $timestamps = false;

	/**
	 * Return the User Field Group the field belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group()
	{
		return $this->belongsTo('Atorscho\Backend\Models\UserFieldGroup');
	}


	/**
	 * Return users that have filled up current field.
	 *
	 * @return $this
	 */
	public function users()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\User', 'user_fields_pivot', 'field_id', 'user_id')->withPivot('value');
	}


	// todo - translate
	/**
	 * Return a type name attribute.
	 *
	 * @return string
	 */
	public function getTypeNameAttribute()
	{
		switch ( $this->type )
		{
			case 'text':
				return 'Text Field';
			case 'textarea':
				return 'Text Box';
			case 'url':
				return 'URL';
			case 'search':
				return 'Search Box';
			case 'email':
				return 'Email';
			case 'password':
				return 'Password';
			default:
				return 'Input';
		}
	}

}
