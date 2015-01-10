<?php namespace Atorscho\Backend\Commands;

use Artisan;
use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\Group;
use Atorscho\Backend\Models\Taxonomy;
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

		if ( $this->option('sample-data') )
		{
			$this->sampleData();
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
			array(
				'sample-data',
				's',
				InputOption::VALUE_NONE,
				'Also create all sample data for testing purposes.'
			),
		);
	}

	/**
	 * Migrations & Groups & Permissions & Settings
	 */
	protected function installBaseSystems()
	{
		// todo - ensure that this works for package

		// 1. Run migrations first.
		$this->artisan->call('migrate', [ '--bench' => 'atorscho/backend' ]);
		$this->output->write('<comment>.</comment>');

		// 2. Seed most important DB tables.
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

		// 2.3 Taxonomy Types
		$this->artisan->call('db:seed', [ '--class' => 'BackendTaxonomiesSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// 2.4 Content Types & Content Fields
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

		list( $username, $email, $password ) = $this->askAdminCredentials();

		// Add to DB
		$this->user->username = $username;
		$this->user->email    = $email;
		$this->user->password = $password;
		$this->user->save();

		// Add to the Super-admins group
		$this->user->groups()->attach($this->group->findHandle('superadmins')->id);

		$this->info('2. You have successfully created a new super-admin account.');
	}

	/**
	 * Create sample data for testing purposes.
	 */
	protected function sampleData()
	{
		// Sample Page
		$content = Content::create([
			'type_id'    => ContentType::findSlug('pages')->id,
			'title'      => 'Sample Page',
			'slug'       => 'sample-page',
			'published'  => 1,
			'order'      => '',
			'created_by' => User::first()->id,
			'updated_by' => User::first()->id
		]);
		$content->fields()->attach($content->contentType->fields->first()->id, [ 'value' => 'This is a sample page that you can create from The Backend. It is only a content type with a content text.' ]);

		// Sample Article
		$content = Content::create([
			'type_id'    => ContentType::findSlug('articles')->id,
			'parent_id'  => Taxonomy::first()->id,
			'title'      => 'The Backend is Installed!',
			'slug'       => 'backend-installed',
			'published'  => 1,
			'order'      => '',
			'created_by' => User::first()->id,
			'updated_by' => User::first()->id
		]);
		$content->fields()->attach($content->contentType->fields->first()->id, [ 'value' => 'Congratulations! You successfully installed The Backend with all its default content.' ]);

		$this->info('3. All sample data has been created.');
	}

	/**
	 * @return array
	 */
	protected function askAdminCredentials()
	{
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

			list( $username, $email, $password ) = $this->askAdminCredentials();
		}

		return [
			$username,
			$email,
			$password
		];
	}

}
