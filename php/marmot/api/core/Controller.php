<?php
/**
 * 控制器基类
 */
namespace core;
use core\Request;
use core\Response;
use model\Users;

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

    protected function _checkToken(){
        $usersObj = new Users();
        $token = Request::header('ticket');
        $user = $usersObj->checkToken($token);
        if(!$user){
            Response::json(array(), 2003, '未登录或登录过期！');
        }else{
            return $user;
        }
    }
}