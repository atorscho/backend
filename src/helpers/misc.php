<?php

use Atorscho\Backend\Models\Setting;

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
	 * @return \Illuminate\Database\Eloquent\Model|null|static
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
