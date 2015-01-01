<?php namespace Atorscho\Backend\Helpers;

use Illuminate\Session\Store;
use Lang;
use View;

/**
 * Class FlashHelper
 * Four main methods for Flash messages: success, info, warning and danger.
 * All are integrated into Bootstrap Alerts.
 *
 * @package Atorscho\Backend\Helpers
 */
class FlashHelper {

	/**
	 * Session class.
	 *
	 * @var
	 */
	private $session;

	public function __construct( Store $session )
	{
		$this->session = $session;
	}

	/**
	 * Success Flash Message.
	 *
	 * @param string $text
	 * @param array  $parameters
	 */
	public function success( $text, $parameters = array() )
	{
		$this->flash($text, 'success', 'check', $parameters);
	}

	/**
	 * Information Flash Message.
	 *
	 * @param string $text
	 * @param array  $parameters
	 */
	public function info( $text, $parameters = array() )
	{
		$this->flash($text, 'info', 'info', $parameters);
	}

	/**
	 * Warning Flash Message.
	 *
	 * @param string $text
	 * @param array  $parameters
	 */
	public function warning( $text, $parameters = array() )
	{
		$this->flash($text, 'warning', 'warning', $parameters);
	}

	/**
	 * Danger Flash Message.
	 *
	 * @param string $text
	 * @param array  $parameters
	 */
	public function danger( $text, $parameters = array() )
	{
		$this->flash($text, 'danger', 'times-circle', $parameters);
	}

	/**
	 * Outputs the Flash message into the template.
	 *
	 * @return string
	 */
	public function message()
	{
		$data = [
			'type' => $this->session->get('alert.type'),
			'icon' => $this->session->get('alert.icon'),
			'text' => $this->session->get('alert.text')
		];

		return View::make('backend::partials.layouts._flash', $data)->render();
	}

	/**
	 * Flash base.
	 *
	 * @param       $text
	 * @param       $type
	 * @param       $icon
	 * @param array $parameters
	 */
	private function flash( $text, $type, $icon, $parameters = array() )
	{
		if ( Lang::has("backend::messages.{$text}") )
			$text = trans("backend::messages.{$text}", $parameters);

		$this->session->flash('alert.type', $type);
		$this->session->flash('alert.icon', $icon);
		$this->session->flash('alert.text', $text);
	}

}
