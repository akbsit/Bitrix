<?
/**
 * @param array $params
 * @return array
 */
function getProductPrice($params = [])
{
    $tmp = [];

    if ($params && !empty($params['product'])) {

        $product = $params['product'];

        if (CModule::IncludeModule('catalog')) {

            if ($price = CPrice::GetList([], ['PRODUCT_ID' => $product])->fetch()) {

                $tmp['CURRENCY'] = $price['CURRENCY'];
                $tmp['PRICE']    = $price['PRICE'];
            }

            if ($discounts = CCatalogDiscount::GetDiscountByProduct($product)) {

                $tmp['PRICE_DISCOUNT'] = CCatalogProduct::CountPriceWithDiscount($price['PRICE'], $price['CURRENCY'], $discounts);
            }
        }
    }

    return $tmp;
}