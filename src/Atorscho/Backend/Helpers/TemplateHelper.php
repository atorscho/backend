<?php namespace Atorscho\Backend\Helpers;

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

	public function tableHeadings($rows)
	{
		$rows = (array) $rows;

		foreach ( $rows as $key => $row )
		{
			if ( is_numeric($key) )
			{
				$rows[array_pull($rows, $key)] = '';
			}
			else
			{
				unset( $rows[$key] );
				$rows[$key] = $row;
			}
		}

		return $rows;
	}

}
