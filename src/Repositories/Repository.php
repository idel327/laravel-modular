<?php

namespace Idel\Modular\Repositories;

use Exception;
use Illuminate\Support\Str;
use Idel\Modular\Contracts\Repository as RepositoryContract;
use Illuminate\Filesystem\Filesystem;

abstract class Repository implements RepositoryContract
{
    /**
     * @var string
     */
    public $location;

    /**
     * @var string Path to the defined modules directory
     */
    protected $path;

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * Constructor method.
     *
     * @param string $location
     */
    public function __construct(string $location)
    {
        $this->location = $location;
        $this->files =  new Filesystem;
    }

    /**
     * Get all module basenames.
     *
     * @return array
     */
    protected function getAllBasenames()
    {
        $path = $this->getPath();
        try {
            $collection = collect($this->files->directories($path));
            $basenames = $collection->map(function ($item, $key) {
                return basename($item);
            });
            return $basenames;
        } catch (\InvalidArgumentException $e) {
            return collect([]);
        }
    }

    /**
     * Get a module's manifest contents.
     *
     * @param string $slug
     * @return Collection|null
     */
    public function getManifest(string $slug)
    {
        if (! is_null($slug)) {
            $path     = $this->getManifestPath($slug);
            $contents = $this->files->get($path);
            $validate = @json_decode($contents, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $collection = collect(json_decode($contents, true));
                return $collection;
            }
            throw new Exception("[{$slug}] Your JSON manifest file was not properly formatted. Check for formatting issues and try again.");
        }
    }

    /**
     * Get modules path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path ?: config('laravel-modules.modulesPath');
    }

    /**
     * Set modules path in "RunTime" mode.
     *
     * @param string $path
     * @return object $this
     */
    public function setPath(string $path): object
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path for the specified module.
     *
     * @param string $slug
     * @return string
     */
    public function getModulePath(string $slug): string
    {
        $module = Str::studly($slug);
        if (\File::exists($this->getPath()."/{$module}/")) {
            return $this->getPath()."/{$module}/";
        }
        return $this->getPath()."/{$slug}/";
    }

    /**
     * Get path of module manifest file.
     *
     * @param $slug
     * @return string
     */
    protected function getManifestPath(string $slug): string
    {
        return $this->getModulePath($slug) . 'info.json';
    }
}
