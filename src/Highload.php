<?php
/**
 * Appointment: Хайлоуд блок
 * Description: Набор полезных методов для хайлоуд блоков
 * File: Highload.php
 * Version: 0.0.2
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix;

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock\HighloadBlockTable;

Loader::includeModule('highloadblock');

/**
 * Class Highload
 * @package Falbar\Bitrix
 */
class Highload
{
    /**
     * Индификатор хайлоуд блока по названию и названию таблицы
     * @param string $sName
     * @param string $sDBName
     * @return int
     */
    public static function getID($sName = '', $sDBName = '')
    {
        if ($sName && $sDBName) {
            $arHighload = HighloadBlockTable::getList([
                'filter' => [
                    '=NAME' => $sName,
                    '=TABLE_NAME' => $sDBName
                ],
                'select' => ['ID']
            ])->fetch();

            if (!empty($arHighload['ID'])) {
                return $arHighload['ID'];
            }
        }

        return 0;
    }

    /**
     * Название класса хайлоуда
     * @param int $iHighloadID
     * @return string
     */
    public static function getClassName($iHighloadID = 0)
    {
        if ($iHighloadID) {
            $arHighload = HighloadBlockTable::getById($iHighloadID)->fetch();

            if ($arHighload) {
                $oEntity = HighloadBlockTable::compileEntity($arHighload);

                return $oEntity->getDataClass();
            }
        }

        return '';
    }

    /**
     * Добавить элемент
     * @param int $iHighloadID
     * @param array $arParams
     * @return int
     */
    public static function add($iHighloadID = 0, $arParams = [])
    {
        if ($iHighloadID) {
            $sClassName = self::getClassName($iHighloadID);

            if ($sClassName) {
                return $sClassName::add($arParams)->getId();
            }
        }

        return 0;
    }

    /**
     * Обновить элемент
     * @param int $iHighloadID
     * @param int $iHighloadElementID
     * @param array $arParams
     * @return bool
     */
    public static function update($iHighloadID = 0, $iHighloadElementID = 0, $arParams = [])
    {
        if ($iHighloadID && $iHighloadElementID && $arParams) {
            $sClassName = self::getClassName($iHighloadID);

            if ($sClassName) {
                return $sClassName::update($iHighloadElementID, $arParams)->isSuccess();
            }
        }

        return false;
    }

    /**
     * Удалить элемент
     * @param int $iHighloadID
     * @param int $iHighloadElementID
     * @return bool
     */
    public static function delete($iHighloadID = 0, $iHighloadElementID = 0)
    {
        if ($iHighloadID && $iHighloadElementID) {
            $sClassName = self::getClassName($iHighloadID);

            if ($sClassName) {
                return $sClassName::delete($iHighloadElementID)->isSuccess();
            }
        }

        return false;
    }

    /**
     * Список элементов
     * @param int $iHighloadID
     * @param array $arParams
     * @return array
     */
    public static function getElements($iHighloadID = 0, $arParams = [])
    {
        $arResult = [];

        if ($iHighloadID) {
            $sClassName = self::getClassName($iHighloadID);

            if ($sClassName) {
                $arFilter = !empty($arParams['filter']) && is_array($arParams['filter']) ? $arParams['filter'] : [];
                $arOrder = !empty($arParams['order']) && strtoupper($arParams['order']) == 'DESC' ? ['ID' => 'DESC'] : ['ID' => 'ASC'];
                $iLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? $arParams['limit'] : 0;
                $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : ['*'];

                $oElement = $sClassName::getList([
                    'filter' => $arFilter,
                    'order' => $arOrder,
                    'limit' => $iLimit,
                    'select' => $arSelect
                ]);

                while ($arElement = $oElement->fetch()) {
                    $arResult[] = $arElement;
                }
            }
        }

        return $arResult;
    }
}