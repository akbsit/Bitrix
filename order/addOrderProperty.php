<?php

/**
 * Сниппет динамически добавляет свойство к заказу
 * @param array $arParams
 * @return int
 */
function addOrderProperty($arParams = [])
{
    if ($arParams && !empty($arParams['id']) && !empty($arParams['property']['code'])) {
        $iOrderId = $arParams['id'];
        $sPropertyCode = $arParams['property']['code'];
        $sPropertyValue = !empty($arParams['property']['value']) ? $arParams['property']['value'] : '';

        if (\CModule::IncludeModule('sale')) {
            if ($arProp = \CSaleOrderProps::GetList([], ['CODE' => $sPropertyCode])->Fetch()) {
                $iPropId = \CSaleOrderPropsValue::Add([
                    'NAME' => $arProp['NAME'],
                    'CODE' => $arProp['CODE'],
                    'ORDER_PROPS_ID' => $arProp['ID'],
                    'ORDER_ID' => $iOrderId,
                    'VALUE' => $sPropertyValue
                ]);

                if ($iPropId) {
                    return $iPropId;
                }
            }
        }
    }

    return 0;
}