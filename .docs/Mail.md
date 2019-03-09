# Mail

```php
use \Falbar\Bitrix\Mail;
```

## addEvent

**addEvent(string $sEventName = '', string $sName = '', string $sDescription = '', string $sLang = 'ru')**

Метод создает почтовое событие.

**Параметры**

* `$sEventName` - ID почтового события;
* `$sName` - заголовок почтового события;
* `$sDescription` - описание задающее поля почтового события;
* `$sLang` - язык (необязательный).

**Возвращает**

* `ID добавленного события` / `0`.

## addTemplate

**addTemplate(string $sEventName = '', string $sSubject = '', string $sMessage = '', array $arParams = [])**

Метод создает почтовый шаблон для события.

**Параметры**

* `$sEventName` - ID почтового события;
* `$sSubject` - заголовок сообщения;
* `$sMessage` - тело почтового сообщения;
* `$arParams` - массив с заданными параметрами (необязательный):
    * `active` - флаг активности почтового шаблона;
    * `lid` - IDs сайтов;
    * `mail-from` - почта от кого;
    * `mail-to` - почта кому;
    * `body-type` - тип тела почтового сообщения.

**Возвращает**

* `ID добавленного шаблона` / `0`.

**Пример заполнения `$arParams`**

```php
[
    'active' => 'Y',
    'lid' => ['s1'],
    'mail-from' => '#EMAIL_FROM#',
    'mail-to' => '#EMAIL_TO#',
    'body-type' => 'text'
]
```