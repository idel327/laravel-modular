<?php

namespace DummyNamespace\Providers;

use Idel\Modular\CoreServiceProvider as ServiceProvider;

class DummyProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = "DummySlug";

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerStorageDisk('DummySlug');
    }

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerWebRoute();
        $this->registerApiRoute();
        $this->registerJsonTranslations();
        $this->registerViews();
        $this->registerMigrations();
    }
}
