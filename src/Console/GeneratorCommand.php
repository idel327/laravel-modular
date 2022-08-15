<?php

namespace Idel\Modular\Console;

use Illuminate\Console\GeneratorCommand as LaravelGeneratorCommand;
use Module;

abstract class GeneratorCommand extends LaravelGeneratorCommand
{
    /**
     * Parse the name and format according to the root namespace.
     *
     * @param string $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        try {
            $location = $this->option('location') ?: config('laravel-modules.modulesPath');
        }
        catch (\Exception $e) {
            $location = config('laravel-modules.modulesPath');
        }
        $name = str_replace('/', '\\', $name);
        return $this->getDefaultNamespace($this->rootNamespace()).'\\'.$name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        try {
            $location = $this->option('location') ?: config('laravel-modules.modulesPath');
        }
        catch (\Exception $e) {
            $location = config('laravel-modules.modulesPath');
        }
        $slug = $this->argument('slug');
        $module = Module::location($location)->where('slug', $slug);

        // take everything after the module name in the given path (ignoring case)
        $key = array_search(strtolower($module['basename']), explode('\\', strtolower($name)));
        
        if ($key === false) {
            $newPath = str_replace('\\', '/', $name);
        } else {
            $newPath = implode('/', array_slice(explode('\\', $name), $key + 1));
        }

        return module_path($slug, "{$newPath}.php", $location , true);
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return "App\\";
    }
}
