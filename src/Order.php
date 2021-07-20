<?php
/**
 * Appointment: Заказ
 * Description: Набор полезных методов для работы с заказами
 * File: Order.php
 * Version: 0.0.4
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix;

use \Bitrix\Main\Loader;
use \Bitrix\Sale\Internals\OrderPropsValueTable;

Loader::includeModule('sale');

/**
 * Class Order
 * @package Falbar\Bitrix
 */
class Order
{
    /**
     * Добавляет существующие, но не заданное свойство к заказу
     * @param int $iOrderID ID заказа
     * @param string $sPropCode CODE свойства
     * @param string $sPropValue VALUE свойства (необязательный)
     * @return int
     */
    public static function addProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')
    {
        $iResult = 0;

        if ($iOrderID && $sPropCode) {
            if ($arProp = \CSaleOrderProps::getList([], ['=CODE' => $sPropCode])->Fetch()) {
                $iPropID = \CSaleOrderPropsValue::add([
                    'NAME' => $arProp['NAME'],
                    'CODE' => $arProp['CODE'],
                    'ORDER_PROPS_ID' => $arProp['ID'],
                    'ORDER_ID' => $iOrderID,
                    'VALUE' => $sPropValue ? $sPropValue : ''
                ]);

                if ($iPropID) {
                    $iResult = $iPropID;
                }
            }
        }

        return $iResult;
    }

    /**
     * Обновляет значение свойства заказа
     * @param int $iOrderID ID заказа
     * @param string $sPropCode CODE свойства
     * @param string $sPropValue VALUE свойства (необязательный)
     * @return int
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function updateProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')
    {
        $iResult = 0;

        if ($iOrderID && $sPropCode) {
            $arProp = OrderPropsValueTable::getList([
                'filter' => [
                    '=ORDER_ID' => $iOrderID,
                    '=CODE' => $sPropCode
                ]
            ])->Fetch();

            if ($arProp) {
                $iPropID = \CSaleOrderPropsValue::Update($arProp['ID'], [
                    'VALUE' => $sPropValue ? $sPropValue : ''
                ]);

                if ($iPropID) {
                    $iResult = $iPropID;
                }
            }
        }

        return $iResult;
    }

    /**
     * Набор свойств относящихся к заказу
     * @param int $iOrderID ID заказа
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getProps($iOrderID = 0)
    {
        $arResult = [];

        if ($iOrderID) {
            $arProps = OrderPropsValueTable::getList([
                'filter' => [
                    '=ORDER_ID' => $iOrderID
                ],
            ])->fetchAll();

            if (!empty($arProps)) {
                $arResult = $arProps;
            }
        }

        return $arResult;
    }
}