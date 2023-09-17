<?php namespace Akbsit\Bitrix\Helper;

/**
 * Class Validator
 * @package Akbsit\Bitrix\Helper
 */
class Validator
{
    /**
     * @param $string
     * @param array $arExclude
     * @return array|string
     */
    public static function clearString($string, $arExclude = [])
    {
        if (!is_array($string)) {
            return trim(htmlspecialchars($string));
        }

        foreach ($string as $i => $sVal) {
            if (!in_array($i, $arExclude) || is_array($sVal)) {
                $string[$i] = static::clearString($sVal, $arExclude);
            } else {
                $string[$i] = $sVal;
            }
        }

        return $string;
    }

    /**
     * @param $int
     * @param array $arExclude
     * @return array|int
     */
    public static function clearInt($int, $arExclude = [])
    {
        if (!is_array($int)) {
            return (int)$int;
        }

        foreach ($int as $i => $iVal) {
            if (!in_array($i, $arExclude) || is_array($iVal)) {
                $int[$i] = static::clearInt($iVal, $arExclude);
            } else {
                $int[$i] = $iVal;
            }
        }

        return $int;
    }
}
