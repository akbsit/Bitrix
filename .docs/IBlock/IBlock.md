# IBlock

```php
use \Falbar\Bitrix\IBlock\IBlock;
```

## getID

**getID(string $sCode = '', string $sType = '')**

Метод получает индификатор инфоблока по его коду и типу.

**Параметры**

* `$sCode` - CODE инфоблока;
* `$sType` - ID типа инфоблока (необязательный).

**Возвращает**

* `ID инфоблока` / `0`.