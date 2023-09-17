# Bitrix, [Packagist](https://packagist.org/packages/akbsit/bitrix)

A set of useful methods for working with the Bitrix API.

## Requirements

* Requires 1C-Bitrix version from `17.0.0`;
* PHP from `7.1`.

## Install

To install the library, you need to run the command in the `local` folder:

```
composer require akbsit/bitrix "1.*"
```

and connect `autoload.php` in the `php_interface/init.php` file:

```php
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php');
```
