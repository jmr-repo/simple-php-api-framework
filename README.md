# APIOLOGY - PHP API FRAMEWORK

## Setup

There are different ways to setup

1. Create a Reource

- Add the name of the method to be called in v\*.php, which will be the resource

2. Creating a new version

- Create a function inside v*.php (where * means number of the version)
- Add Function Name in v\*.php with the following code in it

```php
// Instance the HTTP object
$this->http_response = new HTTP();
$file = "apiology/version/resources/sample.php";
// require file
require $file;
// call by namespace
$module = "Apiology\\Apiology\\version\\resources\\Sample";
// instantiate object
$module = new $module();
// call method (resource)
$module->sample($_data);

```
