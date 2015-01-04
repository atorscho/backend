<?php

if ( !function_exists('flash') )
{
	/**
	 * Outputs an alert message using a Flash Data.
	 *
	 * @return bool|string
	 */
	function flash()
	{
		return Flash::message();
	}
}

if ( !function_exists('userFieldInput') )
{
	/**
	 * Outputs the proper input depending on field type.
	 *
	 * @param \Atorscho\Backend\Models\UserField $field
	 * @param \Atorscho\Backend\Models\User|null $user
	 *
	 * @return string
	 */
	function userFieldInput( $field, $user = null )
	{
		$output = '';

		$id       = 'fields[' . $field->handle . ']';
		$tabindex = 'tabindex="' . index() . '"';

		$class = 'class="form-control"';
		$value = ( isset( $user ) && isset( $user->fields()->find($field->id)->value ) ? $user->fields()->find($field->id)->value : '' );
		$title = $field->placeholder ?: $field->name;

		$required  = $field->required ? 'required="true"' : '';
		$maxlength = $field->max ? 'maxlength="' . $field->max . '"' : '';
		$min       = $field->min ? 'min="' . $field->min . '"' : '';
		$max       = $field->max ? 'max="' . $field->max . '"' : '';
		$step      = $field->step ? 'step="' . $field->step . '"' : '';
		$pattern   = $field->pattern ? 'pattern="' . $field->pattern . '"' : '';

		if ( $field->type == 'textarea' )
		{
			// todo - <textarea> case
			$rows = $field->rows ? 'rows="' . $field->rows . '"' : 'rows="5"';
			$cols = $field->cols ? 'cols="' . $field->cols . '"' : '';

			$output = "<textarea $class id=\"$id\" name=\"$id\" placeholder=\"$title\" $rows $cols $tabindex $maxlength $required $pattern>$value</textarea>";
		}
		elseif ( $field->type == 'select' )
		{
			// todo - <select> case
			$class = 'class="select"';
		}
		else
		{
			// todo - <input> cases
			$type = 'type="' . $field->type . '"';

			$output = "<input $type $class id=\"$id\" name=\"$id\" placeholder=\"$title\" value=\"$value\" $tabindex $min $max $step $maxlength $required $pattern />";
		}

		// Remove repeating whitespace
		$output = preg_replace('/\s+/', ' ', $output);

		return $output;
	}
}
