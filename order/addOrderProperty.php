<?
/**
 * @param array $params
 * @return bool
 */
function addOrderProperty($params = [])
{
    if ($params && !empty($params['order']) && !empty($params['code'])) {

        $order = $params['order'];
        $code  = $params['code'];
        $value = !empty($params['value']) ? $params['value'] : '';

        if (CModule::IncludeModule('sale')) {

            if ($props = CSaleOrderProps::GetList([], ['CODE' => $code])->Fetch()) {

                return CSaleOrderPropsValue::Add([
                    'NAME'           => $props['NAME'],
                    'CODE'           => $props['CODE'],
                    'ORDER_PROPS_ID' => $props['ID'],
                    'ORDER_ID'       => $order,
                    'VALUE'          => $value
                ]);
            }
        }
    }

    return false;
}