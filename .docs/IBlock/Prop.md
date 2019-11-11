# Prop

```php
use \Falbar\Bitrix\IBlock\Prop;
```

## getID

**getID(int $iIBlockID = 0, string $sCode = '', string $sType = self::PROP_STRING)**

Метод получает индификатор свойства по его символьному коду.

**Параметры**

* `$iIBlockID` - ID инфоблока;
* `$sCode` - CODE свойства;
* `$sType` - тип свойства.

**Возвращает**

* `ID свойства` / `0`.