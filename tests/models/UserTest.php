<?php

use Atorscho\Backend\Models\User;

class UserTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		Eloquent::unguard();
		$this->prepareDb();
	}

	public function truncate()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		// Empty 'users' table
		User::truncate();

		// Empty 'group_user' table
		DB::table('group_user')->truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

	public function testCanCreateUser()
	{
		$this->truncate();

		$user = User::create([
			'username'   => 'Alexxali',
			'email'      => 'contact@alextorscho.com',
			'password'   => 'pass',
			'first_name' => 'Alex',
			'last_name'  => 'Torscho',
			'birthday'   => '1994-09-11',
			'gender'     => 'M'
		]);

		$this->assertNotNull($user);

		return $user;
	}

	/**
	 * @param User $user
	 *
	 * @depends testCanCreateUser
	 */
	public function testCanAttachUserToTheSuperAdminGroup( $user )
	{
		$user->groups()->attach(5);
		$groups = $user->groups;

		$this->assertNotNull($groups);
	}

	/**
	 * @param User $user
	 *
	 * @depends testCanCreateUser
	 */
	public function testCanReturnFullNameAttribute( $user )
	{
		$this->assertEquals('Alex Torscho', $user->full_name);
	}

	/**
	 * @param User $user
	 *
	 * @depends testCanCreateUser
	 */
	public function testPasswordIsHashed( $user )
	{
		$this->assertTrue(Hash::check('pass', $user->password));
	}

	public function testBirthdayAndCreatedAtTimestampAreWellFormattedAccordingToSQLDateFormat()
	{
		$user = User::create([
			'username' => 'Testing birthday',
			'email'    => 'testbirthday@example.com',
			'password' => 'testpass',
			'birthday' => 'September 11 1994'
		]);
		$user->groups()->attach(1);

		$this->assertEquals('1994-09-11', $user->birthday);

		$user = User::create([
			'username'   => 'Testing CreatedAt',
			'email'      => 'testcreatedat@example.com',
			'password'   => 'createdatpass',
			'created_at' => '2014/11/09, 1:21 PM'
		]);
		$user->groups()->attach(1);

		$this->assertEquals('2014-11-09 13:21:00', $user->created_at);
	}

	/**
	 * @param User $user
	 *
	 * @depends testCanCreateUser
	 */
	public function testUserIsInGroup( $user )
	{
		$this->assertTrue($user->in('superadmins'));
	}

	public function testUserIsNotInGroup()
	{
		$user = User::find(2);

		$this->assertFalse($user->in('admins'));

		return $user;
	}

	/**
	 * @param User $user
	 *
	 * @depends testUserIsNotInGroup
	 */
	public function testUserCanDoSomeAction( $user )
	{
		$this->assertTrue($user->can('showUsers'));
	}

	/**
	 * @param User $user
	 *
	 * @depends testUserIsNotInGroup
	 */
	public function testUserCanNotDoSomeAction( $user )
	{
		$this->assertFalse($user->can('createUsers'));
	}

}
