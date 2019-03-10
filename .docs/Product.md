# Product

```php
use \Falbar\Bitrix\Product;
```

## getPrice

**getPrice(int $iProductID = 0)**

Метод получает цену на товар.

**Параметры**

* `$iProductID` - ID товара.

**Возвращает**

* `Массив (валюта, базовая цена, цена со скидками)` / `[]`.