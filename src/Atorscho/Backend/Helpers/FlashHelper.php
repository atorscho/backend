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
	 * @param string $text       Translation key or the actual message text.
	 * @param string $package    Package to which the translation belongs to. Empty for no package.
	 * @param array  $parameters Array of translation parameters.
	 */
	public function success( $text, $package = 'backend', $parameters = array() )
	{
		$this->flash($text, 'success', 'check', $package, $parameters);
	}

	/**
	 * Information Flash Message.
	 *
	 * @param string $text       Translation key or the actual message text.
	 * @param string $package    Package to which the translation belongs to. Empty for no package.
	 * @param array  $parameters Array of translation parameters.
	 */
	public function info( $text, $package = 'backend', $parameters = array() )
	{
		$this->flash($text, 'info', 'info', $package, $parameters);
	}

	/**
	 * Warning Flash Message.
	 *
	 * @param string $text       Translation key or the actual message text.
	 * @param string $package    Package to which the translation belongs to. Empty for no package.
	 * @param array  $parameters Array of translation parameters.
	 */
	public function warning( $text, $package = 'backend', $parameters = array() )
	{
		$this->flash($text, 'warning', 'warning', $package, $parameters);
	}

	/**
	 * Danger Flash Message.
	 *
	 * @param string $text       Translation key or the actual message text.
	 * @param string $package
	 * @param string $package    Package to which the translation belongs to. Empty for no package.
	 * @param array  $parameters Array of translation parameters.
	 */
	public function danger( $text, $package = 'backend', $parameters = array() )
	{
		$this->flash($text, 'danger', 'times-circle', $package, $parameters);
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
	 * @param string $text    Translation key or the actual message text.
	 * @param string $type    May be: success, info, warning or danger.
	 * @param string $icon    Any Font-Awesome icon. e.g. 'check' for 'fa fa-check'.
	 * @param string $package Package to which the translation belongs to. Empty for no package.
	 * @param array  $parameters
	 */
	private function flash( $text, $type, $icon, $package = 'backend', $parameters = array() )
	{
		$text = transIfExists($text, $package, $parameters, 'messages');

		$this->session->flash('alert.type', $type);
		$this->session->flash('alert.icon', $icon);
		$this->session->flash('alert.text', $text);
	}

}
