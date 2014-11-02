<?php

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
