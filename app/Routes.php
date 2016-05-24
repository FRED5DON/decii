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