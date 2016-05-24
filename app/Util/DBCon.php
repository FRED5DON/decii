<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午9:31
 */

namespace Decii\App\Util;


class DBCon
{
    private static $config;

    /**
     * @return array
     */
    public static function getConfig()
    {
        if(isset(self::$config)){
            return self::$config;
        }
        self::$config=[
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'database' => env('DB_DATABASE', 'qdm122976243_db'),
            'username' => env('DB_USERNAME', 'fred'),
            'password' => env('DB_PASSWORD', '12345'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false

        ];
        return self::$config;
    }

    private static $conn;

    public function __construct()
    {
        self::getConfig();
    }




    public static function getCon()
    {
        $cfg=self::getConfig();
        if(!isset(self::$conn)){

            self::$conn = new \mysqli($cfg['host'], $cfg['username'], $cfg['password'],$cfg['database']);
            if (mysqli_connect_errno(self::$conn))
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }
        return  self::$conn;
    }

    public static function query($sql)
    {
       $result= self::getCon()->query($sql)->fetch_all(MYSQLI_ASSOC);
        if(isset($result)){
            return json_encode($result);
        }
        return [];
    }

    public static function insert($sql)
    {
        $re=self::getCon()->query($sql);
        return array(
            'affected_rows'=>$re->affected_rows,
            'id'=>$re->insert_id,
        );
    }

    public static function delete($sql)
    {
        $re=self::getCon()->query($sql);
        return array(
            'affected_rows'=>$re->affected_rows
        );
    }


    public static function update($sql)
    {
        $re=self::getCon()->query($sql);
        return array(
            'affected_rows'=>$re->affected_rows
        );
    }

}
