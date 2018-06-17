## getHighloadElements()

Сниппит получает список элементов highload-блока.

```php
$arElements = getHighloadElements(
    'tableName', // string название таблицы
    [ // array (необязательный)
        'order' => 'desc' // string ASC|DESC направление сортировки
        'limit' => // int количество возвращаемых элементов
        'filter' => ['=ID' => 5] // array массив фильтров выборки
        'select' => ['ID', 'UF_NAME'] // array возвращаемый массив полей элемента
    ]
);
```

При успешной отработке возвращает – **массив элементов highload-блока** в другом случае – **пустой массив**.