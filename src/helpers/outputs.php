<?php

if ( !function_exists('userFieldInput') )
{
	/**
	 * @param \Atorscho\Backend\Models\UserField $field
	 * @param \Atorscho\Backend\Models\User|null $user
	 *
	 * @return string
	 */

	// <input type="{{ $field->type }}" class="form-control" id="fields[{{ $field->id }}]" name="fields[{{ $field->id }}]" value="{{ isset($user) && isset($user->fields()->find($field->id)->value) ? $user->fields()->find($field->id)->value : '' }}" placeholder="{{ $field->placeholder ?: $field->name }}" tabindex="{{ index() }}" {{ $field->required ? 'required="true"' : '' }} {{ $field->pattern ? "pattern=\"{$field->pattern}\"" : '' }} />
	function userFieldInput( $field, $user = null )
	{
		$output = '';

		$id        = 'fields[' . $field->id . ']';
		$tabindex  = 'tabindex="' . index() . '"';

		$class     = 'class="form-control"';
		$value     = 'value="' . ( isset( $user ) && isset( $user->fields()->find($field->id)->value ) ? $user->fields()->find($field->id)->value : '' ) . '"';
		$title     = $field->placeholder ?: $field->name;

		$required  = $field->required ? 'required="true"' : '';
		$min       = $field->min ? 'min="' . $field->min . '"' : '';
		$max       = $field->max ? 'max="' . $field->max . '"' : '';
		$step      = $field->step ? 'step="' . $field->step . '"' : '';
		$maxlength = $field->maxlength ? 'maxlength="' . $field->maxlength . '"' : '';
		$pattern   = $field->pattern ? 'pattern="' . $field->pattern . '"' : '';

		if ( $field->type == 'textarea' )
		{
			// todo - <textarea> case
			$rows = $field->rows ? 'rows="' . $field->rows . '"' : '';
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

			$output = "<input $type $class id=\"$id\" name=\"$id\" placeholder=\"$title\" $value $tabindex $required $min $max $step $maxlength $pattern />";
			$output = preg_replace('/\s+/', ' ', $output);
		}

		return $output;
	}
}

if ( !function_exists('flash') )
{
	/**
	 * Outputs an alert message using a Flash Data.
	 * Used Bootstrap style.
	 *
	 * @return bool|string
	 */
	function flash()
	{
		if ( Session::has('success') )
			$data = 'success';
		elseif ( Session::has('info') )
			$data = 'info';
		elseif ( Session::has('warning') )
			$data = 'warning';
		elseif ( Session::has('danger') )
			$data = 'danger';
		if ( isset( $data ) )
		{
			$output = '<div class="alert alert-' . $data . '">';
			$output .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
			$output .= '<i class="fa fa-fw fa-2x pull-left fa-';
			if ( $data == 'success' )
				$output .= 'check';
			elseif ( $data == 'danger' )
				$output .= 'times-circle';
			else
				$output .= $data;
			$output .= '"></i>';
			$output .= Session::get($data);
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}
