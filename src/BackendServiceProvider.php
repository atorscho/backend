<?php

namespace Atorscho\Backend;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Require routes file
        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'backend');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
