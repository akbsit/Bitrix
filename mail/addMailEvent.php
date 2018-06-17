<?php

/**
 * Сниппет создает почтовое событие
 * @param string $sEventName
 * @param string $sName
 * @param string $sDescription
 * @param string $sLang
 * @return int
 */
function addMailEvent($sEventName = '', $sName = '', $sDescription = '', $sLang = 'ru')
{
    if ($sEventName && $sName && $sDescription) {
        $iEventId = (new \CEventType)->Add(array(
            'EVENT_NAME' => $sEventName,
            'NAME' => $sName,
            'LID' => $sLang,
            'DESCRIPTION' => $sDescription
        ));

        if (!empty($iEventId)) {
            return $iEventId;
        }
    }

    return 0;
}