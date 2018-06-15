<?php

/**
 * Сниппет получает цену на товар
 * @param int $iProductId
 * @return array
 */
function getProductPrice($iProductId = 0)
{
    $arResult = [];

    if ($iProductId && \CModule::IncludeModule('catalog')) {
        if ($arPrice = \CPrice::GetList([], ['PRODUCT_ID' => $iProductId])->fetch()) {
            $arResult['CURRENCY'] = $arPrice['CURRENCY'];
            $arResult['PRICE'] = $arPrice['PRICE'];
        }

        if ($arDiscounts = \CCatalogDiscount::GetDiscountByProduct($iProductId)) {
            $arResult['PRICE_DISCOUNT'] = \CCatalogProduct::CountPriceWithDiscount($arPrice['PRICE'], $arPrice['CURRENCY'], $arDiscounts);
        }
    }

    return $arResult;
}