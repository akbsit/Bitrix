<?php
/**
 * Appointment: Хайлоуд блок
 * Description: Набор полезных методов для хайлоуд блоков
 * File: Highload.php
 * Version: 0.0.4
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Highload;

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock\HighloadBlockTable;

Loader::includeModule('highloadblock');

/**
 * Class Highload
 * @package Falbar\Bitrix\Highload
 */
class Highload
{
    /**
     * Индификатор хайлоуд блока по названию и названию таблицы
     * @param string $sName Название хайлоуд блока
     * @param string $sDBName Название таблицы
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
     * Название класса хайлоуда
     * @param int $iHighloadID
     * @return string ID хайлоуд блока
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