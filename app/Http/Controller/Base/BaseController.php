<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/15
 * Time: 上午12:15
 */
namespace Decii\App\Controllers;

class BaseController{

    private $index;
    private  static $count;
    public function __construct()
    {

//        if(!$this->index){
//            $this->index=0;
//        }
        if(!self::$count){
            self::$count=0;
        }
//        echo __METHOD__.$this->index."<br/>";
        echo __METHOD__.self::$count."<br/>";
    }

    public function index(){
//        $this->index+=1;
        self::$count+=1;
//        echo __METHOD__.$this->index."<br/>";
        echo __METHOD__.self::$count."<br/>";
    }

    //ip
}