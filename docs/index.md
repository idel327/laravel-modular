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