# Laravel-Modular

Laravel Modular helps to make your application modular. Often happens that our applications grow a lot and we need a lot of models, resources, controllers, migrations etc.. With this package we can divide our parts in little chunks (or modules).

## Install

To install through Composer, by run the following command:

``` bash
composer require idel/laravel-modular
```

The package will automatically register a service provider and alias.

## Directory Structure

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


# Contact us

oeslami32@gmail.com

omeslami32@gmail.com

idel327327@gmail.com