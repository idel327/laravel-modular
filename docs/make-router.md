# Creating a router

To create a router, we use the "php artisan make:module:route ModuleName routerName" command.

``` bash
php artisan make:module:route blog web
```

This will create a router in the path modules/blog/routes/web.php.

After creating the router file, we need to call the created file in the desired module's ServiceProvider.php

If the name of the router is web, we place the following code in ServiceProvider.php

**If the withNameSpace parameter is true
By default, the routers that are created derive the namespace related to their module**

# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| withNameSpace | boolean | nullable | false |

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerWebRoute();

        // Or

        $this->registerWebRoute($withNameSpace);
    }

```

If the name of the router is api, we place the following code in ServiceProvider.php

# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| withNameSpace | boolean | nullable | false |

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerApiRoute();
        // Or
        $this->registerApiRoute($withNameSpace);
    }

```

If the name of the router is not api or web, we put the following code in ServiceProvider.php

# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| routerFileName | string | required | null |
| prefix | string | nullable | '' |
| middleware | string | nullable | '' |
| withNameSpace | boolean | nullable | false |

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCustomRoute($routerFileName);
        //Or
        $this->registerCustomRoute($routerFileName , $prefix , $middleware , $withNameSpace);
    }

```

- [Home Page](https://idel327.github.io/laravel-modular)