# Bitrix, [Packagist](https://packagist.org/packages/falbar/bitrix)

Набор полезных методов для работы с Битрикс API.

## Содержание

* Требования;
* Установка;
* Документация:
    * [Консольные команды](.docs/console.md);
    * Вспомогательные классы:
        * Helper - набор полезных методов:
            * [Helper](.docs/Helper/Helper.md):
                * [isMainPage](.docs/Helper/Helper.md#isMainPage) - метод проверяет главную страницу;
                * [isSection](.docs/Helper/Helper.md#isSection) - метод проверяет нахождение в разделе;
                * [getSVGByName](.docs/Helper/Helper.md#getSVGByName) - метод получает содержимое SVG файла;
                * [printSVGByName](.docs/Helper/Helper.md#printSVGByName) - метод отображает SVG.
            * [Validator](.docs/Helper/Validator.md):
                * [clearString](.docs/Helper/Validator.md#clearString) - метод очищает строковые данные;
                * [clearInt](.docs/Helper/Validator.md#clearInt) - метод очищает числовые данные.
        * Highload - методы для работы с хайлоадами:
            * [Highload](.docs/Highload/Highload.md):
                * [getID](.docs/Highload/Highload.md#getID) - метод получает индификатор хайлоуд блока по названию и названию таблицы;
                * [getClassName](.docs/Highload/Highload.md#getClassName) - метод получает название класса хайлоуд блока.
            * [Element](.docs/Highload/Element.md):
                * [add](.docs/Highload/Element.md#add) - метод добавляет элемент хайлоуд блока;
                * [update](.docs/Highload/Element.md#update) - метод обновляет значения полей хайлоуд блока;
                * [delete](.docs/Highload/Element.md#delete) - метод удаляет элемент хайлоуд блока;
                * [getList](.docs/Highload/Element.md#getList) - метод получает список элементов хайлоуд блока.
        * IBlock - методы для работы с инфоблоками:
            * [IBlock](.docs/IBlock/IBlock.md):
                * [getID](.docs/IBlock/IBlock.md#getID) - метод получает индификатор инфоблока по его коду и типу.
            * [Element](.docs/IBlock/Element.md):
                * [getList](.docs/IBlock/Element.md#getList) - метод получает список элементов инфоблока.
            * [Prop](.docs/IBlock/Prop.md):
                * [getID](.docs/IBlock/Prop.md#getID).
        * [Mail](.docs/Mail.md) - методы для работы с почтой:
            * [addEvent](.docs/Mail.md#addEvent) - метод создает почтовое событие;
            * [addTemplate](.docs/Mail.md#addTemplate) - метод создает почтовый шаблон для события.
        * [Product](.docs/Product.md) - методы для работы с товарами:
            * [getPrice](.docs/Product.md#getPrice) - метод получает цену на товар.
        * [Order](.docs/Order.md) - методы для работы с заказами:
            * [addProp](.docs/Order.md#addProp) - метод добавляет существующие, но не заданное свойство к заказу;
            * [updateProp](.docs/Order.md#updateProp) - метод обновляет значение свойства заказа;
            * [getProps](.docs/Order.md#getOrderProps) - метод получает набор свойств относящихся к заказу.
* Статья.

## Требования

* Требуется версия 1С-Битрикс от `17.0.0`;
* PHP от `7.1`.

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