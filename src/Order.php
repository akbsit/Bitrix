<?php
/**
 * Appointment: Заказ
 * Description: Набор полезных методов для работы с заказами
 * File: Order.php
 * Version: 0.0.2
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
     * @param int $iOrderID
     * @param string $sPropCode
     * @param string $sPropValue
     * @return int
     */
    public static function addProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')
    {
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
                    return $iPropID;
                }
            }
        }

        return 0;
    }

    /**
     * Обновляет значение свойства заказа
     * @param int $iOrderID
     * @param string $sPropCode
     * @param string $sPropValue
     * @return int
     */
    public static function updateProp($iOrderID = 0, $sPropCode = '', $sPropValue = '')
    {
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
                    return $iPropID;
                }
            }
        }

        return 0;
    }

    /**
     * Набор свойств относящихся к заказу
     * @param int $iOrderID
     * @return array
     */
    public static function getOrderProps($iOrderID = 0)
    {
        if ($iOrderID) {
            $arProps = OrderPropsValueTable::getList([
                'filter' => [
                    '=ORDER_ID' => $iOrderID
                ],
            ])->fetchAll();

            if (!empty($arProps)) {
                return $arProps;
            }
        }

        return [];
    }
}