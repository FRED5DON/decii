<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/4
 * Time: 下午4:01
 */

namespace Decii\App\Core;

class Response extends HttpMessage
{


    public static function outJson($msg = null, $array = [], $params = null, $paramsKey = '')
    {
        return json_encode(self::outModel($msg, $array, $params, $paramsKey));
    }


    private static function outModel($msg = null, $data = [], $params = null, $paramsKey = null)
    {
        $out = array();
        if ($data) {
            $out['data'] = $data;
        }
        if ($params) {
            $out[$paramsKey ? $paramsKey : 'tmp'] = $params;
        }
        if ($msg) {
            $out['msg'] = self::outMsg($msg);
        }
        return $out;
    }

    private static function outMsg($msgModel = null)
    {
        return $msgModel ? $msgModel : array();
    }
}