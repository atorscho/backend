<?php namespace Atorscho\Backend\Commands;

use Illuminate\Console\Command;
use Hash;
use Atorscho\Backend\Models\User;

class BackendCreateAdminCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'backend:admin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a super administrator.';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// todo - translate
		$username = $this->ask('Choose a username:');
		$email    = $this->ask('Enter your valid email address:');
		$password = $this->ask('And now your password:');

		$user           = new User;
		$user->username = $username;
		$user->email    = $email;
		$user->password = Hash::make($password);
		$user->save();

		// Add to the Super-admins group
		$user->groups()->attach(5);

		// todo - translate
		$this->info('You have successfully created a new super-admin account.');
	}

}
