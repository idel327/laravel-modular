# Creating a language(json)

To create a language, we use the "php artisan make:module:language ModuleName language" command.

``` bash
php artisan make:module:language blog en
```

This will create a language in the path modules/blog/languages/en.json

After creating the language file, we need to call the created file in the desired module's ServiceProvider.php

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerJsonTranslations();
    }
    
```

- [Home Page](https://idel327.github.io/laravel-modular)