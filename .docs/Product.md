# Product

```php
use \Falbar\Bitrix\Product;
```

## getPrice

**getPrice(int $iProductId = 0)**

Метод получает цену на товар.

**Параметры**

* `$iProductId` - ID товара.

**Возвращает**

* `Массив (валюта, базовая цена, цена со скидками)` / `[]`.