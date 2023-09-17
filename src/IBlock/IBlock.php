<?php namespace Akbsit\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class IBlock
 * @package Akbsit\Bitrix\IBlock
 */
class IBlock
{
    /**
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
