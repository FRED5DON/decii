<?php namespace Decii\App\Controllers\API;

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午3:36
 */

use \Decii\App\Controllers\BaseController as BaseController;
use Decii\App\Core\Request;
use Decii\App\Util\DBCon;

class ManaController extends BaseController
{

    public function __construct()
    {

    }

    public function index()
    {
//        echo __METHOD__;
        self::update();
    }


    private function update()
    {
        $code=null;
//        echo json_encode(Request::ENV());
//        echo json_encode(Request::GETS());
//        echo json_encode(Request::REQ());
        $sqlStr = "select * from code";
        $re = DBCon::query($sqlStr);
//        $re = Capsule::table('code')->insert([
//            array('code' => '100',  'msg' => 'hello@world.com')
//
//        ]);
        echo $re;
    }

}