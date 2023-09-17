<?php namespace Akbsit\Bitrix\Highload;

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock\HighloadBlockTable;

Loader::includeModule('highloadblock');

/**
 * Class Highload
 * @package Akbsit\Bitrix\Highload
 */
class Highload
{
    /**
     * @param string $sName
     * @param string $sDBName
     * @return int
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getID($sName = '', $sDBName = '')
    {
        $iResult = 0;

        if ($sName && $sDBName) {
            $arHighload = HighloadBlockTable::getList([
                'filter' => [
                    '=NAME' => $sName,
                    '=TABLE_NAME' => $sDBName
                ],
                'select' => ['ID']
            ])->fetch();

            if (!empty($arHighload['ID'])) {
                $iResult = $arHighload['ID'];
            }
        }

        return $iResult;
    }

    /**
     * @param int $iHighloadID
     * @return string
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getClassName($iHighloadID = 0)
    {
        $sResult = '';

        if ($iHighloadID) {
            $arHighload = HighloadBlockTable::getById($iHighloadID)->fetch();

            if ($arHighload) {
                $oEntity = HighloadBlockTable::compileEntity($arHighload);

                $sResult = $oEntity->getDataClass();
            }
        }

        return $sResult;
    }
}
