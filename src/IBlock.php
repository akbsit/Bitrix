<?php
/**
 * Appointment: Информационный блок
 * Description: Набор полезных методов для информационных блоков
 * File: IBlock.php
 * Version: 0.0.3
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class IBlock
 * @package Falbar\Bitrix
 */
class IBlock
{
    /**
     * Индификатор инфоблока по его коду и типу
     * @param string $sCode
     * @param string $sType
     * @return int
     */
    public static function getID($sCode = '', $sType = '')
    {
        if ($sCode) {
            $arFilter = [
                '=CODE' => $sCode
            ];

            if ($sType) {
                $arFilter['=TYPE'] = $sType;
            }

            $arIBlock = \CIBlock::getList([], $arFilter)->fetch();

            if (!empty($arIBlock['ID'])) {
                return $arIBlock['ID'];
            }
        }

        return 0;
    }

    /**
     * Индификатор свойства по его символьному коду
     * @param string $sCode
     * @param int $iIBlockID
     * @return int
     */
    public static function getPropID($sCode = '', $iIBlockID = 0)
    {
        if ($sCode && $iIBlockID) {
            $arProp = \CIBlockProperty::getList([], [
                'CODE' => $sCode,
                'IBLOCK_ID' => $iIBlockID
            ])->Fetch();

            if (!empty($arProp['ID'])) {
                return $arProp['ID'];
            }
        }

        return 0;
    }

    /**
     * Список элементов
     * @param int $iIBlockID
     * @param array $arParams
     * @return array
     */
    public static function getElements($iIBlockID = 0, $arParams = [])
    {
        $arResult = [];

        if ($iIBlockID) {
            $arOrder = !empty($arParams['order']) && strtoupper($arParams['order']) == 'DESC' ? ['ID' => 'DESC'] : ['ID' => 'ASC'];
            $arLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? ['nTopCount' => $arParams['limit']] : [];
            $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : [];

            $oElement = \CIBlockElement::getList($arOrder, [
                '=IBLOCK_ID' => $iIBlockID
            ], false, $arLimit, $arSelect);

            while ($arElement = $oElement->fetch()) {
                $arResult[] = $arElement;
            }
        }

        return $arResult;
    }
}