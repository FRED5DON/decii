<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午7:20
 */

namespace Decii\App;

class Route
{
    private static $router;

    public function __construct()
    {
        self::$router = new RouterHandler();
    }

    public static function getRouter()
    {
        if (!isset(self::$router)) {
            self::$router = new RouterHandler();
        }
        return self::$router;
    }

    public static function get($uri, $action)
    {
        return self::getRouter()->get($uri, $action);
    }

    public static function post($uri, $action)
    {
        return self::getRouter()->post($uri, $action);
    }

    public static function put($uri, $action)
    {
        return self::getRouter()->put($uri, $action);
    }

    public static function patch($uri, $action)
    {
        return self::getRouter()->patch($uri, $action);
    }

    public static function delete($uri, $action)
    {
        return self::getRouter()->delete($uri, $action);
    }

    public static function options($uri, $action)
    {
        return self::getRouter()->options($uri, $action);
    }


    public function redirect($path)
    {
        $mapRoute = self::getRouter()->routes[$path];
        if (isset($mapRoute)) {
            $action = $mapRoute['action'];
            if ($action instanceof \Closure) {
                call_user_func($action);
            }
            if (is_string($action)) {
                $class_methods = explode("@", $action);
                if (count($class_methods) != 2) {
                    return 'Path Not Defined!';
                }
                $class_name = $class_methods[0];
                $method_name = $class_methods[1];
                if (isset(self::$ctrlNS[$class_name])) {
//                    call_user_func_array(array(self::$ctrlNS[$class_name], $method_name), []);
//                    //利用反射调用对象方法
                    $reflectionMethod = new \ReflectionMethod(self::$ctrlNS[$class_name],$method_name);
                    $reflectionMethod->invoke(new self::$ctrlNS[$class_name](), 'fred');
                }

            }
        }

    }

    public static $ctrlNS = array(
        'BaseController' => \Decii\App\Controllers\BaseController::class,
        'ManaController' => \Decii\App\Controllers\API\ManaController::class,
        'ServoController' => \Decii\App\Controllers\API\ServoController::class,
        'ConfigController' => \Decii\App\Controllers\API\ConfigController::class,
        'UserController' => \Decii\App\Controllers\API\UserController::class,


    );
}