## Laravel-Modular

Laravel Modular helps to make your application modular. Often happens that our applications grow a lot and we need a lot of models, resources, controllers, migrations etc.. With this package we can divide our parts in little chunks (or modules).

**Loading modules using PSR-4 standard automatically**

## Install

To install through Composer, by run the following command:

``` bash
composer require idel/laravel-modular
```

The package will automatically register a service provider and alias.

## Pages Link

- [Creating a module](https://idel327.github.io/laravel-modular/make-module)
- [Creating a Model(Entity)](https://idel327.github.io/laravel-modular/make-model)
- [Creating a Controller](https://idel327.github.io/laravel-modular/make-controller)
- [Creating a router](https://idel327.github.io/laravel-modular/make-router)

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
- Add Config File.
- Improving Performance.
- Cache System.
- Support Laravel Nova.
- Public Folder Support In Each Module.

# Contact us

oeslami32@gmail.com

omeslami32@gmail.com

idel327327@gmail.com