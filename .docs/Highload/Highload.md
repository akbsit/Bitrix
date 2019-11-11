# Highload

```php
use \Falbar\Bitrix\Highload\Highload;
```

## getID

**getID(string $sName = '', string $sDBName = '')**

Метод получает индификатор хайлоуд блока по названию и названию таблицы.

**Параметры**

* `$sName` - название хайлоуд блока;
* `$sDBName` - название таблицы.

**Возвращает**

* `ID хайлоуд блока` / `0`.

## getClassName

**getClassName(int $iHighloadID = 0)**

Метод получает название класса хайлоуд блока.

**Параметры**

* `$iHighloadID` - ID хайлоуд блока.

**Возвращает**

* `Название класса` / ` `.