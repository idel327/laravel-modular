# Creating a router

To create a router, we use the "php artisan make:module:route ModuleName routerName" command.

``` bash
php artisan make:module:route blog web
```

This will create a router in the path modules/blog/src/routes/web.php.

After creating the router file, we need to call the created file in the desired module's ServiceProvider.php

If the name of the router is web, we place the following code in ServiceProvider.php

**If the withNameSpace parameter is true
By default, the routers that are created derive the namespace related to their module**

**"withNameSpace" parameter is optional**

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerWebRoute($withNameSpace);
    }

```

If the name of the router is api, we place the following code in ServiceProvider.php

**withNameSpace" parameter is optional**

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerApiRoute($withNameSpace);
    }

```

If the name of the router is not api or web, we put the following code in ServiceProvider.php

**"prefix" and "middleware" and "withNameSpace" parameters are optional**

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCustomRoute($routerFileName , $prefix , $middleware , $withNameSpace);
    }

```

- [Home Page](https://idel327.github.io/laravel-modular)