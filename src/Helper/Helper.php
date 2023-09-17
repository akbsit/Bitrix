<?php namespace Akbsit\Bitrix\Helper;

use \Bitrix\Main\IO\File;
use \Bitrix\Main\Application;

/**
 * Class Helper
 * @package Akbsit\Bitrix\Helper
 */
class Helper
{
    /**
     * @return bool
     */
    public static function isMainPage()
    {
        return \CSite::InDir(SITE_DIR . 'index.php');
    }

    /**
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

    /**
     * @param string $sName
     * @param string $sPath
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
     * @param string $sName
     * @param string $sPath
     */
    public static function printSVGByName($sName, $sPath = '/local/svg/')
    {
        echo static::getSVGByName($sName, $sPath);
    }
}
