<?php
/**
 * Appointment: Помощники
 * Description: Набор полезных методов
 * File: Helper.php
 * Version: 0.0.3
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Helper;

use \Bitrix\Main\IO\File;
use \Bitrix\Main\Application;

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
     * @param string $sSection Раздел
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

    /**
     * Получаем содержимое SVG файла
     * @param string $sName Название файла
     * @param string $sPath Путь до файла
     * @return string
     */
    public static function getSVGByName($sName, $sPath = '/local/svg/')
    {
        $sResult = '';

        try {
            $oFile = new File(Application::getDocumentRoot() . $sPath . $sName . '.svg');
            $sResult = $oFile->getContents();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $sResult;
    }

    /**
     * Отображаем SVG
     * @param string $sName Название файла
     * @param string $sPath Путь до файла
     */
    public static function printSVGByName($sName, $sPath = '/local/svg/')
    {
        echo static::getSVGByName($sName, $sPath);
    }
}