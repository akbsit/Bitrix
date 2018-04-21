<?
/**
 * Сниппет получает набор свойств относящихся к заказу
 * @param array $arParams
 * @return array
 */
function getOrderProperties($arParams = [])
{
    if ($arParams && !empty($arParams['id'])) {

        $iOrderId = (int)$arParams['id'];

        if (\CModule::IncludeModule('sale')) {

            $arProps = \Bitrix\Sale\Internals\OrderPropsValueTable::getList([
                'filter' => [
                    'ORDER_ID' => $iOrderId
                ],
            ])->fetchAll();

            if (!empty($arProps)) {

                return $arProps;
            }
        }
    }

    return [];
}