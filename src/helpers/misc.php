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
		return Setting::where('handle', $handle)->first()->value;
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

if ( !function_exists('getDate') )
{
	/**
	 * Returns a formatted Date string,
	 * respecting the value passed in Backend Settings.
	 *
	 * @param $date
	 *
	 * @return bool|string
	 */
	function getDate( $date )
	{
		return date(getSetting('dateFormat'), strtotime($date));
	}
}

if ( !function_exists('getDateTime') )
{
	/**
	 * Returns a formatted Date string,
	 * respecting the value passed in Backend Settings.
	 *
	 * @param string $dateTime
	 *
	 * @return bool|string
	 */
	function getDateTime( $dateTime )
	{
		return date(getSetting('dateTimeFormat'), strtotime($dateTime));
	}
}
