# How to modularize Laravel Nova

If you have installed the Laravel Nova package, by referring to the config/laravel-modules.php file and changing supportLaravelNova to true, your modular system will be able to support Laravel Nova.

After that

We put the following code in the desired module's ServiceProvider.php

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
    	// $hasResources  [default => true  , required]
    	// $hasCards      [default => false , optional]
    	// $hasDashboards [default => false , optional]
    	// $hasTools      [default => false , optional]
    	// $hasJs         [default => false , optional]
    	// $hasCss        [default => false , optional]
    	// $assetDir      [default => '' , optional , example : 'js']

        $this->bootLaravelNova($hasResources,$hasCards,$hasDashboards,$hasTools,$hasJs,$hasCss,$assetDir);
    }

```
- [Home Page](https://idel327.github.io/laravel-modular)