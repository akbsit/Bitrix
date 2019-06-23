# Element

```php
use \Falbar\Bitrix\IBlock\Element;
```

## getList

**getList(int $iIBlockID = 0, array $arParams = [], string $sGetList = self::GETLIST_FETCH)**

Метод получает список элементов инфоблока.

**Параметры**

* `$iIBlockID` - ID инфоблока;
* `$arParams` - массив с заданными параметрами (необязательный):
    * `select` - возвращаемый массив полей элемента;
    * `limit` - количество возвращаемых элементов;
    * `filter` - массив фильтров выборки;
    * `order` - направление сортировки (необязательный, по умолчанию DESC по ID).
* `$sGetList` - тип получения выборки `IBlock::GETLIST_FETCH` | `IBlock::GETLIST_GETNEXT`.

**Возвращает**

* `Массив элементов инфоблока` / `[]`.

**Пример заполнения `$arParams`**

```php
[
    'select' => ['ID', 'NAME'],
    'limit' => 5,
    'order' => 'desc'
]
```