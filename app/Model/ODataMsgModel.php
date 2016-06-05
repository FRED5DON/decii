<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/4
 * Time: 下午4:07
 */

namespace Decii\App\Model;

class ODataMsgModel
{

    public $code;//消息码

    public $msg;//消息文本

    public $type;//消息类型


    public function __construct($code, $msg, $type)
    {
        $this->code = $code;
        $this->msg = $msg;
        $this->type = $type;
    }


    public static function make($code, $msg, $type){
        return new ODataMsgModel($code, $msg, $type);
    }


    function __toString()
    {
        return json_encode($this);
    }

}