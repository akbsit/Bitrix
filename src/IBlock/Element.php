<?php
/**
 * Appointment: Элемент информационного блока
 * Description: Набор полезных методов для элемента информационного блока
 * File: Element.php
 * Version: 0.0.2
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class Element
 * @package Falbar\Bitrix\IBlock
 */
class Element
{
    /**
     * Тип получения выборки fetch
     */
    const GETLIST_FETCH = 'fetch';

    /**
     * Тип получения выборки getNext
     */
    const GETLIST_GETNEXT = 'getNext';

    /**
     * Список элементов
     * @param int $iIBlockID ID инфоблока
     * @param array $arParams Массив с заданными параметрами (необязательный)
     * [
     *     'select' => ['ID', 'NAME'], Возвращаемый массив полей элемента;
     *     'limit' => 5, Количество возвращаемых элементов
     *     'filter' => [], Массив фильтров выборки
     *     'order' => 'desc' Направление сортировки (необязательный, по умолчанию DESC по ID)
     * ]
     * @param string $sGetList Тип получения выборки (Element::GETLIST_FETCH, Element::GETLIST_GETNEXT)
     * @return array
     */
    public static function getList($iIBlockID = 0, $arParams = [], $sGetList = self::GETLIST_FETCH)
    {
        $arResult = [];

        if ($iIBlockID) {
            $arFilter = !empty($arParams['filter']) && is_array($arParams['filter']) ? $arParams['filter'] : [];
            $arOrder = !empty($arParams['order']) && is_array($arParams['order']) ? $arParams['order'] : ['ID' => 'DESC'];
            $arLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? ['nTopCount' => $arParams['limit']] : [];
            $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : [];

            unset($arFilter['=IBLOCK_ID'], $arFilter['IBLOCK_ID']);

            $arFilter['=IBLOCK_ID'] = $iIBlockID;

            $oElement = \CIBlockElement::getList($arOrder, $arFilter, false, $arLimit, $arSelect);

            while ($arElement = $oElement->{$sGetList}()) {
                $arResult[] = $arElement;
            }
        }

        return $arResult;
    }
}