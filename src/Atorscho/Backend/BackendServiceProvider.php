<?php namespace Atorscho\Backend;

use Illuminate\Support\ServiceProvider;

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
		// Register Commands
		$this->app['backend.backend.admin'] = $this->app->share(function ($app)
		{
			return new Commands\BackendCreateAdminCommand;
		});
		$this->commands('backend.backend.admin');
		$this->app['backend.backend.faker'] = $this->app->share(function ($app)
		{
			return new Commands\BackendFakerCommand;
		});
		$this->commands('backend.backend.faker');
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

}
