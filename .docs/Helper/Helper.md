# Helper

```php
use \Falbar\Bitrix\Helper\Helper;
```

## isMainPage

**isMainPage()**

Метод проверяет главную страницу.

**Возвращает**

* `true` / `false`.

## isSection

**isSection(string $sSection = '')**

Метод проверяет нахождение в разделе.

**Параметры**

`$sSection` - раздел.

**Возвращает**

* `true` / `false`.

## getSVGByName

**getSVGByName(string $sName, string $sPath = '/local/svg/')**

Метод получает содержимое SVG файла.

**Параметры**

`$sName` - название файла;
`$sPath` - путь до файла.

**Возвращает**

* `Строка`.

## printSVGByName

**printSVGByName(string $sName, string $sPath = '/local/svg/')**

Метод отображает SVG.

**Параметры**

`$sName` - название файла;
`$sPath` - путь до файла.

**Возвращает**

* `Строка`.