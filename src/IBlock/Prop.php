<?php
/**
 * Appointment: Свойства информационного блока
 * Description: Набор полезных методов для работы со свойствами
 * File: Prop.php
 * Version: 0.0.1
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class Prop
 * @package Falbar\Bitrix\IBlock
 */
class Prop
{
    /**
     * Тип свойства
     */
    const PROP_STRING = 'S';

    /**
     * Индификатор свойства по его символьному коду
     * @param int $iIBlockID
     * @param string $sCode
     * @param string $sType
     * @return int
     */
    public static function getID($iIBlockID = 0, $sCode = '', $sType = self::PROP_STRING)
    {
        $iResult = 0;

        if ($iIBlockID && $sCode) {
            $arProp = \CIBlockProperty::getList([], [
                'IBLOCK_ID' => $iIBlockID,
                'CODE' => $sCode,
                'PROPERTY_TYPE' => $sType
            ])->fetch();

            if (!empty($arProp['ID'])) {
                $iResult = $arProp['ID'];
            }
        }

        return $iResult;
    }
}