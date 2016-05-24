<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/14
 * Time: 下午2:41
 */

namespace Decii\App;


class RouterHandler
{


    /**
     * @var 路由Map
     */
    public $routes = array();


    public static $verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS');

    public function __construct()
    {

    }

    public function createRoute($methods, $uri, $action)
    {
        return array('method'=>$methods, 'uri'=>$uri, 'action'=>$action);
    }


    protected function addRoute($methods, $uri, $action)
    {
        return $this->routes[$uri]=$this->createRoute($methods, $uri, $action);
    }

    public function get($uri, $action)
    {
        return $this->addRoute(array('GET', 'HEAD'), $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action)
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    public function patch($uri, $action)
    {
        return $this->addRoute('PATCH', $uri, $action);
    }

    public function delete($uri, $action)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function options($uri, $action)
    {
        return $this->addRoute('OPTIONS', $uri, $action);
    }

    public function any($uri, $action)
    {
        $verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE');
        return $this->addRoute($verbs, $uri, $action);
    }

    public function match($methods, $uri, $action)
    {
        return $this->addRoute(array_map('strtoupper', (array)$methods), $uri, $action);
    }
}




