<?php

/**
 * Сниппет получает индификатор свойства по его символьному коду
 * @param string $sPropCode
 * @param int $iIBlockId
 * @return int
 */
function getIBlockPropertyId($sPropCode = '', $iIBlockId = 0)
{
    if ($sPropCode && $iIBlockId && \Bitrix\Main\Loader::includeModule('iblock')) {
        $arProp = \CIBlockProperty::GetList([], [
            'CODE' => $sPropCode,
            'IBLOCK_ID' => $iIBlockId
        ])->Fetch();

        if (!empty($arProp['ID'])) {
            return $arProp['ID'];
        }
    }

    return 0;
}