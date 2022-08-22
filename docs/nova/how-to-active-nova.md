# How to modularize Laravel Nova

If you have installed the Laravel Nova package, by referring to the config/laravel-modules.php file and changing supportLaravelNova to true, your modular system will be able to support Laravel Nova.


``` bash

// Path : config/laravel-modules.php

"supportLaravelNova" => true,

```

After that

We put the following code in the desired module's ServiceProvider.php


# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| hasResources | boolean | required | true |
| hasCards | boolean | optional | false |
| hasDashboards | boolean | optional | false |
| hasTools | boolean | optional | false |
| hasJs | boolean | optional | false |
| hasCss | boolean | optional | false |
| assetDir | string | optional | '' |


assetDir example : 'site' or 'panel' or 'storage'
**css, js files folder**

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootLaravelNova($hasResources,$hasCards,$hasDashboards,$hasTools,$hasJs,$hasCss,$assetDir);
    }

```

![boot laravel nova](https://novapackages.com/storage/screenshots/26XYY5FeYj6yakicOVuDVuNzFFvXzTdQZuHRlR2v.png)

- [Home Page](https://idel327.github.io/laravel-modular)