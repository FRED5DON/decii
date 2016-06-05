<?php namespace Decii\App\Authorize;

use Decii\App\Core\Request;

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/4
 * Time: 下午5:13
 */
class VerifyCodeTiz
{


    public static $SESSION_KEY = 'session_key';


    public static $VERIFY_STATE_SUCCESS = 0;

    public static $VERIFY_STATE_FAILURE = 1;

    public static $VERIFY_STATE_LOSS = 2;


    public static function validate($channelName = '', $value)
    {
        $map = \ImageCodesMap::getMap();
        if (isset($map[$channelName])) {
            $sessionKey = $map[$channelName][self::$SESSION_KEY];
            if (strcasecmp(($rawValue = Request::SESSION_GET($sessionKey)), $value) == 0) {
                return self::$VERIFY_STATE_SUCCESS;
            }
            return self::$VERIFY_STATE_FAILURE;
        }
        return self::$VERIFY_STATE_LOSS;
    }

    public static function clearSession($channelName = '')
    {
        $map = \ImageCodesMap::getMap();
        if (isset($map[$channelName])) {
            $sessionKey = $map[$channelName][self::$SESSION_KEY];
            Request::SESSION_PUT($sessionKey,'');
        }
    }


    /**
     *
     * @param string $channelName  一般代表页面标识
     * @return int
     */
    public static function hasCode($channelName=''){
        $map = \ImageCodesMap::getMap();
        if (isset($map[$channelName])) {
            $sessionKey = $map[$channelName][self::$SESSION_KEY];
            if(Request::SESSION_GET($sessionKey)){
                return 1;
            }
        }
        return 0;
    }
}