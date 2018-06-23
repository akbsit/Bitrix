## getHighloadId()

Сниппет получает индификатор highload-блока по названию таблицы.

```php
$iId = getHighloadId(
    'table_name', // string название таблицы с элементами highload-блока
    'TableName' // string название highload-блока (необязательный)
);
```

При успешной отработке возвращает – **ID highload-блока** в другом случае – **0**.

## getHighloadElements()

Сниппит получает список элементов highload-блока.

```php
$arElements = getHighloadElements(
    'tableName', // string название таблицы
    [
        'order' => 'desc', // string ASC|DESC направление сортировки
        'limit' => 2, // int количество возвращаемых элементов
        'filter' => ['=ID' => 5], // array массив фильтров выборки
        'select' => ['ID', 'UF_NAME'] // array возвращаемый массив полей элемента
    ] // array (необязательный)
);
```

При успешной отработке возвращает – **массив элементов highload-блока** в другом случае – **пустой массив**.

## updateHighloadElement()

Сниппет обновляет значения полей highload-блока.

```php
$bUpdate = updateHighloadElement(
    'tableName', // string название таблицы
    5, // int ID элемента
    [
        'UF_NAME' => 'Новое имя'
    ] // array массив обновляемых полей со значениями
);
```

При успешной отработке возвращает – **true** в другом случае – **false**.