# Creating a helper file

To create a helper file, we use the "php artisan make:module:helper ModuleName helperName" command.

``` bash
php artisan make:module:helper blog helper
```

This will create a helper file in the path modules/blog/helper.php

After creating the helper file, we need to call the created file in the desired module's ServiceProvider.php

**Pass the file name without its extension to $this->registerHelper()**

# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| helperName | string | required | 'helper' |

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerHelper($helperName);
    }

```

- [Home Page](https://idel327.github.io/laravel-modular)