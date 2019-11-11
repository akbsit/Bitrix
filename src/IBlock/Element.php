<?php
/**
 * Appointment: Элемент информационного блока
 * Description: Набор полезных методов для элемента информационного блока
 * File: Element.php
 * Version: 0.0.1
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
     * @param int $iIBlockID
     * @param array $arParams
     * @param string $sGetList
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