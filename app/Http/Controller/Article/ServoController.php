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
use Qiniu\Auth;

class ServoController extends BaseController
{

    private static $accessKey = 'muE_RhLH3ky03zw5M0M_B1E1-ZQDGvinh4zOIf9y';
    private static $secretKey = '9mU4NXwKGKrR55StDXQXpTOROSgi16PetfYS2FA3';
    private static $bucket = 'decii';//http://developer.qiniu.com/docs/v6/api/overview/concepts.html#bucket
    private static $uptoken = "muE_RhLH3ky03zw5M0M_B1E1-ZQDGvinh4zOIf9y:T0llVbEhDQlGFOHv0_sUhvUFLPs=:eyJzY29wZSI6ImRlY2lpIiwiZGVhZGxpbmUiOjE0NjYzNTUzMjR9";

    private $qiniu_token;
    public function __construct()
    {
        $auth = new Auth(self::$accessKey, self::$secretKey);
        // 生成上传Token
        $this->qiniu_token = $auth->uploadToken(self::$bucket);
    }

    public function getUploadToken()
    {
        echo json_encode(['uptoken'=>$this->qiniu_token]);
    }

    public function getDownloadToken()
    {
        echo json_encode(['downtoken'=>$this->qiniu_token]);
    }

}