<?php
/**
 * Appointment: Хайлоуд элемент
 * Description: Набор полезных методов для хайлоуд элементов
 * File: Element.php
 * Version: 0.0.1
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Highload;

/**
 * Class Element
 * @package Falbar\Bitrix\Highload
 */
class Element
{
    /**
     * Список элементов
     * @param int $iHighloadID
     * @param array $arParams
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getList($iHighloadID = 0, $arParams = [])
    {
        $arResult = [];

        if ($iHighloadID) {
            $sClassName = Highload::getClassName($iHighloadID);

            if ($sClassName) {
                $arFilter = !empty($arParams['filter']) && is_array($arParams['filter']) ? $arParams['filter'] : [];
                $arOrder = !empty($arParams['order']) && is_array($arParams['order']) ? $arParams['order'] : ['ID' => 'DESC'];
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

    /**
     * Добавить элемент
     * @param int $iHighloadID
     * @param array $arParams
     * @return int
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function add($iHighloadID = 0, $arParams = [])
    {
        $iResult = 0;

        if ($iHighloadID) {
            $sClassName = Highload::getClassName($iHighloadID);

            if ($sClassName) {
                $iResult = $sClassName::add($arParams)->getId();
            }
        }

        return $iResult;
    }

    /**
     * Обновить элемент
     * @param int $iHighloadID
     * @param int $iHighloadElementID
     * @param array $arParams
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function update($iHighloadID = 0, $iHighloadElementID = 0, $arParams = [])
    {
        $bResult = false;

        if ($iHighloadID && $iHighloadElementID && $arParams) {
            $sClassName = Highload::getClassName($iHighloadID);

            if ($sClassName) {
                $bResult = $sClassName::update($iHighloadElementID, $arParams)->isSuccess();
            }
        }

        return $bResult;
    }

    /**
     * Удалить элемент
     * @param int $iHighloadID
     * @param int $iHighloadElementID
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function delete($iHighloadID = 0, $iHighloadElementID = 0)
    {
        $bResult = false;

        if ($iHighloadID && $iHighloadElementID) {
            $sClassName = Highload::getClassName($iHighloadID);

            if ($sClassName) {
                $bResult = $sClassName::delete($iHighloadElementID)->isSuccess();
            }
        }

        return $bResult;
    }
}