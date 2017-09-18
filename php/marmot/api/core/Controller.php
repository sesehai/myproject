<?php
/**
 * 控制器基类
 */
namespace core;

class Controller{

    /**
     * Controller constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $methodName
     * @param $args
     * @throws Exception
     */
    public function __call($methodName, $args)
    {
        throw new Exception("Call to undefined method: $methodName()");
    }
}