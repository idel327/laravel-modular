# How to register storage disk

Put the following code in the desired module.

``` bash

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	$this->registerStorageDisk('blogs');
    }

```
- [Home Page](https://idel327.github.io/laravel-modular)