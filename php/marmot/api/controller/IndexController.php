<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;

class IndexController extends Controller{

    public function defaultAction(){
        $arr = array('data:' => "Hello World!");
        Response::json($arr);
    }
}