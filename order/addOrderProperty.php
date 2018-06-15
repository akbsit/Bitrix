<?php

/**
 * Сниппет динамически добавляет свойство к заказу
 * @param int $iOrderId
 * @param string $sPropertyCode
 * @param string $sPropertyValue
 * @return int
 */
function addOrderProperty($iOrderId = 0, $sPropertyCode = '', $sPropertyValue = '')
{
    if ($iOrderId && $sPropertyCode && \CModule::IncludeModule('sale')) {
        if ($arProp = \CSaleOrderProps::GetList([], ['CODE' => $sPropertyCode])->Fetch()) {
            $iPropId = \CSaleOrderPropsValue::Add([
                'NAME' => $arProp['NAME'],
                'CODE' => $arProp['CODE'],
                'ORDER_PROPS_ID' => $arProp['ID'],
                'ORDER_ID' => $iOrderId,
                'VALUE' => $sPropertyValue ? $sPropertyValue : ''
            ]);

            if ($iPropId) {
                return $iPropId;
            }
        }
    }

    return 0;
}