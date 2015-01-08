<?php namespace Atorscho\Backend\Commands;

use Artisan;
use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Validator;

class BackendInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'backend:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install The Backend including all its migrations and settings.';

	/**
	 * @var Artisan
	 */
	protected $artisan;

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var Group
	 */
	private $group;

	/**
	 * Create a new command instance.
	 *
	 * @param \Illuminate\Foundation\Artisan $artisan
	 * @param User                           $user
	 * @param Group                          $group
	 */
	public function __construct( \Illuminate\Foundation\Artisan $artisan, User $user, Group $group )
	{
		parent::__construct();

		$this->artisan = $artisan;
		$this->user    = $user;
		$this->group   = $group;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->installBaseSystems();

		$this->createSuperAdmin();

		// 3. Demo content
		// todo - Demo content seeder
		if ( $this->option('resources') )
		{

		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('resources', 'r', InputOption::VALUE_NONE, 'Also install all demo content for testing purposes.', null),
		);
	}

	/**
	 * Migrations & Groups & Permissions & Settings
	 */
	protected function installBaseSystems()
	{
		// todo - ensure that this functions for package

		// 1. Run migrations first.
		$this->artisan->call('migrate', [ '--bench' => 'atorscho/backend' ]);
		$this->output->write('<comment>.</comment>');

		// 2. Seed most important DB tables.
		$this->output->write('<comment>.</comment>');

		// 2.1 Settings and Setting Groups
		$this->artisan->call('db:seed', [ '--class' => 'BackendSettingsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// 2.2 Groups & Permissions
		$this->artisan->call('db:seed', [ '--class' => 'BackendGroupsSeeder' ]);
		$this->output->write('<comment>.</comment>');
		$this->artisan->call('db:seed', [ '--class' => 'BackendPermissionsSeeder' ]);
		$this->output->write('<comment>.</comment>');
		$this->artisan->call('db:seed', [ '--class' => 'BackendUserFieldsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// 2.3 Content Types & Content Fields
		$this->artisan->call('db:seed', [ '--class' => 'BackendContentsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// End with a newline.
		$this->output->write("\n");

		$this->info('1. Setting, User and Content systems have been installed.');
	}

	/**
	 * Create a Super-Admin user.
	 */
	protected function createSuperAdmin()
	{
		$this->line('----------');
		$this->comment('Create Super-Administrator');
		$this->line('----------');

		$username  = $this->ask('Choose a username:');
		$email     = $this->ask('Enter your valid email address:');
		$password  = $this->secret('And now your password:');
		$password2 = $this->secret('Confirm your password:');

		$validator = Validator::make([
			'username'              => $username,
			'email'                 => $email,
			'password'              => $password,
			'password_confirmation' => $password2
		], [
			'username' => 'required|min:3',
			'email'    => 'required|email',
			'password' => 'required|min:3|confirmed'
		]);

		if ( $validator->fails() )
		{
			if ( count($validator->errors()->all()) == 1 )
				$this->error('An error occurred:');
			else
				$this->error('Several errors occurred:');
			foreach ( $validator->errors()->all() as $error )
				$this->line('    - ' . $error);
		}

		// Add to DB
		$this->user->username = $username;
		$this->user->email    = $email;
		$this->user->password = $password;
		$this->user->save();

		// Add to the Super-admins group
		$this->user->groups()->attach($this->group->findHandle('superadmins')->id);

		$this->info('2. You have successfully created a new super-admin account.');
	}

}
