<?php
/**
 * Appointment: Товар
 * Description: Набор полезных методов для работы с товарами
 * File: Product.php
 * Version: 0.0.1
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
     * @param int $iProductId
     * @return array
     */
    public static function getPrice($iProductId = 0)
    {
        $arResult = [];

        if ($iProductId) {
            if ($arPrice = \CPrice::getList([], ['=PRODUCT_ID' => $iProductId])->fetch()) {
                $arResult['CURRENCY'] = $arPrice['CURRENCY'];
                $arResult['PRICE'] = $arPrice['PRICE'];
            }

            if ($arDiscounts = \CCatalogDiscount::getDiscountByProduct($iProductId)) {
                $arResult['PRICE_DISCOUNT'] = \CCatalogProduct::countPriceWithDiscount($arPrice['PRICE'], $arPrice['CURRENCY'], $arDiscounts);
            }
        }

        return $arResult;
    }
}