<?php

use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;

class GroupTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		Eloquent::unguard();
		$this->prepareDb();
	}

	public function testReturnUsersCount()
	{
		$user = User::create([
			'username'   => 'Alexxali',
			'email'      => 'contact@alextorscho.com',
			'password'   => 'pass',
			'first_name' => 'Alex',
			'last_name'  => 'Torscho',
			'birthday'   => '1994-09-11',
			'gender'     => 'M'
		]);
		$user->groups()->attach(5);

		$superadmins = Group::find(5);
		$members     = Group::find(1);

		$this->assertEquals(1, $superadmins->users_count);
		$this->assertEquals(0, $members->users_count);
	}

	public function testHandlesAreProperlyPopulated()
	{
		$group = Group::create([
			'name'   => 'Test Group',
			'handle' => ''
		]);

		$this->assertEquals('test-group', $group->handle);

		$group = Group::create([
			'name'   => 'Another Group',
			'handle' => 'custom-handle'
		]);

		$this->assertEquals('custom-handle', $group->handle);

		$group = Group::create([
			'name'   => 'Cases Group',
			'handle' => 'caSes  GroUP'
		]);

		$this->assertEquals('cases-group', $group->handle);
	}

}
