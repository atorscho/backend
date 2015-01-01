<?php namespace Atorscho\Backend\Extensions;

class EcommerceExtension extends Extension {

	protected $enabled = true;

	protected $name = 'Ecommerce';

	protected $service = 'Amroll\Ecommerce\EcommerceServiceProvider';

	protected $uri = 'ecommerce';

	protected $route = 'ecommerce.index';

	protected $icon = 'shopping-cart';

	protected $settings = 'ecommerce';

}
