<?php

namespace Idel\Modular;

use Illuminate\Foundation\Application;
use Composer\Autoload\ClassLoader;
use Idel\Modular\Repositories\LocalRepository;

class RepositoryManager
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Repository[]
     */
    protected $repositories = [];

    /**
     * @var Class Loader
     */
    protected $classLoader;

    /**
     * @var Path
     */
    protected $path;

    /**
     * Repository Manager instance.
     *
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app         = $app;
        $this->path        = base_path('modules');
        $this->classLoader = new ClassLoader;
    }

    /**
     * Register the module service provider file from all modules.
     *
     * @return void
     */
    public function register()
    {
        $moduleLocations = base_path('modules');

        $repository = $this->repository($moduleLocations);
        $modules    = $repository->enabled()->sortBy(['order']);
  
        $modules->each(function ($module){
            $this->addPsr4($module);
            $this->registerServiceProvider($module);
        });
    }

    /**
     * Register the module service provider.
     *
     * @param array $module
     * @return void
     */
    private function registerServiceProvider($module)
    {
        $moduleName = $module['name'];
        $provider = $moduleName . "ServiceProvider";
        $providerLoader = "App\\{$moduleName}\\Providers\\{$provider}";
        if (class_exists($providerLoader)) {
            $this->app->register($providerLoader);
        }
    }

    /**
     * Add Psr4 the instance.
     * 
     * @param array $module
     * @return void
     */
    public function addPsr4($module)
    {
        $modulrDir  = $this->path;
        $moduleName = $module['name'];
        $moduleSlug = $module['slug'];
        $this->classLoader->addPsr4('App\\' . $moduleName . '\\', $modulrDir . '/' .$moduleSlug . "/src");
        $this->classLoader->register();
    }

    /**
     * @return \Idel\Modular\Repositories\Repository[]
     */
    public function repositories()
    {
        return $this->repositories;
    }

    /**
     * @return \Idel\Modular\Repositories\Repository
     * @throws \Exception
     */
    protected function repository()
    {
        return  $this->repositories[$this->path]
            ?? $this->repositories[$this->path] = new LocalRepository($this->path);
    }

    /**
     * -----------
     */
    public function location()
    {
        return $this->repository();
    }

    /**
     * Oh sweet sweet magical method.
     *
     * @param string $method
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->repository(), $method], $arguments);
    }
}