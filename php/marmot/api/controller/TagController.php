<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Tags;

class TagController extends Controller{

    /**
     * 首页
     */
    public function indexAction(){
        
        $tagsObj = new Tags();
        $result = array(
            'list' => $tagsObj->list(),
        );
        Response::json($result, 200, "查询成功！");
    }
}