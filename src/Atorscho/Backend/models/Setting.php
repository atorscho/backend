<?php namespace Atorscho\Backend\Models;

class Setting extends BaseModel {

	protected $fillable = [ 'value' ];

	public $timestamps = false;

	/**
	 * When creating a setting, fill up the 'default' column with 'value'.
	 */
	protected static function boot()
	{
		parent::boot();

		static::creating(function ( $setting )
		{
			$setting->default = $setting->value;
		});
	}

	/**
	 * Get the setting by its handle.
	 *
	 * @param $handle
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function handle( $handle )
	{
		return $this->where('handle', $handle)->first();
	}

	/**
	 * Get the group the settings belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group()
	{
		return $this->belongsTo('Atorscho\Backend\Models\SettingsGroup');
	}

}
