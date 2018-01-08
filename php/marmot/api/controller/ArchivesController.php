<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Articles;

class ArchivesController extends Controller{

    /**
     * 首页
     */
    public function indexAction(){
        
        $articlesObj = new Articles();
        $result = array(
            'list' => $articlesObj->groupArticleListByDate(),
        );
        Response::json($result, 200, "查询成功！");
    }
}