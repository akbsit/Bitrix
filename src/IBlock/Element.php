<?php namespace Akbsit\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class Element
 * @package Akbsit\Bitrix\IBlock
 */
class Element
{
    const GETLIST_FETCH = 'fetch';

    const GETLIST_GETNEXT = 'getNext';

    /**
     * @param int $iIBlockID
     * @param array $arParams
     * [
     *     'select' => ['ID', 'NAME'],
     *     'limit' => 5,
     *     'filter' => [],
     *     'order' => 'desc'
     * ]
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
