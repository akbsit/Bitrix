<?
/**
 * Сниппет динамически обновляет значение свойства заказа
 * @param array $arParams
 * @return int
 */
function updateOrderProperty($arParams = [])
{
    if ($arParams && !empty($arParams['id']) && !empty($arParams['property']['code'])) {

        $iOrderId = $arParams['id'];
        $sPropertyCode = $arParams['property']['code'];
        $sPropertyValue = !empty($arParams['property']['value']) ? $arParams['property']['value'] : '';

        if (\CModule::IncludeModule('sale')) {

            $arProp = \Bitrix\Sale\Internals\OrderPropsValueTable::getList([
                'filter' => [
                    'ORDER_ID' => $iOrderId,
                    'CODE' => $sPropertyCode
                ]
            ])->Fetch();

            if ($arProp) {

                $iPropId = \CSaleOrderPropsValue::Update($arProp['ID'], [
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