# Order

```php
use \Falbar\Bitrix\Order;
```

## addProp

**addProp(int $iOrderID = 0, string $sPropCode = '', string $sPropValue = '')**

Метод добавляет существующие, но не заданное свойство к заказу.

**Параметры**

* `$iOrderID` - ID заказа;
* `$sPropCode` - CODE свойства;
* `$sPropValue` - VALUE свойства (необязательный).

**Возвращает**

* `ID добавленного свойства` / `0`.

## updateProp

**updateProp(int $iOrderID = 0, string $sPropCode = '', string $sPropValue = '')**

Метод обновляет значение свойства заказа.

**Параметры**

* `$iOrderID` - ID заказа;
* `$sPropCode` - CODE свойства;
* `$sPropValue` - VALUE свойства (необязательный).

**Возвращает**

* `ID обновленного свойства` / `0`.

## getProps

**getProps(int $iOrderID = 0)**

Метод получает набор свойств относящихся к заказу.

**Параметры**

* `$iOrderID` - ID заказа.

**Возвращает**

* `Mассив свойств` / `[]`.