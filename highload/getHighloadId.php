<?php

/**
 * Сниппет получает индификатор highload-блока по названию таблицы
 * @param string $sDBName
 * @param string $sName
 * @return int
 */
function getHighloadId($sDBName = '', $sName = '')
{
    if ($sDBName && \Bitrix\Main\Loader::includeModule('highloadblock')) {
        $arFilter = [
            '=TABLE_NAME' => $sDBName
        ];

        if ($sName) {
            $arFilter['=NAME'] = $sName;
        }

        $arHighload = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter' => $arFilter,
            'select' => ['ID']
        ])->fetch();

        if (!empty($arHighload['ID'])) {
            return $arHighload['ID'];
        }
    }

    return 0;
}