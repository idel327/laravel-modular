<?php

use Symfony\Component\Finder\Finder;
use Idel\Modular\Exceptions\ModuleNotFoundException;

if (!function_exists('modules')) {

    /**
     * Get modules repository.
     *
     * @param string $location
     * @return \Idel\Modular\RepositoryManager \Idel\Modular\Repository
     */
    function modules(string $location = null) {
        if ($location) {
            return app('modules')->location($location);
        }
        return app('modules');
    }
}

if (!function_exists('module_path')) {

    /**
     * Return the path to the given module file.
     *
     * @param string $slug
     * @param string $file
     * @param string|null $location
     * @param boolean $inSrc
     * @return string
     * @throws \Idel\Modular\Exceptions\ModuleNotFoundException
     */
    function module_path($slug = null, $file = '', $location = null , $inSrc = false , $typeSeeder = false) {
        $location = $location ?: "modules";
        $modulesPath = config('laravel-modules.modulesPath');

        $filePath = $file ? '/' . ltrim($file, '/') : '';
       
        if (is_null($slug)) {
            if (empty($file)) {
                return $modulesPath;
            }
            return $modulesPath . $filePath;
        }


        $module = Module::location($location)->where('slug', $slug);

        if (is_null($module)) {
            throw new ModuleNotFoundException($slug);
        }

        if ($inSrc) {
            return $modulesPath . '/' . $module['basename'] . '/src' . $filePath;
        } else if ($typeSeeder) {
            return $modulesPath . '/' . $module['basename'] . $filePath;
        } else{
            return $modulesPath . '/' . $module['basename'] . $filePath;
        }
    }
}


if (!function_exists('module_class')) {

    /**
     * Return the full path to the given module class.
     *
     * @param string $slug
     * @param string $class
     * @param string $location
     * @return string
     * @throws \Idel\Modular\Exceptions\ModuleNotFoundException
     */
    function module_class($slug, $class, $location = null) {
        $location = $location ?: config('laravel-modules.modulesPath');
        $module = modules($location)->where('slug', $slug);

        if (is_null($module)) {
            throw new ModuleNotFoundException($slug);
        }

        $namespace = "App\\" . $module['name'];

        return "$namespace\\$class";
    }
}


if (! function_exists('getNovaResources')) {

    /**
     * Autoload all nova resources of your module.
     *
     * @return array
     */
    function getNovaResources($resourcesPath , $namSpace)
    {
        $resources = [];
        foreach ((new Finder)->in($resourcesPath)->files() as $resource) {
            $fileName = str_replace('.php', '', $resource->getFilename());
            $resources[] = str_replace('/' , '\\' ,"{$namSpace}/Resources/{$fileName}");
        }
        return $resources;
    }
}