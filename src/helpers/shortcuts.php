<?php

if ( !function_exists('back') )
{
	/**
	 * A shortcut for a redirect to the previous page.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	function back()
	{
		return Redirect::back();
	}
}

if ( !function_exists('to_route') )
{
	/**
	 * Redirect to the specified route.
	 *
	 * @param $route
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	function to_route( $route )
	{
		return Redirect::route($route);
	}
}
