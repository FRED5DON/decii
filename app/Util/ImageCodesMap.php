<?php

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/4
 * Time: 下午5:06
 */
class ImageCodesMap
{

    public static function getMap()
    {
        return [
            'signin' => array(
                'session_key' => 'sign_in_code',
                'text' => '登录验证码'
            )
            ,
            'signup' => array(
                'session_key' => 'sign_up_code',
                'text' => '注册验证码'
            ),
            'reply' => array(
                'session_key' => 'reply_code',
                'text' => '登录验证码'
            )
        ];
    }
}

