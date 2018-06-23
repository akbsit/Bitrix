<?php

/**
 * Сниппет создает почтовый шаблон для события
 * @param string $sEventName
 * @param string $sSubject
 * @param string $sMessage
 * @param array $arParams
 * @return bool
 */
function addMailTemplate($sEventName = '', $sSubject = '', $sMessage = '', $arParams = [])
{
    if ($sEventName && $sSubject && $sMessage) {
        $sActive = !empty($arParams['active']) ? $arParams['active'] : 'Y';
        $arLID = !empty($arParams['lid']) && is_array($arParams['lid']) ? $arParams['lid'] : ['s1'];
        $sEmailFrom = !empty($arParams['mail-from']) ? $arParams['mail-from'] : '#EMAIL_FROM#';
        $sEmailTo = !empty($arParams['mail-to']) ? $arParams['mail-to'] : '#EMAIL_TO#';
        $sBodyType = !empty($arParams['body-type']) ? $arParams['body-type'] : 'text';

        $iTemplateId = (new \CEventMessage)->Add([
            'ACTIVE' => $sActive,
            'EVENT_NAME' => $sEventName,
            'LID' => $arLID,
            'EMAIL_FROM' => $sEmailFrom,
            'EMAIL_TO' => $sEmailTo,
            'SUBJECT' => $sSubject,
            'BODY_TYPE' => $sBodyType,
            'MESSAGE' => $sMessage
        ]);

        if ($iTemplateId) {
            return $iTemplateId;
        }
    }

    return 0;
}