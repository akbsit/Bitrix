<?php
/**
 * Appointment: Информационный блок
 * Description: Набор полезных методов для информационных блоков
 * File: IBlock.php
 * Version: 0.0.4
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class IBlock
 * @package Falbar\Bitrix\IBlock
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
        $iResult = 0;

        if ($sCode) {
            $arFilter = [
                '=CODE' => $sCode
            ];

            if ($sType) {
                $arFilter['=TYPE'] = $sType;
            }

            $arIBlock = \CIBlock::getList([], $arFilter)->fetch();

            if (!empty($arIBlock['ID'])) {
                $iResult = $arIBlock['ID'];
            }
        }

        return $iResult;
    }
}