<?php

/**
 * Сниппит получает список элементов инфоблока
 * @param int $iIBlockId
 * @param array $arParams
 * @return array
 */
function getIBlockElements($iIBlockId = 0, $arParams = [])
{
    $arResult = [];

    if ($iIBlockId && \Bitrix\Main\Loader::includeModule('iblock')) {
        $arOrder = !empty($arParams['order']) && strtoupper($arParams['order']) == 'DESC' ? ['ID' => 'DESC'] : ['ID' => 'ASC'];
        $arLimit = !empty($arParams['limit']) && is_numeric($arParams['limit']) ? ['nTopCount' => $arParams['limit']] : [];
        $arSelect = !empty($arParams['select']) && is_array($arParams['select']) ? $arParams['select'] : [];

        $oElement = (new \CIBlockElement())->getList($arOrder, [
            '=IBLOCK_ID' => $iIBlockId
        ], false, $arLimit, $arSelect);

        while ($arElement = $oElement->fetch()) {
            $arResult[] = $arElement;
        }
    }

    return $arResult;
}