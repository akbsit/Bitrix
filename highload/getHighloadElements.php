<?php

/**
 * Сниппит получает список элементов highload-блока
 * @param string $sDBName
 * @param array $arParams
 * @return array
 */
function getHighloadElements($sDBName = '', $arParams = [])
{
    $arResult = [];

    if ($sDBName && \Bitrix\Main\Loader::includeModule('highloadblock')) {
        $oHighload = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter' => [
                '=NAME' => $sDBName
            ]
        ]);

        if ($arHighload = $oHighload->fetch()) {
            $oEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighload);
            $sClassName = $oEntity->getDataClass();

            $arFilter = !empty($arParams['filter']) && is_array($arParams['filter']) ? $arParams['filter'] : [];
            $arOrder = !empty($arParams['order']) && strtoupper($arParams['order']) == 'DESC' ? ['ID' => 'DESC'] : ['ID' => 'ASC'];
            $iLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? $arParams['limit'] : 0;
            $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : ['*'];

            $oElement = $sClassName::getList([
                'filter' => $arFilter,
                'order' => $arOrder,
                'limit' => $iLimit,
                'select' => $arSelect
            ]);

            while ($arElement = $oElement->fetch()) {
                $arResult[] = $arElement;
            }
        }
    }

    return $arResult;
}