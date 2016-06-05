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

class ConfigController extends BaseController{

    public function lang(){
        $lang=Request::POST_VALUE('lang');
        if($lang){
            Request::COOKIE_PUT('lang',$lang);
            //FIXME 保存用户配置
            echo json_encode(array('result'=>$lang));
        }
        echo json_encode(array('result'=>'ERR'));
    }


    public function verifyImage(){
        echo self::getCode('sign_up_code',5,120,32);
    }

    public static function getCode($code_key="code_key",$num=5, $w=80, $h=36)
    {
        $code = "";
        $map='abcdefghjkmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY0123456789';

        $len=strlen($map);
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
        $vcodeColor = imagecolorallocate($im, 13,153,157);
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
}