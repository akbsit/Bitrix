# Bitrix

## Order (Заказ)

* addOrderProperty()

Сниппет динамически добавляет свойство к заказу.

```php
    $id = addOrderProperty([
        'order' => 5,                // int ID заказа
        'code'  => 'ADDRESS',        // string CODE заказа
        'value' => 'ул. Могилевская' // string VALUE заказа
    ]);
```

При успешной отработке возвращает - **ID добавленного свойства**. Если свойство было добавлено ранее или произошла ошибка –  **false**.