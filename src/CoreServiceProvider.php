<?php

namespace Idel\Modular;

use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\{Route , Config};
use Illuminate\Contracts\Foundation\{CachesConfiguration , CachesRoutes};
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = null;

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(base_path("modules/{$this->moduleName}/resources/views"), $module);
    }

    /**
     * Register helper functions.
     *
     * @return void
     */
    protected function registerHelper()
    {
        // TODO: Merge all helper files
        $path = base_path("modules/{$this->moduleName}/helper.php");
        if (\File::isFile($path)) {
            require_once $path;
        }
    }

    /**
     * Register translations.
     *
     * @return void
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom(base_path("modules/{$this->moduleName}/languages") , $this->moduleName);
    }

    /**
     * Register json translations.
     *
     * @return void
     */
    protected function registerJsonTranslations()
    {
        $this->loadJsonTranslationsFrom(base_path("modules/{$this->moduleName}/languages") , $this->moduleName);
    }
    
    /**
     * Register migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(base_path("modules/{$this->moduleName}/database/migrations"));
    }

    /**
     * Register web route.
     *
     * @param boolean $withNameSpace = true
     * @return void
     */
    protected function registerWebRoute($withNameSpace = false)
    {
        if(! ($this->app instanceof CachesRoutes && $this->app->routesAreCached())) :
            $customizeModuleName = ucfirst($this->moduleName);
            $moduleNameSpace = $withNameSpace ? "App\\{$customizeModuleName}\\Http\\Controllers" : null;

            Route::middleware('web')
                ->namespace($moduleNameSpace)
                ->group(base_path("modules/{$this->moduleName}/routes/web.php"));
        endif;
    }

    /**
     * Register api route.
     * 
     * @param boolean $withNameSpace
     * @return void
     */
    protected function registerApiRoute($withNameSpace = false)
    {
        if(! ($this->app instanceof CachesRoutes && $this->app->routesAreCached())) :
            $customizeModuleName = ucfirst($this->moduleName);
            $moduleNameSpace = $withNameSpace ? "App\\{$customizeModuleName}\\Http\\Controllers" : null;

            Route::prefix('api')
                ->middleware('api')
                ->namespace($moduleNameSpace)
                ->group(base_path("modules/{$this->moduleName}/routes/api.php"));
        endif;
    }

    /**
     * Register custom route.
     *
     * @param string $routeName
     * @param string $prefix
     * @param string $middleware
     * @param boolean $withNameSpace
     * @return void
     */
    protected function registerCustomRoute($routeName , $prefix = '' , $middleware = '' , $withNameSpace = false)
    {
        if(! ($this->app instanceof CachesRoutes && $this->app->routesAreCached())) :
            $customizeModuleName = ucfirst($this->moduleName);
            $moduleNameSpace = $withNameSpace ? "App\\{$customizeModuleName}\\Http\\Controllers" : null;

            Route::prefix($prefix)
                ->middleware($middleware)
                ->namespace($moduleNameSpace)
                ->group(base_path("modules/{$this->moduleName}/routes/{$routeName}.php"));
        endif;
    }

    /**
     * Register factories.
     *
     * @return void
     */
    protected function registerFactories()
    {
        $this->loadFactoriesFrom(base_path("modules/{$this->moduleName}/database/factories"));
    }

    /**
     * Register storage disk.
     *
     * !important : {!! Please call in the register method !!}
     * 
     * @param string $diskName
     * @return void
     */
    protected function registerStorageDisk($diskName = null)
    {
        if(! $diskName) :
            $diskName = $this->moduleName;
        endif;

        Config::set("filesystems.disks.{$diskName}", [
            'driver' => 'local',
            'root' => storage_path("app/public/{$diskName}"),
            'url' => env('APP_URL') . '/storage/' . $diskName,
            'visibility' => 'public',
        ]);
    }
    
    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        if(! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) :
            $this->loadConfigsFrom(base_path("modules/{$this->moduleName}/config"));
        endif;
    }

    /**
     * Register any additional config.
     *
     * @param string $path
     * @return void
     */
    protected function loadConfigsFrom(string $path)
    {
        foreach ($this->getConfigurationFiles($path) as $key => $path) :
            $this->mergeConfigFrom($path, $key);
        endforeach;
    }

    /**
     * Get all of the configuration files for the application.
     *
     * @param string $path
     * @return array
     */
    private function getConfigurationFiles(string $path): array
    {
        $files = [];
        $configPath = realpath($path);
        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) :
            $directory = $this->getNestedDirectory($file, $configPath);
            $files[$directory.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        endforeach;

        ksort($files, SORT_NATURAL);

        return $files;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param SplFileInfo $file
     * @param string $configPath
     * @return string
     */
    protected function getNestedDirectory(SplFileInfo $file, string $configPath): string
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) :
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested).'.';
        endif;

        return $nested;
    }
}