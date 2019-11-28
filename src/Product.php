<?php
/**
 * Appointment: Товар
 * Description: Набор полезных методов для работы с товарами
 * File: Product.php
 * Version: 0.0.3
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix;

use \Bitrix\Main\Loader;

Loader::includeModule('catalog');

/**
 * Class Product
 * @package Falbar\Bitrix
 */
class Product
{
    /**
     * Получает цену на товар
     * @param int $iProductID ID товара
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