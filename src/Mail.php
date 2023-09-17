<?php namespace Akbsit\Bitrix;

/**
 * Class Mail
 * @package Akbsit\Bitrix
 */
class Mail
{
    /**
     * @param string $sEventName
     * @param string $sName
     * @param string $sDescription
     * @param string $sLang
     * @return int
     */
    public static function addEvent($sEventName = '', $sName = '', $sDescription = '', $sLang = 'ru')
    {
        $iResult = 0;

        if ($sEventName && $sName && $sDescription) {
            $iEventID = \CEventType::add([
                'EVENT_NAME' => $sEventName,
                'NAME' => $sName,
                'LID' => $sLang,
                'DESCRIPTION' => $sDescription
            ]);

            if (!empty($iEventID)) {
                $iResult = $iEventID;
            }
        }

        return $iResult;
    }

    /**
     * @param string $sEventName
     * @param string $sSubject
     * @param string $sMessage
     * @param array $arParams
     * [
     *     'active' => 'Y',
     *     'lid' => ['s1'],
     *     'mail-from' => '#EMAIL_FROM#',
     *     'mail-to' => '#EMAIL_TO#',
     *     'body-type' => 'text'
     * ]
     * @return bool
     */
    public static function addTemplate($sEventName = '', $sSubject = '', $sMessage = '', $arParams = [])
    {
        $iResult = 0;

        if ($sEventName && $sSubject && $sMessage) {
            $sActive = !empty($arParams['active']) ? $arParams['active'] : 'Y';
            $arLID = !empty($arParams['lid']) && is_array($arParams['lid']) ? $arParams['lid'] : ['s1'];
            $sEmailFrom = !empty($arParams['mail-from']) ? $arParams['mail-from'] : '#EMAIL_FROM#';
            $sEmailTo = !empty($arParams['mail-to']) ? $arParams['mail-to'] : '#EMAIL_TO#';
            $sBodyType = !empty($arParams['body-type']) ? $arParams['body-type'] : 'text';

            $oCEventMessage = new \CEventMessage;

            $iTemplateID = $oCEventMessage->add([
                'ACTIVE' => $sActive,
                'EVENT_NAME' => $sEventName,
                'LID' => $arLID,
                'EMAIL_FROM' => $sEmailFrom,
                'EMAIL_TO' => $sEmailTo,
                'SUBJECT' => $sSubject,
                'BODY_TYPE' => $sBodyType,
                'MESSAGE' => $sMessage
            ]);

            if ($iTemplateID) {
                $iResult = $iTemplateID;
            }
        }

        return $iResult;
    }
}
