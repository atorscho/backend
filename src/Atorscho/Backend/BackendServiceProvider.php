<?php namespace Atorscho\Backend;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

// todo - change current page menu item (.active) to something simpler.

class BackendServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('atorscho/backend');

		require __DIR__ . '/../../filters.php';
		require __DIR__ . '/../../routes.php';
		require __DIR__ . '/../../binds.php';
		require __DIR__ . '/../../composers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();

		$this->registerFacades();

		$this->registerAliases();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
	 * Register all Backend custom Commands.
	 */
	private function registerCommands()
	{
		// Create New Super-Admin Command
		$this->app['backend.backend.admin'] = $this->app->share(function ( $app )
		{
			return $app->make('Atorscho\Backend\Commands\BackendAdminCommand');
		});
		$this->commands('backend.backend.admin');

		// Faker Command
		$this->app['backend.backend.faker'] = $this->app->share(function ( $app )
		{
			return $app->make('Atorscho\Backend\Commands\BackendFakerCommand');
		});
		$this->commands('backend.backend.faker');

		// Faker Command
		$this->app['backend.backend.install'] = $this->app->share(function ( $app )
		{
			return $app->make('Atorscho\Backend\Commands\BackendInstallCommand');
		});
		$this->commands('backend.backend.install');
	}

	/**
	 * Register all Backend custom Facades.
	 */
	private function registerFacades()
	{
		// Backend Facade
		$this->app->bind('backend', function ()
		{
			return $this->app->make('Atorscho\Backend\Backend');
		});

		// Helper Facade
		$this->app->bind('flash', function ()
		{
			return $this->app->make('Atorscho\Backend\Helpers\FlashHelper');
		});

		// Helper Facade
		$this->app->bind('template', function ()
		{
			return $this->app->make('Atorscho\Backend\Helpers\TemplateHelper');
		});
	}

	/**
	 * Register Aliases for custom Facades.
	 * No need to add them to /app/config/app.php
	 */
	private function registerAliases()
	{
		$this->app->booting(function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Backend', 'Atorscho\Backend\Facades\Backend');
		});

		$this->app->booting(function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Flash', 'Atorscho\Backend\Facades\Flash');
		});

		$this->app->booting(function ()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Template', 'Atorscho\Backend\Facades\Template');
		});
	}

}
