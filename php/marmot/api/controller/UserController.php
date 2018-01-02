<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Users;

class UserController extends Controller{

    public function signinAction(){
        $name = Request::post('name');
        $password = Request::post('password');
        if(empty($name) || empty($password)){
            Response::json(array(), 2000, '登录失败');
        }

        $usersObj = new Users();
        $record = $usersObj->loadUserByName($name);
        if(!empty($record) && $record['password'] == $password){
            Response::json(array('ticket' => $usersObj->createToken($record)), 200, "登录成功");
        }else{
            Response::json(array(), 2000, "登录失败");
        }

    }

    public function signupAction(){
        $name = Request::post('name');
        $password = Request::post('password');
        $email = Request::post('email');
        $user = array(
            'name' => $name,
            'password' => $password,
            'email' => $email
        );

        $usersObj = new Users();
        if(empty($name) || empty($password) || empty($email)){
            Response::json(array(), 2002, "请填写完整！");
        }
        $record = $usersObj->loadUserByName($name);
        if(!empty($record)){
            Response::json(array(), 2001, "该用户名已被注册");
        }

        if($usersObj->addObj($user)){
            Response::json(array(), 200, "注册成功");
        }else{
            Response::json(array(), 2001, "注册失败");
        }
    }
}