<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/6/4
 * Time: 下午3:41
 */

namespace Decii\App\Controllers;


interface Controller
{

    /**
     * 接受到请求
     * @return mixed
     */
    public function onReceiveRequest();


    /**
     * 在响应之前
     * @return mixed
     */
    public function onHooked();


    /***
     * 通过验证
     * @return mixed
     */
    public function didAuthorized();


    /**
     * 不可用或者过期的请求
     * @return mixed
     */
    public function didInvalidRequest();


    /**
     * 错误的请求
     * @return mixed
     */
    public function didErrorRequest();


    /**
     * 失败的请求
     * @return mixed
     */
    public function didFailureRequest();


    /**
     * 开始响应
     * @return mixed
     */
    public function onResponse();
}