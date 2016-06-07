<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/29
 * Time: 下午5:12
 */

namespace Decii\App\Controllers\API;

use Decii\App\Controllers\BaseController;
use Decii\App\Core\Request;

class ConfigController extends BaseController
{

    public function lang()
    {
        $lang = Request::POST_VALUE('lang');
        if ($lang) {
            Request::COOKIE_PUT('lang', $lang);
            //FIXME 保存用户配置
            echo json_encode(array('result' => $lang));
        }
        echo json_encode(array('result' => 'ERR'));
    }


    public function verifyImageSignin()
    {
        echo self::getCode('sign_in_code', 5, 120, 32);
    }

    public function verifyImageSignup()
    {
        echo self::getCode('sign_up_code', 5, 120, 32);
    }

    public static function getCode($code_key = "code_key", $num = 5, $w = 80, $h = 36)
    {
        $code = "";
        $map = 'abcdefghjkmnpqrstuvwxyABCDEFGHIJKLMNPQRSTUVWXY23456789';

        $len = strlen($map);
        for ($i = 0; $i < $num; $i++) {
            $code .= $map{rand(0, $len)};
        }
        //4位验证码也可以用rand(1000,9999)直接生成
        //将生成的验证码写入session，备验证时用
        session_start();
        $_SESSION[$code_key] = $code;
        //创建图片，定义颜色值
        header("Content-type:image/PNG");
        $im = imagecreate($w, $h);
        $black = imagecolorallocate($im, 0, 0, 0);
        $vcodeColor = imagecolorallocate($im, 13, 153, 157);
        $gray = imagecolorallocate($im, 200, 200, 200);
        $bgcolor = imagecolorallocate($im, 255, 255, 255);
        //填充背景
        imagefill($im, 0, 0, $bgcolor);

        //画边框
//        imagerectangle($im, 0, 0, $w - 1, $h - 1, $black);

        //随机绘制两条虚线，起干扰作用
        $style = array($black, $black, $black, $black, $black,
            $gray, $gray, $gray, $gray, $gray
        );
        imagesetstyle($im, $style);
        $y1 = rand(0, $h);
        $y2 = rand(0, $h);
        $y3 = rand(0, $h);
        $y4 = rand(0, $h);
        imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
        imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);

        //在画布上随机生成大量黑点，起干扰作用;
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
        }
        //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
        $strx = rand(3, 8);
        for ($i = 0; $i < $num; $i++) {
            $strpos = rand(1, 6);
            imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $vcodeColor);
            $strx += rand(18, 20);
        }
        imagepng($im);//输出图片
        imagedestroy($im);//释放图片所占内存
    }


    public static function mkToken($username, $password)
    {
        if ($username && $password) {
            $string = $username . "" . substr($password, 6, 12);
            $key = "decii";//密钥
//           return self::encrypt($string,$key);//目前php encrypt.模块未开
            return md5($string);
        }
        return null;
    }

    public static function encrypt($string, $key = 'decii')
    {
        if (!$string) return null;
        //自带的加密函数
        $crypttext = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        $encrypted = trim(self::safe_b64encode($crypttext));//对特殊字符进行处理
        return $encrypted;
    }


    public static function decrypt($token, $key = 'decii')
    {
        if (!$token) return null;
        $crypttexttb = self::safe_b64decode($token);//对特殊字符解析
        $decryptedtb = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($crypttexttb), MCRYPT_MODE_CBC, md5(md5($key))), "\0");//解密函数
        return $decryptedtb;
    }


    //处理特殊字符

    public static function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    //解析特殊字符
    public static function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}