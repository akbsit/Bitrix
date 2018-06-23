<?php

/**
 * Сниппет получает индификатор инфоблока по его коду
 * @param string $sIBlockCode
 * @param string $sIBlockType
 * @return int
 */
function getIBlockId($sIBlockCode = '', $sIBlockType = '')
{
    if ($sIBlockCode && \Bitrix\Main\Loader::includeModule('iblock')) {
        $arFilter = [
            '=CODE' => $sIBlockCode
        ];

        if ($sIBlockType) {
            $arFilter['=TYPE'] = $sIBlockType;
        }

        $arIBlock = (new \CIBlock())->GetList([], $arFilter)->fetch();

        if (!empty($arIBlock['ID'])) {
            return $arIBlock['ID'];
        }
    }

    return 0;
}