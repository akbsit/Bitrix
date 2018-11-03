# Bitrix

Набор полезных методов для работы с Битрикс API.

Для установки библиотеки нужно в папке `local` выполнить команду:

```
composer require falbar/Bitrix "1.*"
```

и подключить `autoload.php` в файлле `php_interface/init.php`:

```
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php');
```

## Документация

### Highload (Хайлоад)

**\Falbar\Bitrix\Highload::getId()**

Метод получает ндификатор хайлоуд блока по названию и названию таблицы.

```php
$iId = \Falbar\Bitrix\Highload::getId(
    'TableName', // string название хайлоуд блока
    'tableName' // string название таблицы
);
```

При успешной отработке возвращает – **ID хайлоуд блока** в другом случае – **0**.

**\Falbar\Bitrix\Highload::getClassName()**

Метод получает название класса хайлоуд блока.

```php
$sClassName = \Falbar\Bitrix\Highload::getClassName(
    5 // int ID хайлоуд блока
);
```

При успешной отработке возвращает – **название класса** в другом случае – **пустую строку**.

**\Falbar\Bitrix\Highload::add()**

Метод добавляет элемент хайлоуд блока.

```php
$iId = \Falbar\Bitrix\Highload::add(
    5, // int ID хайлоуд блока
    [
        'UF_PARAM_NAME' => 'UF_PARAM_VALUE'
    ]  // array массив добавляемых полей со значениями (необязательный)
);
```

При успешной отработке возвращает – **ID хайлоуд элемента** в другом случае – **0**.

**\Falbar\Bitrix\Highload::update()**

Метод обновляет значения полей хайлоуд блока.

```php
$bUpdate = \Falbar\Bitrix\Highload::update(
    5, // int ID хайлоуд блока
    33, // int ID элемента
    [
        'UF_PARAM_NAME' => 'UF_PARAM_VALUE'
    ] // array массив обновляемых полей со значениями
);
```

При успешной отработке возвращает – **true** в другом случае – **false**.

**\Falbar\Bitrix\Highload::delete()**

Метод удаляет элемент хайлоуд блока.

```php
$bDelete = \Falbar\Bitrix\Highload::delete(
    5, // int ID хайлоуд блока
    33 // int ID элемента
);
```

При успешной отработке возвращает – **true** в другом случае – **false**.

**\Falbar\Bitrix\Highload::getElements()**

Метод получает список элементов хайлоуд блока.

```php
$arElements = \Falbar\Bitrix\Highload::getElements(
    5, // int ID хайлоуд блока
    [
        'order' => 'desc', // string ASC|DESC направление сортировки
        'limit' => 2, // int количество возвращаемых элементов
        'filter' => ['=ID' => 5], // array массив фильтров выборки
        'select' => ['ID', 'UF_NAME'] // array возвращаемый массив полей элемента
    ] // array (необязательный)
);
```

При успешной отработке возвращает – **массив элементов хайлоуд блока** в другом случае – **пустой массив**.

### IBlock (Инфоблок)

**\Falbar\Bitrix\IBlock::getId()**

Метод получает индификатор инфоблока по его коду и типу.

```php
$iId = \Falbar\Bitrix\IBlock::getId(
    'code', // string CODE инфоблока
    'type' // string ID типа инфоблока (необязательный)
);
```

При успешной отработке возвращает – **ID инфоблока** в другом случае – **0**.

**\Falbar\Bitrix\IBlock::getPropId()**

Метод получает индификатор свойства по его символьному коду.

```php
$iId = \Falbar\Bitrix\IBlock::getPropId(
    'code', // string CODE свойства
    3 // int ID инфоблока
);
```

При успешной отработке возвращает – **ID свойства** в другом случае – **0**.

**\Falbar\Bitrix\IBlock::getElements()**

Метод получает список элементов инфоблока.

```php
$arElements = \Falbar\Bitrix\IBlock::getElements(
    3, // int ID инфоблока
    [
        'select' => ['ID', 'NAME'], // array возвращаемый массив полей элемента
        'limit' => 5, // int количество возвращаемых элементов
        'order' => 'desc' // string ASC|DESC направление сортировки
    ] // array (необязательный)
);
```

При успешной отработке возвращает – **массив элементов инфоблока** в другом случае – **пустой массив**.

### Mail (Почта)

**\Falbar\Bitrix\Mail::addEvent()**

Метод создает почтовое событие.

```php
$iId = \Falbar\Bitrix\Mail::addEvent(
    'MY_MSG_EVENT', // string идентификатор почтового события
    'Почтовое событие', // string заголовок почтового события
    '
        #PARAM_1#
        #PARAM_2#
        #PARAM_3#
    ', // string описание задающее поля почтового события 
    'ru' (необязательный)
);
```

При успешной отработке возвращает - **ID добавленного события** в другом случае –  **0**.

**\Falbar\Bitrix\Mail::addTemplate()**

Метод создает почтовый шаблон для события.

```php
$iId = \Falbar\Bitrix\Mail::addTemplate(
    'EVENT_NAME', // string идентификатор почтового события
    'Заголовок письма', // string заголовок сообщения
    'Содержимое письма', // string тело почтового сообщения
    [
        'active' => 'Y', // string флаг активности почтового шаблона
        'lid' => ['s1'], // array идентификаторы сайта
        'mail-from' => '#EMAIL_FROM#', // string почта от кого
        'mail-to' => '#EMAIL_TO#', // string почта кому
        'body-type' => 'text' // string тип тела почтового сообщения
    ] // array (необязательный)
);
```

При успешной отработке возвращает - **ID добавленного шаблона** в другом случае –  **0**.

### Order (Заказ)

**\Falbar\Bitrix\Order::addProp()**

Метод добавляет существующие, но не заданное свойство к заказу.

```php
$iId = \Falbar\Bitrix\Order::addProp(
    5, // int ID заказа
    'ADDRESS', // string CODE свойства
    'ул. Могилевская' // string VALUE свойства (необязательный)
);
```

При успешной отработке возвращает - **ID добавленного свойства**. Если свойство было добавлено ранее или произошла ошибка –  **0**.

**\Falbar\Bitrix\Order::updateProp()**

Метод обновляет значение свойства заказа.

```php
$iId = \Falbar\Bitrix\Order::updateProp(
    5, // int ID заказа
    'ADDRESS', // string CODE свойства
    'ул. Могилевская' // string VALUE свойства (необязательный)
);
```

При успешной отработке возвращает - **ID обновленного свойства**.  Если свойства не существует или произошла ошибка –  **0**.

**\Falbar\Bitrix\Order::getOrderProps()**

Метод получает набор свойств относящихся к заказу.

```php
$arProps = \Falbar\Bitrix\Order::getOrderProps(5); // int ID заказа
```

При успешной отработке возвращает – **массив свойств** в другом случае – **пустой массив**.

### Product (Товар)

**\Falbar\Bitrix\Product::getPrice()**

Метод получает цену на товар.

```php
$arPrice = \Falbar\Bitrix\Product::getPrice(143); // int ID товара
```

При успешной отработке возвращает – **массив (валюта, базовая цена, цена со скидками)** в другом случае – **пустой массив**.

# Статья

[Добавление и обновление свойств в заказе с использованием Битрикс API](http://falbar.ru/article/dobavlenie-i-obnovlenie-svojstv-v-zakaze-s-ispolzovaniem-bitriks-api)