<?php namespace Atorscho\Backend\Helpers;

use Illuminate\Session\Store;
use Lang;
use Session;
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
	 */
	public function success( $text )
	{
		$this->flash($text, 'success', 'check');
	}

	/**
	 * Information Flash Message.
	 *
	 * @param string $text
	 */
	public function info( $text )
	{
		$this->flash($text, 'info', 'info');
	}

	/**
	 * Warning Flash Message.
	 *
	 * @param string $text
	 */
	public function warning( $text )
	{
		$this->flash($text, 'warning', 'warning');
	}

	/**
	 * Danger Flash Message.
	 *
	 * @param string $text
	 */
	public function danger( $text )
	{
		$this->flash($text, 'danger', 'times-circle');
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
	 * @param $text
	 * @param $type
	 * @param $icon
	 */
	private function flash( $text, $type, $icon )
	{
		if ( Lang::has("backend::messages.{$text}") )
			$text = trans("backend::messages.{$text}");

		$this->session->flash('alert.type', $type);
		$this->session->flash('alert.icon', $icon);
		$this->session->flash('alert.text', $text);
	}

}
