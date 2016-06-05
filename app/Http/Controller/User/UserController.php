<?php namespace Decii\App\Controllers\API;

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/2
 * Time: 下午7:33
 */

use Decii\App\Authorize\VerifyCodeTiz;
use \Decii\App\Controllers\BaseController as BaseController;
use Decii\App\Core\Request;
use Decii\App\Core\Response;
use Decii\App\Model\ODataMsgModel;
use Decii\App\Util\DBCon;

class UserController extends BaseController
{

    public function signin()
    {
        $param = Request::POSTS();
        $vrCode = VerifyCodeTiz::validate('signin', $param['vcode']);
        if ($vrCode == VerifyCodeTiz::$VERIFY_STATE_FAILURE) {
            die();
        }
        echo 'Fred';

    }


    public function singup()
    {
        $param = Request::POSTS();
        //{"usrname":"fred","email":"gsiner@live.com","usrpwd":"123456","usrpwd2":"123456","uvcode":"yBt2u"}
        $vrCode = VerifyCodeTiz::validate('signup', $param['uvcode']);
        if ($vrCode == VerifyCodeTiz::$VERIFY_STATE_FAILURE) {
            die(Response::outJson(ODataMsgModel::make(404, "验证码错误", 1)));
        }

        $userName = isset($param["usrname"]) ? $param["usrname"] : "";
        $email = isset($param["email"]) ? $param["email"] : "";
        $usrpwd = isset($param["usrpwd"]) ? $param["usrpwd"] : "";
        $usrpassword = isset($param["usrpassword"]) ? $param["usrpassword"] : "";
        $usrpwd2 = isset($param["usrpwd2"]) ? $param["usrpwd2"] : "";
        if (!\RegexMatcher::alpha_dash($userName, 4, 11)) {
            die(Response::outJson(ODataMsgModel::make(206, "用户名有误", 1)));
        }
        $maps = include_once __DIR__ . "./../../../Util/Lang.php";
        if (!\RegexMatcher::email($email)) {
            die(Response::outJson(ODataMsgModel::make(206, "邮箱格式有误", 1)));
        }
        if (!\RegexMatcher::alpha_underline($usrpwd, 6, 20)) {
            die(Response::outJson(ODataMsgModel::make(206, "密码有误", 1)));
        }
        $result = DBCon::query("select * from sys_user where (`usrname`='$userName')");
        if ($result == '[]') {
            $rows = DBCon::insert("INSERT INTO sys_user(`usrname`,`email`,`password`) VALUES('$userName','$email',md5('$usrpwd'))");
            echo json_encode($rows);
        } else {
            die(Response::outJson(ODataMsgModel::make(404, "用户名已存在", 1), $result));
        }
    }
}