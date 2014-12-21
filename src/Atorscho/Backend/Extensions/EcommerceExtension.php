<?php namespace Atorscho\Backend\Extensions;

class EcommerceExtension extends Extension {

	public $enabled = true;

	public $name = 'Ecommerce';

	public $service = 'Amroll\Ecommerce\EcommerceServiceProvider';

	public $uri = 'ecommerce';

	public $route = 'ecommerce.index';

	public $icon = 'shopping-cart';

}
