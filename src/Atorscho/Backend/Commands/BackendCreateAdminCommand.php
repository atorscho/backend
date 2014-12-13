<?php namespace Atorscho\Backend\Commands;

use Config;
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
		$username  = $this->ask('Choose a username:');
		$email     = $this->ask('Enter your valid email address:');
		$password  = $this->secret('And now your password:');
		$password2 = $this->secret('Confirm your password:');

		// Check for password confirmation
		if ( $password !== $password2 )
		{
			$this->error('Your passwords do not match. Try again.');
			$this->fire();
		}

		// Add to DB
		$user           = new User;
		$user->username = $username;
		$user->email    = $email;
		$user->password = $password;
		$user->save();

		// Add to the Super-admins group
		$user->groups()->attach(Config::get('backend::users.groups.superadmins'));

		$this->info('You have successfully created a new super-admin account.');
	}

}
