<?php
/**
 * Appointment: Почта
 * Description: Набор полезных методов для работы с почтой
 * File: Mail.php
 * Version: 0.0.4
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix;

/**
 * Class Mail
 * @package Falbar\Bitrix
 */
class Mail
{
    /**
     * Создает почтовое событие
     * @param string $sEventName ID почтового события
     * @param string $sName Заголовок почтового события
     * @param string $sDescription Описание задающее поля почтового события
     * @param string $sLang Язык (необязательный)
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
     * Создает почтовый шаблон для события
     * @param string $sEventName ID почтового события
     * @param string $sSubject Заголовок сообщения
     * @param string $sMessage Тело почтового сообщения
     * @param array $arParams Массив с заданными параметрами (необязательный)
     * [
     *     'active' => 'Y', Флаг активности почтового шаблона
     *     'lid' => ['s1'], IDs сайтов
     *     'mail-from' => '#EMAIL_FROM#', Почта от кого
     *     'mail-to' => '#EMAIL_TO#' Почта кому,
     *     'body-type' => 'text' Тип тела почтового сообщения
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