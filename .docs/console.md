# Console commands

Command returns the size of the site cache:

```
php console bitrix:cache:size
```

The site cache cleanup command:

```
php console bitrix:cache:clear
```

Command creates a skeleton of the component:

```
php console bitrix:create:component
```

## Connecting console

In order to connect the console and use commands, you need to create a `console` file in the folder with the `composer.json` file with the contents:

```php
#!/usr/bin/env php
<?php
set_time_limit(0);
ini_set('mbstring.func_overload', 2);
ini_set('memory_limit', '1024M');
ini_set('mbstring.internal_encoding', 'UTF-8');

$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/..');

define('BX_UTF', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_BUFFER_USED', true);
define('NO_AGENT_CHECK', true);
define('NO_AGENT_STATISTIC', true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Symfony\Component\Console\Application;

try {
    $oApplication = new Application();

    $oApplication->add(new \Akbsit\Bitrix\Console\CacheSizeCommand());
    $oApplication->add(new \Akbsit\Bitrix\Console\CacheClearCommand());
    $oApplication->add(new \Akbsit\Bitrix\Console\CreateComponentCommand());

    $oApplication->run();
} catch (\Exception $oError) {
    echo $oError->getMessage();
}
```
