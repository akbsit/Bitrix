<?php
/**
 * Appointment: Хайлоуд блок
 * Description: Набор полезных методов для хайлоуд блоков
 * File: Highload.php
 * Version: 0.0.1
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
    public static function getId($sName = '', $sDBName = '')
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
     * @param int $iHighloadId
     * @return string
     */
    public static function getClassName($iHighloadId = 0)
    {
        if ($iHighloadId) {
            $arHighload = HighloadBlockTable::getById($iHighloadId)->fetch();

            if ($arHighload) {
                $oEntity = HighloadBlockTable::compileEntity($arHighload);

                return $oEntity->getDataClass();
            }
        }

        return '';
    }

    /**
     * Добавить элемент
     * @param int $iHighloadId
     * @param array $arParams
     * @return int
     */
    public static function add($iHighloadId = 0, $arParams = [])
    {
        if ($iHighloadId) {
            $sClassName = self::getClassName($iHighloadId);

            if ($sClassName) {
                return $sClassName::add($arParams)->getId();
            }
        }

        return 0;
    }

    /**
     * Обновить элемент
     * @param int $iHighloadId
     * @param int $iHighloadElementId
     * @param array $arParams
     * @return bool
     */
    public static function update($iHighloadId = 0, $iHighloadElementId = 0, $arParams = [])
    {
        if ($iHighloadId && $iHighloadElementId && $arParams) {
            $sClassName = self::getClassName($iHighloadId);

            if ($sClassName) {
                return $sClassName::update($iHighloadElementId, $arParams)->isSuccess();
            }
        }

        return false;
    }

    /**
     * Удалить элемент
     * @param int $iHighloadId
     * @param int $iHighloadElementId
     * @return bool
     */
    public static function delete($iHighloadId = 0, $iHighloadElementId = 0)
    {
        if ($iHighloadId && $iHighloadElementId) {
            $sClassName = self::getClassName($iHighloadId);

            if ($sClassName) {
                return $sClassName::delete($iHighloadElementId)->isSuccess();
            }
        }

        return false;
    }

    /**
     * Список элементов
     * @param int $iHighloadId
     * @param array $arParams
     * @return array
     */
    public static function getElements($iHighloadId = 0, $arParams = [])
    {
        $arResult = [];

        if ($iHighloadId) {
            $sClassName = self::getClassName($iHighloadId);

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