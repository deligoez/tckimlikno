<?php

namespace Deligoez\TCKimlikNo;

use Illuminate\Support\ServiceProvider;

class TCKimlikNoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'deligoez');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'deligoez');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/tckimlikno.php' => config_path('tckimlikno.php'),
        ], 'tckimlikno.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/deligoez'),
        ], 'tckimlikno.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/deligoez'),
        ], 'tckimlikno.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/deligoez'),
        ], 'tckimlikno.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tckimlikno.php', 'tckimlikno');

        // Register the service the package provides.
        $this->app->singleton('tckimlikno', function ($app) {
            return new TCKimlikNo;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tckimlikno'];
    }
}
