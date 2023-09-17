<?php namespace Akbsit\Bitrix;

use \Bitrix\Main\Loader;

Loader::includeModule('catalog');

/**
 * Class Product
 * @package Akbsit\Bitrix
 */
class Product
{
    /**
     * @param int $iProductID
     * @return array
     */
    public static function getPrice($iProductID = 0)
    {
        $arResult = [];

        if ($iProductID) {
            if ($arPrice = \CPrice::getList([], ['=PRODUCT_ID' => $iProductID])->fetch()) {
                $arResult['CURRENCY'] = $arPrice['CURRENCY'];
                $arResult['PRICE'] = $arPrice['PRICE'];
            }

            if ($arDiscounts = \CCatalogDiscount::getDiscountByProduct($iProductID)) {
                $arResult['PRICE_DISCOUNT'] = \CCatalogProduct::countPriceWithDiscount($arPrice['PRICE'], $arPrice['CURRENCY'], $arDiscounts);
            }
        }

        return $arResult;
    }
}
