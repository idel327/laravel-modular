# Register blade files

If you haven't created the blade directory yet, run the following commands.

``` bash

php artisan make:module:blade-directory blog

```

This will create blade directory in the path modules/blog/resources/views

After creating the blade directory, we need to call the directory in the desired module's ServiceProvider.php

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
    }

```

- [Home Page](https://idel327.github.io/laravel-modular)