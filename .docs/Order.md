# Order

```php
use \Falbar\Bitrix\Order;
```

## addProp

**addProp(int $iOrderId = 0, string $sPropCode = '', string $sPropValue = '')**

Метод добавляет существующие, но не заданное свойство к заказу.

**Параметры**

* `$iOrderId` - ID заказа;
* `$sPropCode` - CODE свойства;
* `$sPropValue` - VALUE свойства (необязательный).

**Возвращает**

* `ID добавленного свойства` / `0`.

## updateProp

**updateProp(int $iOrderId = 0, string $sPropCode = '', string $sPropValue = '')**

Метод обновляет значение свойства заказа.

**Параметры**

* `$iOrderId` - ID заказа;
* `$sPropCode` - CODE свойства;
* `$sPropValue` - VALUE свойства (необязательный).

**Возвращает**

* `ID обновленного свойства` / `0`.

## getOrderProps

**getOrderProps(int $iOrderId = 0)**

Метод получает набор свойств относящихся к заказу.

**Параметры**

* `$iOrderId` - ID заказа.

**Возвращает**

* `Mассив свойств` / `[]`.