<?php
/**
 * Appointment: Валидация
 * Description: Набор полезных методов для валидации
 * File: Validator.php
 * Version: 0.0.2
 * Author: Anton Kuleshov
 **/

namespace Falbar\Bitrix\Helper;

/**
 * Class Validator
 * @package Falbar\Bitrix\Helper
 */
class Validator
{
    /**
     * Очистка строковых данных
     * @param $string Строка или массив со строковыми данными
     * @param array $arExclude Массив исключений, если передан массив
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
     * Очистка числовых данных
     * @param $int Число или массив с числовыми данными
     * @param array $arExclude Массив исключений, если передан массив
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