<?php

namespace Idel\Modular\Contracts;

interface Repository
{
    /**
     * Get all module manifest properties and store
     * in the respective container.
     *
     * @return bool
     */
    public function optimize();

    /**
     * Get all modules.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * Get all module slugs.
     *
     * @return \Illuminate\Support\Collection
     */
    public function slugs();

    /**
     * Get modules based on where clause.
     *
     * @param string $key
     * @param mixed  $value
     * @return \Illuminate\Support\Collection
     */
    public function where(string $key, $value);

    /**
     * Sort modules by given key in ascending order.
     *
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public function sortBy(string $key);

    /**
     * Sort modules by given key in ascending order.
     *
     * @param string $key
     * @return \Illuminate\Support\Collection
     */
    public function sortByDesc(string $key);

    /**
     * Determines if the given module exists.
     *
     * @param string $slug
     * @return bool
     */
    public function exists(string $slug);

    /**
     * Returns a count of all modules.
     *
     * @return int
     */
    public function count();

    /**
     * Returns the modules defined manifest properties.
     *
     * @param string $slug
     * @return \Illuminate\Support\Collection
     */
    public function getManifest(string $slug);

    /**
     * Returns the given module property.
     *
     * @param string     $property
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $property, $default = null);

    /**
     * Set the given module property value.
     *
     * @param string $property
     * @param mixed  $value
     * @return bool
     */
    public function set(string $property, $value);

    /**
     * Get all enabled modules.
     *
     * @return \Illuminate\Support\Collection
     */
    public function enabled();

    /**
     * Get all disabled modules.
     *
     * @return \Illuminate\Support\Collection
     */
    public function disabled();

    /**
     * Determines if the specified module is enabled.
     *
     * @param string $slug
     * @return bool
     */
    public function isEnabled(string $slug);

    /**
     * Determines if the specified module is disabled.
     *
     * @param string $slug
     * @return bool
     */
    public function isDisabled(string $slug);

    /**
     * Enables the specified module.
     *
     * @param string $slug
     * @return bool
     */
    public function enable(string $slug);

    /**
     * Disables the specified module.
     *
     * @param string $slug
     * @return bool
     */
    public function disable(string $slug);
    
    /**
     * Get all modules by specified location
     * 
     * @param string $location
     * @return \Illuminate\Support\Collection
     */
    public function byLocation(string $location);
}
