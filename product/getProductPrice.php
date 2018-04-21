<?
/**
 * Сниппет получает цену на товар
 * @param array $arParams
 * @return array
 */
function getProductPrice($arParams = [])
{
    $arResult = [];

    if ($arParams && !empty($arParams['id'])) {

        $iProductId = $arParams['id'];

        if (\CModule::IncludeModule('catalog')) {

            if ($arPrice = \CPrice::GetList([], ['PRODUCT_ID' => $iProductId])->fetch()) {

                $arResult['CURRENCY'] = $arPrice['CURRENCY'];
                $arResult['PRICE'] = $arPrice['PRICE'];
            }

            if ($arDiscounts = \CCatalogDiscount::GetDiscountByProduct($iProductId)) {

                $arResult['PRICE_DISCOUNT'] = \CCatalogProduct::CountPriceWithDiscount($arPrice['PRICE'], $arPrice['CURRENCY'], $arDiscounts);
            }
        }
    }

    return $arResult;
}