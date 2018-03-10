<?
/**
 * @param array $params
 * @return bool
 */
function updateOrderProperty($params = [])
{
    if ($params && !empty($params['order']) && !empty($params['code'])) {

        $order = $params['order'];
        $code  = $params['code'];
        $value = !empty($params['value']) ? $params['value'] : '';

        if (CModule::IncludeModule('sale')) {

            $prop = Bitrix\Sale\Internals\OrderPropsValueTable::getList([
                'filter' => [
                    'ORDER_ID' => $order,
                    'CODE'     => $code
                ]
            ])->Fetch();

            if ($prop) {

                return CSaleOrderPropsValue::Update($prop['ID'], [
                    'VALUE' => $value
                ]);
            }
        }
    }

    return false;
}