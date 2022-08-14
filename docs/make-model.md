# Creating a model (Entity)

To create a model, we use the "php artisan make:module:entity ModuleName EntityName" command.

``` bash
php artisan make:module:entity blog Blog
```

## Flags

If you would like to generate a database migration when you generate the entity, you may use the --m option:

``` bash
php artisan make:module:entity blog Blog --m
```

This will create a entity(model) in the path modules/blog/src/Entities/Blog.php

- [Home Page](https://idel327.github.io/laravel-modular)