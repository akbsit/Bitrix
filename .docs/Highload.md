# Highload

```php
use \Falbar\Bitrix\Highload;
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

## add

**add(int $iHighloadID = 0, array $arParams = [])**

Метод добавляет элемент хайлоуд блока.

**Параметры**

* `$iHighloadID` - ID хайлоуд блока;
* `$arParams` - массив добавляемых полей со значениями (необязательный).

**Возвращает**

* `ID хайлоуд элемента` / `0`.

**Пример заполнения `$arParams`**

```php
[
    'UF_PARAM_NAME_1' => 'UF_PARAM_VALUE_1',
    'UF_PARAM_NAME_2' => 'UF_PARAM_VALUE_2'
    'UF_PARAM_NAME_3' => 'UF_PARAM_VALUE_3'
]
```

## update

**update(int $iHighloadID = 0, int $iHighloadElementID = 0, array $arParams = [])**

Метод обновляет значения полей хайлоуд блока.

**Параметры**

* `$iHighloadID` - ID хайлоуд блока;
* `$iHighloadElementID` - ID элемента;
* `$arParams` - массив обновляемых полей со значениями.

**Возвращает**

* `true` / `false`.

**Пример заполнения `$arParams`**

```php
[
    'UF_PARAM_NAME_1' => 'UF_PARAM_VALUE_1',
    'UF_PARAM_NAME_2' => 'UF_PARAM_VALUE_2'
    'UF_PARAM_NAME_3' => 'UF_PARAM_VALUE_3'
]
```

## delete

**delete(int $iHighloadID = 0, int $iHighloadElementID = 0)**

Метод удаляет элемент хайлоуд блока.

**Параметры**

* `$iHighloadID` - ID хайлоуд блока;
* `$iHighloadElementID` - ID элемента.

**Возвращает**

* `true` / `false`.

## getElements

**getElements(int $iHighloadID = 0, array $arParams = [])**

Метод получает список элементов хайлоуд блока.

**Параметры**

* `$iHighloadID` - ID хайлоуд блока;
* `$arParams` - массив с заданными параметрами (необязательный):
    * `order` - ASC | DESC направление сортировки;
    * `limit` - количество возвращаемых элементов;
    * `filter` - массив фильтров выборки;
    * `select` - возвращаемый массив полей элемента.

**Возвращает**

* `Массив элементов хайлоуд блока` / `[]`.

**Пример заполнения `$arParams`**

```php
[
    'order' => 'desc',
    'limit' => 2,
    'filter' => ['=ID' => 5],
    'select' => ['ID', 'UF_NAME']
]
```