<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/15
 * Time: 上午12:20
 */
use Decii\App\Route as Route;


Route::get('/base','BaseController@index');


Route::get('/base2','ManaController@index');


Route::get('/lang','ConfigController@lang');

//注册
Route::post('/user/signup','UserController@signup');
//登录
Route::post('/user/signin','UserController@signin');
//验证码
Route::get('/user/vcode/signup','ConfigController@verifyImageSignup');
Route::get('/user/vcode/signin','ConfigController@verifyImageSignin');


Route::post('/article/make','ManaController@make');
//use \NoahBuscher\Macaw\Macaw as Route;
//
//
//Route::get('/base','BaseController@index');
//
//
//Route::get('/base2','ManaController@index');
//
//
//
//
//
//
//
//
//
//Route::dispatch();