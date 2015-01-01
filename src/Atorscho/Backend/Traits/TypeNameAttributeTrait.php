<?php namespace Atorscho\Backend\Traits;

trait TypeNameAttributeTrait {

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
				return trans('backend::labels.inputText');
			case 'textarea':
				return trans('backend::labels.textarea');
			case 'url':
				return trans('backend::labels.url');
			case 'email':
				return trans('backend::labels.email');
			default:
				return trans('backend::labels.input');
		}
	}

} 
