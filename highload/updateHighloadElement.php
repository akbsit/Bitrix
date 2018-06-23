<?php

/**
 * Сниппет обновляет значения полей highload-блока
 * @param string $sDBName
 * @param int $iElementId
 * @param array $arParams
 * @return bool
 */
function updateHighloadElement($sDBName = '', $iElementId = 0, $arParams = [])
{
    if ($sDBName && $iElementId && $arParams && \Bitrix\Main\Loader::includeModule('highloadblock')) {
        $oHighload = \Bitrix\Highloadblock\HighloadBlockTable::getList([
            'filter' => [
                '=NAME' => $sDBName
            ]
        ]);

        if ($arHighload = $oHighload->fetch()) {
            $oEntity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighload);
            $sClassName = $oEntity->getDataClass();

            $oElement = $sClassName::update($iElementId, $arParams);

            if ($oElement->isSuccess()) {
                return true;
            }
        }
    }

    return false;
}