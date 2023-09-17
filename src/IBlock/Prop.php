<?php namespace Akbsit\Bitrix\IBlock;

use \Bitrix\Main\Loader;

Loader::includeModule('iblock');

/**
 * Class Prop
 * @package Akbsit\Bitrix\IBlock
 */
class Prop
{
    const PROP_STRING = 'S';

    /**
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
