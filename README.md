# Bitrix, [Packagist](https://packagist.org/packages/falbar/bitrix)

Набор полезных методов для работы с Битрикс API.

## Содержание

* Требования;
* Установка;
* Документация:
    * [Консольные команды](.docs/console.md);
    * Вспомогательные классы:
        * `\Falbar\Bitrix\Helper\` - набор полезных методов:
            * `Helper::isMainPage()` - метод проверяет главную страницу;
            * `Helper::isSection($sSection = '')` - метод проверяет нахождение в разделе;
            * `Helper::getSVGByName($sName, $sPath = '/local/svg/')` - метод получает содержимое SVG файла;
            * `Helper::printSVGByName($sName, $sPath = '/local/svg/')` - метод отображает SVG;
            * `Validator::clearString($string, $arExclude = [])` - метод очищает строковые данные;
            * `Validator::clearInt($int, $arExclude = [])` - метод очищает числовые данные.
        * `\Falbar\Bitrix\Highload\` - методы для работы с хайлоадами:
            * `Highload::getID($sName = '', $sDBName = '')` - метод получает индификатор хайлоуд блока по названию и названию таблицы;
            * `Highload::getClassName($iHighloadID = 0)` - метод получает название класса хайлоуд блока;
            * `Element::add($iHighloadID = 0, $arParams = [])` - метод добавляет элемент хайлоуд блока;
            * `Element::update($iHighloadID = 0, $iHighloadElementID = 0, $arParams = [])` - метод обновляет значения полей хайлоуд блока;
            * `Element::delete($iHighloadID = 0, $iHighloadElementID = 0)` - метод удаляет элемент хайлоуд блока;
            * `Element::getList($iHighloadID = 0, $arParams = [])` - метод получает список элементов хайлоуд блока.
        * `\Falbar\Bitrix\IBlock\` - методы для работы с инфоблоками:
            * `IBlock::getID($sCode = '', $sType = '')` - метод получает индификатор инфоблока по его коду и типу;
            * `Element::getList($iIBlockID = 0, $arParams = [], Element::GETLIST_FETCH)` - метод получает список элементов инфоблока;
            * `Prop::getID($iIBlockID = 0, $sCode = '', Prop::PROP_STRING)` - индификатор свойства по его символьному коду.
        * `\Falbar\Bitrix\Mail` - методы для работы с почтой:
            * `::addEvent($sEventName = '', $sName = '', $sDescription = '', $sLang = 'ru')` - метод создает почтовое событие;
            * `::addTemplate($sEventName = '', $sSubject = '', $sMessage = '', $arParams = [])` - метод создает почтовый шаблон для события.
        * `\Falbar\Bitrix\Product` - методы для работы с товарами:
            * `::getPrice($iProductID = 0)` - метод получает цену на товар.
        * `\Falbar\Bitrix\Order` - методы для работы с заказами:
            * `::addProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')` - метод добавляет существующие, но не заданное свойство к заказу;
            * `::updateProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')` - метод обновляет значение свойства заказа;
            * `::getProps($iOrderID = 0)` - метод получает набор свойств относящихся к заказу.
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