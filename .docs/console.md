# Консольные команды

Команда возвращает размер кеша сайта:

```
php console bitrix:cache:size
```

Команда по очистке кеша сайта:

```
php console bitrix:cache:clear
```

## Подключение консоли

Для того, чтобы подключить консоль и пользоваться командами, необходимо создать файл `console` в папке с файлом `composer.json` с содержимым:

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

    $oApplication->add(new \Falbar\Bitrix\Console\CacheSizeCommand());
    $oApplication->add(new \Falbar\Bitrix\Console\CacheClearCommand());

    $oApplication->run();
} catch (\Exception $oError) {
    echo $oError->getMessage();
}
```