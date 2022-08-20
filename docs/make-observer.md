# Creating a observer

If you are listening for many events on a given model, you may use observers to group all of your listeners into a single class.

Observer classes have method names which reflect the Eloquent events you wish to listen for.

To create a observer, we use the "php artisan make:module:observer ModuleName observerName" command.

``` bash
php artisan make:module:observer blog BlogObserver
```

## With Model Flag

``` bash
php artisan make:module:observer blog BlogObserver --model=Blog
```

This will create a observer in the path modules/blog/src/Observers/BlogObserver.php

- [Home Page](https://idel327.github.io/laravel-modular)