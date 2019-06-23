<?php
/**
 * Appointment: Помощники
 * Description: Набор полезных методов
 * File: Helper.php
 * Version: 0.0.1
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Helper;

/**
 * Class Helper
 * @package Falbar\Bitrix\Helper
 */
class Helper
{
    /**
     * Проверяем главную страницу
     * @return bool
     */
    public static function isMainPage()
    {
        return \CSite::InDir(SITE_DIR . 'index.php');
    }

    /**
     * Проверяем нахождение в разделе
     * @param string $sSection
     * @return bool
     */
    public static function isSection($sSection = '')
    {
        $bResult = false;

        if ($sSection) {
            $bResult = \CSite::InDir(SITE_DIR . $sSection . '/index.php');
        }

        return $bResult;
    }
}