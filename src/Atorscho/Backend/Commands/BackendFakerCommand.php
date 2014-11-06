<?php namespace Atorscho\Backend\Commands;

use Atorscho\Backend\Models\User;
use Faker\Factory as Faker;
use Illuminate\Console\Command;

class BackendFakerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'backend:faker';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Seeds a table with fake data.';

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
		$table = $this->ask('Which table you want to seed? Choose between "users".');
		$rows  = $this->ask('How many records do you want to add?');

		if ( $table == 'users' )
		{
			$faker = Faker::create();

			foreach ( range(1, $rows) as $row )
			{
				\Eloquent::unguard();
				$user = User::create([
					'username'   => $faker->userName,
					'email'      => $faker->email,
					'password'   => \Hash::make('pass'),
					'first_name' => $faker->firstName,
					'last_name'  => $faker->lastName,
					'gender'     => ( rand(1, 10) % 2 == 0 ) ? 'M' : 'F'
				]);
				$user->groups()->attach(getSetting('defaultGroup'));
			}
			$this->info('Table successfully seeded.');
		}
		else
		{
			$this->error('You cannot seed that table.');
		}
	}

}
