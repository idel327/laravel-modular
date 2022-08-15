# Laravel-Modular

Laravel Modular helps to make your application modular. Often happens that our applications grow a lot and we need a lot of models, resources, controllers, migrations etc.. With this package we can divide our parts in little chunks (or modules).

** Loading modules using PSR-4 standard automatically **

## Install

To install through Composer, by run the following command:

``` bash
composer require idel/laravel-modular
```

The package will automatically register a service provider and alias.

Optionally, publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="Idel\Modular\ServiceProvider"
```

## Pages Link

# Generators

- [Creating a module](https://idel327.github.io/laravel-modular/make-module)
- [Creating a Model(Entity)](https://idel327.github.io/laravel-modular/make-model)
- [Creating a Controller](https://idel327.github.io/laravel-modular/make-controller)
- [Creating a router](https://idel327.github.io/laravel-modular/make-router)
- [Creating a config](https://idel327.github.io/laravel-modular/make-config)
- [Creating a migration](https://idel327.github.io/laravel-modular/make-migration)
- [Creating a event](https://idel327.github.io/laravel-modular/make-event)
- [Creating a job](https://idel327.github.io/laravel-modular/make-job)
- [Creating a language(json)](https://idel327.github.io/laravel-modular/make-language)
- [Creating a listener](https://idel327.github.io/laravel-modular/make-listener)
- [Creating a mail](https://idel327.github.io/laravel-modular/make-mail)
- [Creating a middleware](https://idel327.github.io/laravel-modular/make-middleware)
- [Creating a notification](https://idel327.github.io/laravel-modular/make-notification)
- [Creating a observer](https://idel327.github.io/laravel-modular/make-observer)
- [Creating a policy](https://idel327.github.io/laravel-modular/make-policy)
- [Creating a provider](https://idel327.github.io/laravel-modular/make-provider)
- [Creating a request](https://idel327.github.io/laravel-modular/make-request)
- [Creating a test](https://idel327.github.io/laravel-modular/make-test)
- [Creating a helper file](https://idel327.github.io/laravel-modular/make-helper)

# Actions

- [Optimize modules](https://idel327.github.io/laravel-modular/module-optimize)
- [How to register storage disk](https://idel327.github.io/laravel-modular/register-storage-disk)
- [Register blade files](https://idel327.github.io/laravel-modular/register-blade)
- [How to disable module](https://idel327.github.io/laravel-modular/disable-module)
- [How to enable module](https://idel327.github.io/laravel-modular/enable-module)
- [Migrate the given module or migrate all modules](https://idel327.github.io/laravel-modular/migrate-module)
- [Refresh the migration](https://idel327.github.io/laravel-modular/migrate-refresh-module)
- [Reset the migration](https://idel327.github.io/laravel-modular/migrate-reset-module)
- [Rollback the given module or rollback all modules.](https://idel327.github.io/laravel-modular/migrate-rollback-module)
- [Modules list](https://idel327.github.io/laravel-modular/module-list)


- [How to modularize Laravel Nova](https://idel327.github.io/laravel-modular/nova/how-to-active-nova)

# Nova Generators

- [Creating a nova resource](https://idel327.github.io/laravel-modular/nova/make-resource)
- [Creating a nova action](https://idel327.github.io/laravel-modular/nova/make-action)
- [Creating a nova card](https://idel327.github.io/laravel-modular/nova/make-card)
- [Creating a nova dashboard](https://idel327.github.io/laravel-modular/nova/make-dashboard)
- [Creating a nova field](https://idel327.github.io/laravel-modular/nova/make-field)
- [Creating a nova filter](https://idel327.github.io/laravel-modular/nova/make-filter)
- [Creating a nova lens](https://idel327.github.io/laravel-modular/nova/make-lens)
- [Creating a nova partition](https://idel327.github.io/laravel-modular/nova/make-partition)
- [Creating a nova value](https://idel327.github.io/laravel-modular/nova/make-value)

## Documentation

You'll find installation instructions and full documentation on [https://idel327.github.io/laravel-modular](https://idel327.github.io/laravel-modular).

## Directory Structure

Using Artisan commands, files and folders are created according to your needs.

So we'll have a structure like this :

* modules
  * routes
  * database
  	* migrations
  * languages
  * resources
  	* js
  	* views
  * src
    * Providers
    * Entities
    * Http
    	* Controllers
    	* Middleware
      * Requests
    * Exceptions
    * Jobs
    * Mails
    * Casts
    * Observers
    * Facades
    * Traits
    * Events
    * Listeners
    * Tests
    * Console

Default structure with files :

* modules
  * src
    * Providers
    	* ServiceProvider.php
  * info.json

# To Do

- Update Document.
- Add Test Files.
- Improving Performance.
- Cache System.
- Public Folder Support In Each Module.

# Contact us

oeslami32@gmail.com

omeslami32@gmail.com

idel327327@gmail.com