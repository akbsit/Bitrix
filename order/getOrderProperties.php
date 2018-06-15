<?php

/**
 * Сниппет получает набор свойств относящихся к заказу
 * @param int $iOrderId
 * @return array
 */
function getOrderProperties($iOrderId = 0)
{
    if ($iOrderId && \CModule::IncludeModule('sale')) {
        $arProps = \Bitrix\Sale\Internals\OrderPropsValueTable::getList([
            'filter' => [
                'ORDER_ID' => $iOrderId
            ],
        ])->fetchAll();

        if (!empty($arProps)) {
            return $arProps;
        }
    }

    return [];
}