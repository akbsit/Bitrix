<?php
/**
 * Appointment: Хайлоуд элемент
 * Description: Набор полезных методов для хайлоуд элементов
 * File: Element.php
 * Version: 0.0.2
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
     * @param int $iHighloadID ID хайлоуд блока
     * @param array $arParams Массив с заданными параметрами (необязательный)
     * [
     *     'order' => 'desc', Направление сортировки (необязательный, по умолчанию DESC по ID)
     *     'limit' => 2, Количество возвращаемых элементов
     *     'filter' => ['=ID' => 5], Массив фильтров выборки
     *     'select' => ['ID', 'UF_NAME'] Возвращаемый массив полей элемента
     * ]
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
     * @param int $iHighloadID ID хайлоуд блока
     * @param array $arParams Массив добавляемых полей со значениями (необязательный)
     * [
     *     'UF_PARAM_NAME_1' => 'UF_PARAM_VALUE_1',
     *     'UF_PARAM_NAME_2' => 'UF_PARAM_VALUE_2',
     *     'UF_PARAM_NAME_3' => 'UF_PARAM_VALUE_3'
     * ]
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
     * @param int $iHighloadID ID хайлоуд блока
     * @param int $iHighloadElementID ID элемента
     * @param array $arParams Массив обновляемых полей со значениями
     * [
     *     'UF_PARAM_NAME_1' => 'UF_PARAM_VALUE_1',
     *     'UF_PARAM_NAME_2' => 'UF_PARAM_VALUE_2',
     *     'UF_PARAM_NAME_3' => 'UF_PARAM_VALUE_3'
     * ]
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
     * @param int $iHighloadID ID хайлоуд блока
     * @param int $iHighloadElementID ID элемента
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