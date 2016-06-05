<?php

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/5
 * Time: 下午7:19
 */
class RegexMatcher
{


    /**
     * @param $str
     * @param $minLen
     * @param $maxLen
     * @return int
     */
    public static function num($str, $minLen, $maxLen)
    {
//        preg_match("^[a-zA-Z0-9]{4,16}$",$str)
        return preg_match(self::regex("[0-9]", $minLen, $maxLen), $str);
    }


    public static function alpha_dash($str, $minLen, $maxLen)
    {
        return preg_match(self::regex("[a-z0-9_]", $minLen, $maxLen), $str);
    }

    public static function abc_underline($str, $minLen, $maxLen)
    {
        return preg_match(self::regex("[a-z_]", $minLen, $maxLen), $str);
    }


    public static function abc_underline_igcase($str, $minLen, $maxLen)
    {
        return preg_match(self::regex("[a-zA-Z_]", $minLen, $maxLen), $str);
    }

    public static function alpha_underline($str, $minLen, $maxLen)
    {
        return preg_match(self::regex("[a-zA-Z0-9_]", $minLen, $maxLen), $str);
    }

    public static function email($str)
    {
        return preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $str);
    }

    public static function regex($rex, $minLen, $maxLen)
    {
        $min = $minLen > 0 ? $minLen : 0;
        $max = $maxLen >= $min ? $maxLen : '';
        return "/" . $rex . "{" . $min . "," . $max . "}/";
    }
}