<?
/**
 * @param array $params
 * @return bool
 */
function getOrderProperties($params = [])
{
    if ($params && !empty($params['order'])) {

        $order = $params['order'];

        if (CModule::IncludeModule('sale')) {

            $props = Bitrix\Sale\Internals\OrderPropsValueTable::getList([
                'filter' => [
                    'ORDER_ID' => $order
                ]
            ])->fetchAll();

            if (!empty($props)) {

                return $props;
            }
        }
    }

    return false;
}