<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/15
 * Time: 上午12:38
 */
namespace Decii\App\Core;

class Request extends HttpMessage
{

    public static function ENV()
    {
        if (isset($_SERVER)) {
            return $_SERVER;
        }
        return array();
    }

    public static function REQ()
    {
        if (isset($_REQUEST)) {
            return $_REQUEST;
        }
        return array();
    }


    public static function GETS()
    {
        if (isset($_GET)) {
            return $_GET;
        }
        return array();
    }

    public static function GET_VALUE($key = '')
    {
        return self:: GETS()[$key];
    }

    public static function POSTS()
    {
        if (isset($_POST)) {
            return $_POST;
        }
        return array();
    }

    public static function POST_VALUE($key = '')
    {
        return self:: POSTS()[$key];
    }

}