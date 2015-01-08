<?php namespace Atorscho\Backend\Commands;

use Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

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
		$output = new BufferedOutput;

		// todo - ensure that this functions for package

		// 1. Run migrations first.
		Artisan::call('migrate', [ '--bench' => 'atorscho/backend' ], $output);
		$this->output->write('<comment>.</comment>');

		// 2. Seed most important DB tables.
		$this->output->write('<comment>.</comment>');

		// 2.1 Settings and Setting Groups
		Artisan::call('db:seed', [ '--class' => 'BackendSettingsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// 2.2 Groups & Permissions
		Artisan::call('db:seed', [ '--class' => 'BackendGroupsSeeder' ]);
		$this->output->write('<comment>.</comment>');
		Artisan::call('db:seed', [ '--class' => 'BackendPermissionsSeeder' ]);
		$this->output->write('<comment>.</comment>');
		Artisan::call('db:seed', [ '--class' => 'BackendUserFieldsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// 2.3 Content Types & Content Fields
		Artisan::call('db:seed', [ '--class' => 'BackendContentsSeeder' ]);
		$this->output->write('<comment>.</comment>');

		// End with a newline.
		$this->output->write("\n");

		$this->info('Setting, User and Content systems have been installed.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	/*protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}*/

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('resources', null, InputOption::VALUE_OPTIONAL, 'Also install all demo content for testing purposes.', null),
		);
	}

}
