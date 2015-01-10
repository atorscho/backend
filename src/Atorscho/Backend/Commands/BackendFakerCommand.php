<?php namespace Atorscho\Backend\Commands;

use Atorscho\Backend\Models\Content;
use Atorscho\Backend\Models\ContentType;
use Atorscho\Backend\Models\Taxonomy;
use Atorscho\Backend\Models\TaxonomyType;
use Atorscho\Backend\Models\User;
use Faker\Factory as Faker;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

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
	 * Faker class.
	 *
	 * @var Faker
	 */
	private $faker;

	/**
	 * Create a new command instance.
	 *
	 * @param Faker $faker
	 */
	public function __construct( Faker $faker )
	{
		parent::__construct();

		$this->faker = $faker->create();

		// Ignore Mass Assignment Protection
		\Eloquent::unguard();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$table = $this->argument('table');
		$rows  = $this->argument('rows');

		if ( $rows < 1 || $rows > 100 )
		{
			$this->error('You cannot create THAT much records.');
		}

		switch ( $table )
		{
			case 'users':
				$this->seedUsers($rows);
				break;
			case 'articles':
				$this->seedArticles($rows);
				break;
			case 'pages':
				$this->seedPages($rows);
				break;
			case 'categories':
				$this->seedCategories($rows);
				break;
			case 'tags':
				$this->seedTags($rows);
				break;
			default:
				$this->error('You cannot seed that table.');
				break;
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array(
				'table',
				InputArgument::REQUIRED,
				'Table name you want to seed: `users`, `articles`, `pages`, `categories` or `tags`.'
			),
			array(
				'rows',
				InputArgument::OPTIONAL,
				'Number of records you want to create.',
				10
			)
		);
	}

	/**
	 * Seed users.
	 *
	 * @param $rows
	 */
	private function seedUsers( $rows )
	{
		foreach ( range(1, $rows) as $row )
		{
			$user = User::create([
				'username'   => $this->faker->userName,
				'email'      => $this->faker->email,
				'password'   => \Hash::make('pass'),
				'first_name' => $this->faker->firstName,
				'last_name'  => $this->faker->lastName,
				'gender'     => ( rand(1, 10) % 2 == 0 ) ? 'M' : 'F'
			]);
			$user->groups()->attach(getSetting('defaultGroup'));
		}

		if ( $rows > 1 )
			$this->info($rows . ' users have been created with password "pass".');
		else
			$this->info($rows . ' user has been created with password "pass".');
	}

	/**
	 * Seed articles.
	 *
	 * @param $rows
	 */
	private function seedArticles( $rows )
	{
		foreach ( range(1, $rows) as $row )
		{
			$userId = User::orderByRaw("RAND()")->first()->id;

			$content = Content::create([
				'type_id'    => ContentType::findSlug('articles')->id,
				'parent_id'  => Taxonomy::first()->id,
				'title'      => $title = trim($this->faker->sentence(4), '.'),
				'slug'       => $title,
				'published'  => rand(0, 1),
				'order'      => '',
				'created_by' => $userId,
				'updated_by' => $userId
			]);
			$content->fields()->attach($content->contentType->fields->first()->id, [ 'value' => $this->faker->paragraph(5) ]);
		}

		if ( $rows > 1 )
			$this->info($rows . ' articles have been created.');
		else
			$this->info($rows . ' article has been created.');
	}

	/**
	 * Seed pages.
	 *
	 * @param $rows
	 */
	private function seedPages( $rows )
	{
		foreach ( range(1, $rows) as $row )
		{
			$userId = User::orderByRaw("RAND()")->first()->id;

			$content = Content::create([
				'type_id'    => ContentType::findSlug('pages')->id,
				'title'      => $title = trim($this->faker->sentence(4), '.'),
				'slug'       => $title,
				'published'  => rand(0, 1),
				'order'      => '',
				'created_by' => $userId,
				'updated_by' => $userId
			]);
			$content->fields()->attach($content->contentType->fields->first()->id, [ 'value' => $this->faker->paragraph(5) ]);
		}

		if ( $rows > 1 )
			$this->info($rows . ' pages have been created.');
		else
			$this->info($rows . ' page has been created.');
	}

	/**
	 * Seed categories.
	 *
	 * @param $rows
	 */
	private function seedCategories( $rows )
	{
		foreach ( range(1, $rows) as $row )
		{
			Taxonomy::create([
				'type_id' => TaxonomyType::findSlug('categories')->id,
				'title'   => $title = trim($this->faker->sentence(1), '.'),
				'slug'    => $title,
				'order'   => ''
			]);
		}

		if ( $rows > 1 )
			$this->info($rows . ' categories have been created.');
		else
			$this->info($rows . ' category has been created.');
	}

	/**
	 * Seed tags.
	 *
	 * @param $rows
	 */
	private function seedTags( $rows )
	{
		foreach ( range(1, $rows) as $row )
		{
			Taxonomy::create([
				'type_id' => TaxonomyType::findSlug('tags')->id,
				'title'   => $title = ucfirst(trim($this->faker->word, '.')),
				'slug'    => $title,
				'order'   => ''
			]);
		}

		if ( $rows > 1 )
			$this->info($rows . ' tags have been created.');
		else
			$this->info($rows . ' tag has been created.');
	}

}
