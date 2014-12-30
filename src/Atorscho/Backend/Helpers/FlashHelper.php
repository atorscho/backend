<?php namespace Atorscho\Backend\Helpers;

use Illuminate\Session\Store;
use Lang;
use Session;
use View;

/**
 * Class FlashHelper
 *
 * Four main methods for Flash messages: success, info, warning and danger.
 * All are integrated into Bootstrap Alerts.
 *
 * @package Atorscho\Backend\Helpers
 */
class FlashHelper {

	/**
	 * Type of the message.
	 *
	 * @var string
	 */
	public $type = '';

	/**
	 * Proper Font-Awesome icon for current message type.
	 *
	 * @var string
	 */
	public $icon = '';

	/**
	 * Actual Flash message.
	 *
	 * @var string
	 */
	public $message = '';

	/**
	 * Session class.
	 *
	 * @var
	 */
	private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}

	/**
	 * Success Flash Message.
	 *
	 * @param string $message
	 */
	public function success( $message )
	{
		$this->flash($message, 'success', 'check');
	}

	/**
	 * Information Flash Message.
	 *
	 * @param string $message
	 */
	public function info( $message )
	{
		$this->flash($message, 'info', 'info');
	}

	/**
	 * Warning Flash Message.
	 *
	 * @param string $message
	 */
	public function warning( $message )
	{
		$this->flash($message, 'warning', 'warning');
	}

	/**
	 * Danger Flash Message.
	 *
	 * @param string $message
	 */
	public function danger( $message )
	{
		$this->flash($message, 'danger', 'times-circle');
	}

	/**
	 * Outputs the Flash message into the template.
	 *
	 * @return string
	 */
	public function message()
	{
		$data = [
			'type'    => $this->type,
			'icon'    => $this->icon,
			'message' => $this->message
		];

		return View::make('backend::partials.layouts._flash', $data)->render();
	}

	/**
	 * Flash base.
	 *
	 * @param $message
	 * @param $type
	 * @param $icon
	 */
	private function flash($message, $type, $icon)
	{
		if ( Lang::has("backend::messages.{$message}") )
			$message = trans("backend::messages.{$message}");

		if($this->session->has($type))
		{
			$this->type    = $type;
			$this->icon    = $icon;
			$this->message = $message;
		}

		$this->session->flash($type, $message);

	}

}
