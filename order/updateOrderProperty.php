<?php

/**
 * Сниппет динамически обновляет значение свойства заказа
 * @param int $iOrderId
 * @param string $sPropertyCode
 * @param string $sPropertyValue
 * @return int
 */
function updateOrderProperty($iOrderId = 0, $sPropertyCode = '', $sPropertyValue = '')
{
    if ($iOrderId && $sPropertyCode && \CModule::IncludeModule('sale')) {
        $arProp = \Bitrix\Sale\Internals\OrderPropsValueTable::getList([
            'filter' => [
                '=ORDER_ID' => $iOrderId,
                '=CODE' => $sPropertyCode
            ]
        ])->Fetch();

        if ($arProp) {
            $iPropId = \CSaleOrderPropsValue::Update($arProp['ID'], [
                'VALUE' => $sPropertyValue ? $sPropertyValue : ''
            ]);

            if ($iPropId) {
                return $iPropId;
            }
        }
    }

    return 0;
}