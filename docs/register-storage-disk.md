# How to register storage disk

Put the following code in the desired module.

# Parameters

| Name | Type | Rules | Default |
| ---  | ---  |  ---  |   ---   |
| diskName | string | required | null |

``` bash

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	$this->registerStorageDisk($diskName);

        // For example :

        $this->registerStorageDisk('blogs');
    }

```
- [Home Page](https://idel327.github.io/laravel-modular)