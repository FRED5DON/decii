<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午8:08
 */
namespace Decii\App\Util;

class Strings
{

    public static function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }


    public static function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }

}