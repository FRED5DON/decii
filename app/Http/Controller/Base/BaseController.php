<?php namespace Decii\App\Controllers;
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/15
 * Time: 上午12:15
 */

use Decii\App\Controllers\Controller;
use Decii\App\Core\Response;
use Decii\App\Model\ODataMsgModel;

class BaseController implements Controller{

    private $index;
    private  static $count;
    protected $needAuthorized;
    public function __construct()
    {

        session_start();
//        if(!$this->index){
//            $this->index=0;
//        }
        if(!self::$count){
            self::$count=0;
        }
        if($this->needAuthorized){
            $this->onReceiveRequest();
        }
//        echo __METHOD__.$this->index."<br/>";
    }

    public function index(){
//        $this->index+=1;
        self::$count+=1;
//        echo __METHOD__.$this->index."<br/>";
        echo __METHOD__.self::$count."<br/>";
    }

    //ip
    public function onReceiveRequest()
    {
        // TODO: Implement onReceiveRequest() method.
        if(!$this->onHooked()){

        }
        if(!$this->didAuthorized()){
            $resp=Response::outJson(
                ODataMsgModel::make('200','RECC',1),
            [],
            null);

//            $uri= 'http://'.$_ENV['REMOTE_ADDR'].':'.$_ENV['SERVER_PORT'].$_ENV['REQUEST_URI'];
            var_dump(json_encode(headers_list()));
            die(json_encode($_SERVER));
        }

    }

    public function onHooked()
    {
        // TODO: Implement onHooked() method.
        return false;
    }

    public function didAuthorized()
    {
        // TODO: Implement didAuthorized() method.
        return false;
    }

    public function didInvalidRequest()
    {
        // TODO: Implement didInvalidRequest() method.
    }

    public function didErrorRequest()
    {
        // TODO: Implement didErrorRequest() method.
    }

    public function didFailureRequest()
    {
        // TODO: Implement didFailureRequest() method.
    }

    public function onResponse()
    {
        // TODO: Implement onResponse() method.
    }
}