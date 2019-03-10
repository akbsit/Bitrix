# Bitrix, [Packagist](https://packagist.org/packages/falbar/bitrix)

Набор полезных методов для работы с Битрикс API.

## Содержание

* Требования;
* Установка;
* Документация:
    * [Highload](.docs/Highload.md) - методы для работы с хайлоадами:
        * [getID](.docs/Highload.md#getID) - метод получает индификатор хайлоуд блока по названию и названию таблицы;
        * [getClassName](.docs/Highload.md#getClassName) - метод получает название класса хайлоуд блока;
        * [add](.docs/Highload.md#add) - метод добавляет элемент хайлоуд блока;
        * [update](.docs/Highload.md#update) - метод обновляет значения полей хайлоуд блока;
        * [delete](.docs/Highload.md#delete) - метод удаляет элемент хайлоуд блока;
        * [getElements](.docs/Highload.md#getElements) - метод получает список элементов хайлоуд блока.
    * [IBlock](.docs/IBlock.md) - методы для работы с инфоблоками:
        * [getID](.docs/IBlock.md#getID) - метод получает индификатор инфоблока по его коду и типу;
        * [getPropID](.docs/IBlock.md#getPropID) - метод получает индификатор свойства по его символьному коду;
        * [getElements](.docs/IBlock.md#getElements) - метод получает список элементов инфоблока.
    * [Mail](.docs/Mail.md) - методы для работы с почтой:
        * [addEvent](.docs/Mail.md#addEvent) - метод создает почтовое событие;
        * [addTemplate](.docs/Mail.md#addTemplate) - метод создает почтовый шаблон для события.
    * [Product](.docs/Product.md) - методы для работы с товарами:
        * [getPrice](.docs/Product.md#getPrice) - метод получает цену на товар.
    * [Order](.docs/Order.md) - методы для работы с заказами:
        * [addProp](.docs/Order.md#addProp) - метод добавляет существующие, но не заданное свойство к заказу;
        * [updateProp](.docs/Order.md#updateProp) - метод обновляет значение свойства заказа;
        * [getOrderProps](.docs/Order.md#getOrderProps) - метод получает набор свойств относящихся к заказу.
* Статья.

## Требования

* Требуется версия 1С-Битрикс от `17.0.0`.

## Установка

Для установки библиотеки нужно в папке `local` выполнить команду:

```
composer require falbar/bitrix "1.*"
```

и подключить `autoload.php` в файле `php_interface/init.php`:

```php
require_once($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php');
```

## Статья

[Добавление и обновление свойств в заказе с использованием Битрикс API](http://falbar.ru/article/dobavlenie-i-obnovlenie-svojstv-v-zakaze-s-ispolzovaniem-bitriks-api)