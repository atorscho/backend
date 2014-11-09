<?php namespace Atorscho\Backend\Tests;

class UserTest extends TestCase {

	public function setUp()
	{
		parent::setUp();

		\Artisan::call('migrate', '--bench=atorscho/backend');
	}

}
