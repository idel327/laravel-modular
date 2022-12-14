<?php

namespace Idel\Modular;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @var bool Indicates if loading of the provider is deferred.
     */
    protected $defer = false;
    
    /**
     * Bootstrap the provided services.
     */
    public function boot()
    {
        $this->publisheFiles();
        $this->app['modules']->register();
    }

    /**
     * Register the provided services.
     */
    public function register()
    {
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(GeneratorServiceProvider::class);

        $this->app->singleton('modules', function ($app) {
            return new RepositoryManager($app);
        });
    }

    /**
     * Publishe files.
     */
    public function publisheFiles()
    {
        $configPath = __DIR__ . '/../config/laravel-modules.php';

        if(config('laravel-modules') == null) :
            $this->mergeConfigFrom($configPath, 'laravel-modules');
        endif;

        $this->publishes(
            [
                $configPath => config_path('laravel-modules.php'),
            ],
            'config'
        );
    }

    /**
     * Get the services provided by the package.
     *
     * @return array
     */
    public function provides()
    {
        return ['modules'];
    }
}