# Creating a config

To create a config file, we use the "php artisan make:module:config ModuleName configFileName" command.

``` bash
php artisan make:module:config blog blog
```

This will create a config in the path modules/blog/config/blog.php

After creating the config file, we need to call the created file in the desired module's ServiceProvider.php

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }
    
```
- [Home Page](https://idel327.github.io/laravel-modular)