<?php namespace Atorscho\Backend\Helpers;

// todo - replace table headings by proper method
use Input;
use Route;

/**
 * Class TemplateHelper
 * Template helper class to easily create layout elements of the Backend.
 *
 * @package Atorscho\Backend\Helpers
 */
class TemplateHelper {

	/**
	 * Open the main <div> block.
	 * Default: <div class="blok"><div class="row">
	 *
	 * @return string
	 */
	public function openBlok()
	{
		return '<div class="blok"><div class="row">';
	}

	/**
	 * Close the main <div> block.
	 * Default: </div></div>
	 *
	 * @return string
	 */
	public function closeBlok()
	{
		return '</div></div>';
	}

	/**
	 * Open the sidebar inside the main <div> block.
	 * Default: <div class="col-md-3"><aside class="sidebar">
	 *
	 * @return string
	 */
	public function openBlokSidebar()
	{
		return '<div class="col-md-3"><aside class="sidebar">';
	}

	/**
	 * Close the sidebar inside the main <div> block.
	 * Default: </aside></div>
	 *
	 * @return string
	 */
	public function closeBlokSidebar()
	{
		return '</aside></div>';
	}

	/**
	 * Open the main content block.
	 * Default: <div class="col-md-9">
	 *
	 * @return string
	 */
	public function openBlokContent()
	{
		return '<div class="col-md-9">';
	}

	/**
	 * Close the main content block.
	 * Default: </div>
	 *
	 * @return string
	 */
	public function closeBlokContent()
	{
		return '</div>';
	}

	/**
	 * Outputs HTML <thead> and <tfoot> blocks for table.
	 *
	 * @param $rows
	 *
	 * @return string
	 */
	public function tableHeadings( $rows )
	{
		$rows = (array) $rows;

		// If row title is in value position, move it to the key position and replace by an empty string.
		foreach ( $rows as $key => $row )
		{
			if ( is_numeric($key) )
			{
				$rows[array_pull($rows, $key)] = '';
			}
			else
			{
				unset( $rows[$key] );
				$rows[$key] = trim($row);
			}
		}

		$output = '';

		$output .= '<thead><tr>';

		// Create <thead> rows with classes and titles.
		foreach ( $rows as $title => $classes )
		{
			$output .= '<th' . ( ( $classes ) ? ' class="' . $classes . '"' : '' ) . '>' . $title . '</th>';
		}


		$output .= '</tr></thead><tfoot><tr>';

		// The same as above but for <tfoot>.
		foreach ( $rows as $title => $classes )
		{
			$classes = preg_replace('/( ?width-.+)/', '', $classes);
			$output .= '<th' . ( ( $classes ) ? ' class="' . $classes . '"' : '' ) . '>' . $title . '</th>';
		}

		$output .= '</tr></tfoot>';

		return $output;
	}

	/**
	 * Creates a parameter switcher.
	 * e.g. Show only trashed records or not.
	 *
	 * @param string|array $title    Title. If a title key exists in lang/labels.php, it will use it, otherwise the specified string.
	 *                               If the translation has parameters, put everything in the array so that: [$title, 'key' => 'Value', etc].
	 * @param string       $paramKey Parameter key that will be put in the URI. e.g. 'trashed' in 'trashed=yes'
	 * @param array        $options  List of parameters. e.g. ['no', 'yes'] for 'trashed=no' and 'trashed=yes'.
	 *
	 * @return string
	 */
	public function pageParams( $title, $paramKey, $options )
	{
		$parameters = [ ];

		// Include route parameters
		$routes = Route::current()->parameterNames();
		foreach ( $routes as $route )
			$parameters[] = Route::current()->getParameter($route)->slug;

		// Include current params to the parameters array.
		$parameters = array_merge($parameters, Input::all());

		$transParams = [ ];
		// Get the first element of the array to use it as a title.
		if ( is_array($title) )
			$title = array_shift($title);
		$title = transIfExists($title, $transParams);

		$output = '<div class="margin-t-10"><strong>' . $title . '</strong></div>';
		$output .= '<div class="margin-t-5"><div class="btn-group btn-group-sm">';

		foreach ( $options as $paramHandle => $paramName )
		{
			$paramHandle = is_numeric($paramName) ? $paramName : $paramHandle;

			$parameters[$paramKey] = $paramHandle;

			$output .= '<a class="btn btn-default ' . ( ( Input::get($paramKey) == $paramHandle || ( !Input::has($paramKey) && array_values($options)[0] == $paramName ) ) ? 'active' : '' ) . '" href="' . route(Route::current()->getName(), $parameters) . '">';
			$output .= ( is_numeric($paramName) ) ? $paramName : ucfirst($paramName);
			$output .= '</a>';
		}

		$output .= '</div></div>';

		return $output;
	}

	/**
	 * Creates controls for per page records links.
	 *
	 * @param array $options List of parameters.
	 *
	 * @return string
	 */
	public function perPageRecordsParams( $options = [ 10, 20, 30, 40 ] )
	{
		return $this->pageParams('perPage', 'perPage', $options);
	}

}
