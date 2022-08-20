# Creating a middleware

To create a middleware, we use the "php artisan make:module:middleware ModuleName middlewareName" command.

``` bash
php artisan make:module:middleware blog BlogMiddleware
```

This will create a middleware in the path modules/blog/src/Http/Middleware/BlogMiddleware.php

- [Home Page](https://idel327.github.io/laravel-modular)