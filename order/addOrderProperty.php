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

            if ($prop = CSaleOrderProps::GetList([], ['CODE' => $code])->Fetch()) {

                return CSaleOrderPropsValue::Add([
                    'NAME'           => $prop['NAME'],
                    'CODE'           => $prop['CODE'],
                    'ORDER_PROPS_ID' => $prop['ID'],
                    'ORDER_ID'       => $order,
                    'VALUE'          => $value
                ]);
            }
        }
    }

    return false;
}