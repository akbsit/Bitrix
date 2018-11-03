<?php
/**
 * Appointment: Заказ
 * Description: Набор полезных методов для работы с заказами
 * File: Order.php
 * Version: 0.0.1
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
     * @param int $iOrderId
     * @param string $sPropCode
     * @param string $sPropValue
     * @return int
     */
    public static function addProp($iOrderId = 0, $sPropCode = '', $sPropValue = '')
    {
        if ($iOrderId && $sPropCode) {
            if ($arProp = \CSaleOrderProps::getList([], ['=CODE' => $sPropCode])->Fetch()) {
                $iPropId = \CSaleOrderPropsValue::add([
                    'NAME' => $arProp['NAME'],
                    'CODE' => $arProp['CODE'],
                    'ORDER_PROPS_ID' => $arProp['ID'],
                    'ORDER_ID' => $iOrderId,
                    'VALUE' => $sPropValue ? $sPropValue : ''
                ]);

                if ($iPropId) {
                    return $iPropId;
                }
            }
        }

        return 0;
    }

    /**
     * Обновляет значение свойства заказа
     * @param int $iOrderId
     * @param string $sPropCode
     * @param string $sPropValue
     * @return int
     */
    public static function updateProp($iOrderId = 0, $sPropCode = '', $sPropValue = '')
    {
        if ($iOrderId && $sPropCode) {
            $arProp = OrderPropsValueTable::getList([
                'filter' => [
                    '=ORDER_ID' => $iOrderId,
                    '=CODE' => $sPropCode
                ]
            ])->Fetch();

            if ($arProp) {
                $iPropId = \CSaleOrderPropsValue::Update($arProp['ID'], [
                    'VALUE' => $sPropValue ? $sPropValue : ''
                ]);

                if ($iPropId) {
                    return $iPropId;
                }
            }
        }

        return 0;
    }

    /**
     * Набор свойств относящихся к заказу
     * @param int $iOrderId
     * @return array
     */
    public static function getOrderProps($iOrderId = 0)
    {
        if ($iOrderId) {
            $arProps = OrderPropsValueTable::getList([
                'filter' => [
                    '=ORDER_ID' => $iOrderId
                ],
            ])->fetchAll();

            if (!empty($arProps)) {
                return $arProps;
            }
        }

        return [];
    }
}