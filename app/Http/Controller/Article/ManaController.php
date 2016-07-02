<?php namespace Decii\App\Controllers\API;

/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午3:36
 */

use \Decii\App\Controllers\BaseController as BaseController;
use Decii\App\Core\Request;
use Decii\App\Core\Response;
use Decii\App\Model\ODataMsgModel;
use Decii\App\Util\DBCon;

class ManaController extends BaseController
{

    public function __construct()
    {

    }

//    //单例方法,用于访问实例的公共的静态方法
//    public static function getInstance(){
//        if(!(self::$_instance instanceof self)){
//            self::$_instance = new self;
//        }
//        return self::$_instance;
//    }
    public function test()
    {
        echo ([]==null);
    }

    public function make()
    {
        $param = Request::POSTS();
//      echo "SUC!!";
        //{"category":"","title":"bioti","remark":"das","content":"### \u6807\u9898","keyword":"dsf"}
        $token = Request::COOKIE_GET('token');
        $udpics = isset($param["udpics"]) ? $param["udpics"] : "";
        $category = isset($param["category"]) ? $param["category"] : "";
        $categoryValue = isset($param["categoryValue"]) ? $param["categoryValue"] : "";
        $title = isset($param["title"]) ? $param["title"]: "";
        $content = isset($param["content"]) ? $param["content"] : "";
        $remark = isset($param["remark"]) ? $param["remark"] : "";
        $keyword = isset($param["keyword"]) ? $param["keyword"] : "";
        $user = $this->getUser($token);
        header("Content-type: text/html; charset=utf-8");
        if ($user) {
            $uid = $user['id'];
            $username = $user['usrname'];
            if ($udpics) {
                $imgs = explode(",", $udpics);
                foreach ($imgs as $img) {
                    if (strpos($content, $img) !== false) {
                        DBCon::insert("INSERT INTO user_res(`uid`,`type`,`value`)VALUES(" . $uid . ",1,'$img')");
                    }
                }
            }

            $sql = "insert into note (`title`,`content`,`uid`,`usrName`,`category`,`categoryvalue`,`desc`)".
                "VALUES('$title','$content','$uid','$username','$category' ,'$categoryValue','$remark')";
            $rows = DBCon::insert($sql);
            if (isset($rows['id']) and $rows['id'] > 0) {
                DBCon::insert("insert into indexer(`bundle_id`,`bundle_table`,`text`)VALUES(" . $rows['id'] . ",'note','$keyword')");
                die(Response::outJson(ODataMsgModel::make(201, "发布成功", 1), "", array('url' => 'uc.php')));
            } else {
                die(Response::outJson(ODataMsgModel::make(204, "发布失败 ", 1), "", array('url' => 'uc.php')));
            }
        } else {
//            session_destroy();
            die(Response::outJson(ODataMsgModel::make(206, "登录信息失效，请重新登录", 1), ""));
        }
    }


    public function getNotes()
    {
        $param = Request::GETS();
//      echo "SUC!!";
        //{"category":"","title":"bioti","remark":"das","content":"### \u6807\u9898","keyword":"dsf"}
        $token = Request::COOKIE_GET('token');
        $pageCount = 10;
        $page = isset($param["page"]) ? $param["page"] : 0;
        $cid = isset($param["id"]) ? $param["id"] : 0;
        $user = $this->getUser($token);
        $countArr = $this->countRecords("note");
        if ($user) {
            $total=0;
            if (isset($countArr['total'])) {
                $total=$countArr['total'];
//            $uid = $user['id'];
//            $username = $user['usrname'];
                if($cid!=0){
                    $rows = $this->searchNotesSql($page, $pageCount,'id='.$cid);
                }else{
                    $rows = $this->searchNotesSql($page, $pageCount,'');
                }
            }else{
                $rows=[];
            }
            die(Response::outJson(ODataMsgModel::make(200, "", 1), $rows,
                ['index'=>$page,'count'=>$total,'pages'=>floor($total/$pageCount),'pageCount'=>$pageCount],'page'));
        } else {
            die(Response::outJson(ODataMsgModel::make(206, "登录信息失效，请重新登录", 1), ""));
        }
    }


    private function searchNotesSql($page = 0, $limit = 10, $where = '')
    {
        if ($where) {
            $whereStr = "where ( $where )";
        } else {
            $whereStr = ' where `state`=0';
        }
        $sql = "select * from note " . $whereStr . " LIMIT $page,$limit";
        return DBCon::query($sql);
    }


    public function index()
    {
//        echo __METHOD__;
        self::update();
    }


    private function update()
    {
        $code = null;
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