<?php

use Atorscho\Backend\Models\ContentField;
use Atorscho\Backend\Models\Setting;
use Atorscho\Backend\Models\UserField;

if ( !function_exists('toObjects') )
{
	/**
	 * Recursively convert all nested arrays to objects.
	 *
	 * @param $array
	 *
	 * @return stdClass
	 */
	function toObjects( $array )
	{
		$object = new stdClass();
		foreach ( $array as $key => $value )
		{
			$object->$key = $value;
			if ( is_array($value) )
				$object->$key = toObjects($value);
		}

		return $object;
	}
}

if ( !function_exists('getSetting') )
{
	/**
	 * Get option by its handle.
	 *
	 * @param $handle
	 *
	 * @return int|string
	 */
	function getSetting( $handle )
	{
		$setting = Setting::where('handle', $handle)->first();

		if ( !$setting )
			return false;

		return $setting->value;
	}
}

if ( !function_exists('index') )
{
	/**
	 * Returns an incremented index.
	 *
	 * @return mixed
	 */
	function index()
	{
		static $tab = 0;
		$tab++;

		return $tab;
	}
}

if ( !function_exists('getDateFormat') )
{
	/**
	 * Returns a formatted Date string,
	 * respecting the value passed in Backend Settings.
	 *
	 * @param $date
	 *
	 * @return bool|string
	 */
	function getDateFormat( $date )
	{
		return date(getSetting('dateFormat'), strtotime($date));
	}
}

if ( !function_exists('getDateTimeFormat') )
{
	/**
	 * Returns a formatted Date string,
	 * respecting the value passed in Backend Settings.
	 *
	 * @param string $dateTime
	 *
	 * @return bool|string
	 */
	function getDateTimeFormat( $dateTime )
	{
		return date(getSetting('dateTimeFormat'), strtotime($dateTime));
	}
}

if ( !function_exists('datetimePicker') )
{
	/**
	 * Used for the Bootstrap Datetime Picker jQuery Plugin.
	 *
	 * @param null $str
	 *
	 * @return string
	 */
	function datetimePicker( $str )
	{
		return date('m/d/Y g:i A', strtotime($str));
	}
}

if ( !function_exists('saveCustomField') )
{
	/**
	 * Save Custom Field.
	 *
	 * @param array  $rules        Array of current rules.
	 * @param array  $ruleFields   Array of form field names.
	 * @param array  $fieldsUpdate Fields input array.
	 * @param string $type         'user' or 'content'.
	 *
	 * @return array
	 */
	function saveCustomField( &$rules, &$ruleFields, $fieldsUpdate, $type = 'user' )
	{
		foreach ( $fieldsUpdate as $key => $value )
		{
			if ( $type == 'user' )
				$field = UserField::findHandle($key);
			else
				$field = ContentField::findHandle($key);

			if ( $field->required )
				$rules["fields.{$field->handle}"][] = 'required';
			if ( $field->min )
				$rules["fields.{$field->handle}"][] = 'min:' . $field->min;
			if ( $field->max )
				$rules["fields.{$field->handle}"][] = 'max:' . $field->max;
			if ( $field->pattern )
				$rules["fields.{$field->handle}"][] = 'regex:' . $field->pattern;

			if ( isset( $rules["fields.{$field->handle}"] ) )
				$rules["fields.{$field->handle}"] = join('|', $rules["fields.{$field->handle}"]);

			// Add new field name
			$ruleFields["fields.{$field->handle}"] = $field->name;

			// Replace handle key with its ID
			unset( $fieldsUpdate[$key] );
			if ( $value )
				$fieldsUpdate[$field->id] = [ 'value' => $value ];
		}

		return $fieldsUpdate;
	}
}

if ( !function_exists('counter') )
{
	/**
	 * Creates a counter for Pagination.
	 *
	 * @param int $perPage
	 *
	 * @return mixed
	 */
	function counter( $perPage )
	{
		return ( $perPage * ( ( Input::get('page') ?: 1 ) - 1 ) ) + 1;
	}
}

if ( !function_exists('transIfExists') )
{
	/**
	 * If a translation exists, use it, otherwise return the actual string.
	 *
	 * @param string $text       String or a translation to return.
	 * @param array  $parameters Parameters for the translation.
	 * @param string $type       Which file to use: labels.php or messages.php. Use `labels` or `messages`.
	 *
	 * @return string
	 */
	function transIfExists( $text, $parameters = array(), $type = 'labels' )
	{
		if ( Lang::has("backend::{$type}.{$text}") )
			$text = trans("backend::{$type}.{$text}", $parameters);

		return $text;
	}
}

if ( !function_exists('uploads_path') )
{
	/**
	 * Uploads folder path.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function uploads_path( $path = '' )
	{
		return public_path('uploads/' . $path);
	}
}

if ( !function_exists('newFileName') )
{
	/**
	 * Return a new name for uploaded file.
	 *
	 * @param \Symfony\Component\HttpFoundation\File\UploadedFile|array $file
	 *
	 * @return string
	 */
	function newFileName( $file )
	{
		$extension = '.' . $file->getClientOriginalExtension();
		$filename  = time() . '_' . \Str::slug(str_replace($extension, '', $file->getClientOriginalName())) . $extension;

		return $filename;
	}
}
