# Creating a migration

To create a migration, we use the "php artisan make:module:migration ModuleName migrationName" command.

``` bash
php artisan make:module:migration blog create_blogs_table
```

This will create a migration in the path modules/blog/database/migrations/create_blogs_table.php

After creating the migration file, we need to call the directory in the desired module's ServiceProvider.php

``` bash

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
    }

```

- [Home Page](https://idel327.github.io/laravel-modular)