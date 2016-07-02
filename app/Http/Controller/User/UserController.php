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
        $vrCode = VerifyCodeTiz::validate('signin', $param['uvcode']);
        if ($vrCode == VerifyCodeTiz::$VERIFY_STATE_FAILURE) {
            die(Response::outJson(ODataMsgModel::make(404, "验证码错误", 1)));
        }
        //usrname=fred&usrpassword=e10adc3949ba59abbe56e057f20f883e&uvcode=3ffoa
        $userName = isset($param["usrname"]) ? $param["usrname"] : "";
        $usrpassword = isset($param["usrpassword"]) ? $param["usrpassword"] : "";
        if (!(\RegexMatcher::alpha_underline($userName, 4, 11) || \RegexMatcher::email($userName))) {
            die(Response::outJson(ODataMsgModel::make(206, "用户名有误", 1)));
        }
        $result = DBCon::query("select * from sys_user where (`usrname`='$userName' and `password`='$usrpassword')");
        if (!$result) {
            $this->onRecord(-1,"登录","尝试使用".$userName."进行登录");
            die(Response::outJson(ODataMsgModel::make(206, "用户名或密码错误", 1)));
        } else {
            //生成token放head
            $this->token = ConfigController::mkToken($userName, $usrpassword);
            $user = $result[0];
            $sql="update sys_user set _token = '$this->token',_tokenExpireTime=DATE_ADD(curdate(), INTERVAL 7 DAY)  where (`id`='" . $user['id'] . "')";
            $updateToken = DBCon::update($sql);
            if ($updateToken['affected_rows'] >= 0) {
                $this->onRecord($user['id'],"登录");
                Request::SESSION_PUT('token',$this->token);
                echo(Response::outJson(ODataMsgModel::make(200, "登录成功", 1), $this->token, array('url' => 'index.php')));

            } else {
                echo(Response::outJson(ODataMsgModel::make(209, "登录出错了，请重新登录", 1), ""));
                $this->onRecord($user['id'],"登录","尝试使用".$userName."进行登录");
            }


        }

    }


    public function signup()
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
        if (!$result) {
            $rows = DBCon::insert("INSERT INTO sys_user(`usrname`,`email`,`password`) VALUES('$userName','$email',md5('$usrpwd'))");
            if($rows['id']){
                DBCon::insert("insert into user (`id`) VALUES('".$rows['id']."')");
            }
            $this->onRecord($rows['id'],"注册");
            die(Response::outJson(ODataMsgModel::make(200, "注册成功", 1)));
        } else {
            die(Response::outJson(ODataMsgModel::make(404, "用户名已存在", 1), $result));
        }
    }
}