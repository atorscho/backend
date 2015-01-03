<?php namespace Atorscho\Backend\Helpers;

// todo - replace table headings by proper method

/**
 * Class TemplateHelper
 *
 * Template helper class to easily create layout elements of the Backend.
 *
 * @package Atorscho\Backend\Helpers
 */
class TemplateHelper {

	/**
	 * Open the main <div> block.
	 *
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
	 *
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
	 *
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
	 *
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
	 *
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
	 *
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
	public function tableHeadings($rows)
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
			$output .= '<th' . (($classes) ? ' class="' . $classes . '"' : '') . '>' . $title . '</th>';
		}


		$output .= '</tr></thead><tfoot><tr>';

		// The same as above but for <tfoot>.
		foreach ( $rows as $title => $classes )
		{
			$classes = preg_replace('/( ?width-.+)/', '', $classes);
			$output .= '<th' . (($classes) ? ' class="' . $classes . '"' : '') . '>' . $title . '</th>';
		}

		$output .= '</tr></tfoot>';

		return $output;
	}

}
