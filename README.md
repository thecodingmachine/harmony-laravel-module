Laravel's Harmony module
====================

This package contains a module that connects the Harmony user interface to the Laravel PHP framework.

Step 1: Download the Module
---------------------------

Include the package in your **composer.json**:

**composer.json**
```
{
  "require-dev": {
    "harmony/harmony": "~1.0",
    "harmony/laravel-module": "~1.0"
  }
}
```

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer update
```

Step 2: Register the Laravel module with Harmony
--------------------------------------------

Now, create a **modules.php** file at the root of your package and instantiate
the Laravel module:

**modules.php**
```php
<?php
return [
    new Harmony\Module\LaravelModule\LaravelModule()
];
```

You are done! Now, start Harmony. Harmony modules should be able to detect your Laravel services and act accordingly!
