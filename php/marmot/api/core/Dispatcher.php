<?php
/**
 * 派发器
 */
namespace core;
use controller;

class Dispatcher{
    public static $config = array(
        'defaultController' => 'IndexController',
        'defaultAction' => 'defaultAction',
        'controllerPath' => '',
        'modelPath' => '',
    );
    public static $params = array();
    private static $_instance = null;
    public static $log = null;

    /**
     * Dispatcher constructor.
     */
    private function __construct()
    {

    }

    /**
     * @param $config
     */
    public function config($config)
    {
        if (!empty($config)) {
            require_once $config;
        }
        self::$config = array_merge(self::$config, $config);
    }

    /**
     * Singleton instance
     *
     * @return Dispatcher
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * 启动派发器
     * @throws Exception
     */
    public function start()
    {
        $pathInfo = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'],'/') : '';
        $dispatchInfo = array();
        $tmp = explode('/', $pathInfo);
        $dispatchInfo['controller'] = 'controller\\'.(($controller = current($tmp)) ? ucfirst($controller) . "Controller" : self::$config['defaultController']);
        $dispatchInfo['action'] = ($action = next($tmp)) ? $action . 'Action' : self::$config['defaultAction'];

        $params = array();
        while (false !== ($next = next($tmp))) {
            $params[$next] = urldecode(next($tmp));
        }
        Dispatcher::$params = $params;

        extract($dispatchInfo);
        if (isset($controller)) {
            if(!class_exists($controller)){
                throw new Exception("Can't find controller:{$controller}");
            }
            $ctl = new $controller();
        }

        if (isset($action)) {
            $func = isset($ctl) ? array($ctl, $action) : $action;
            if (!is_callable($func, true)) {
                throw new Exception("Can't dispatch action:{$action}");
            }
            call_user_func($func);
        }
    }
}