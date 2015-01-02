<?php namespace Atorscho\Backend\Models;

use Atorscho\Backend\Traits\OrderAttributeTrait;
use Atorscho\Backend\Traits\SlugAttributeTrait;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Content extends BaseModel {

	use OrderAttributeTrait, SlugAttributeTrait, SoftDeletingTrait;

	protected $fillable = [
		'type_id',
		'title',
		'slug',
		'published',
		'order'
	];

	/**
	 * Fill `created_by` and `updated_by` columns on proper events.
	 */
	protected static function boot()
	{
		parent::boot();

		static::creating(function ($content)
		{
			$content->created_by = Auth::id();
			$content->updated_by = Auth::id();
		});

		static::updating(function ($content)
		{
			$content->updated_by = Auth::id();
		});
	}

	/**
	 * Return the Content Type the field belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function contentType()
	{
		return $this->belongsTo('Atorscho\Backend\Models\ContentType', 'type_id');
	}

	/**
	 * Get the content's fields.
	 *
	 * @return $this
	 */
	public function fields()
	{
		return $this->belongsToMany('Atorscho\Backend\Models\ContentField', 'contents_pivot', 'content_id', 'field_id')->withPivot('value');
	}

	/**
	 * The person who created the content.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function creator()
	{
		return $this->belongsTo('Atorscho\Backend\Models\User', 'created_by');
	}

	/**
	 * The person who updated the content.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function updator()
	{
		return $this->belongsTo('Atorscho\Backend\Models\User', 'updated_by');
	}

	/**
	 * The person who deleted the content.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function deletor()
	{
		return $this->belongsTo('Atorscho\Backend\Models\User', 'deleted_by');
	}

}
