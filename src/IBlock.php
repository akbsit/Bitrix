<?php
/**
 * Appointment: Информационный блок
 * Description: Набор полезных методов для информационных блоков
 * File: IBlock.php
 * Version: 0.0.1
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
     * Индификатор инфоблока по его коду
     * @param string $sCode
     * @param string $sType
     * @return int
     */
    public static function getId($sCode = '', $sType = '')
    {
        if ($sCode) {
            $arFilter = [
                '=CODE' => $sCode
            ];

            if ($sType) {
                $arFilter['=TYPE'] = $sType;
            }

            $arIBlock = \CIBlock::GetList([], $arFilter)->fetch();

            if (!empty($arIBlock['ID'])) {
                return $arIBlock['ID'];
            }
        }

        return 0;
    }

    /**
     * Индификатор свойства по его символьному коду
     * @param string $sCode
     * @param int $iIBlockId
     * @return int
     */
    public static function getPropId($sCode = '', $iIBlockId = 0)
    {
        if ($sCode && $iIBlockId) {
            $arProp = \CIBlockProperty::GetList([], [
                'CODE' => $sCode,
                'IBLOCK_ID' => $iIBlockId
            ])->Fetch();

            if (!empty($arProp['ID'])) {
                return $arProp['ID'];
            }
        }

        return 0;
    }

    /**
     * Список элементов
     * @param int $iIBlockId
     * @param array $arParams
     * @return array
     */
    public static function getElements($iIBlockId = 0, $arParams = [])
    {
        $arResult = [];

        if ($iIBlockId) {
            $arOrder = !empty($arParams['order']) && strtoupper($arParams['order']) == 'DESC' ? ['ID' => 'DESC'] : ['ID' => 'ASC'];
            $arLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? ['nTopCount' => $arParams['limit']] : [];
            $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : [];

            $oElement = \CIBlockElement::getList($arOrder, [
                '=IBLOCK_ID' => $iIBlockId
            ], false, $arLimit, $arSelect);

            while ($arElement = $oElement->fetch()) {
                $arResult[] = $arElement;
            }
        }

        return $arResult;
    }
}