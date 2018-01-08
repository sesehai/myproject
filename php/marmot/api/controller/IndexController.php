<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Articles;

class IndexController extends Controller{

    public function defaultAction(){
        $arr = array('data:' => "Hello World!");
        Response::json($arr);
    }

    /**
     * 首页
     */
    public function indexAction(){
        $page = Request::get('page');
        if(empty($page) || $page < 0){
            $page = 1;
        }
        $pagesize = Request::get('pagesize');
        if(empty($pagesize) || $pagesize < 0){
            $pagesize = 10;
        }
        $tag = Request::get('tag');
        $date = Request::get('date');
        
        $articlesObj = new Articles();
        $result = array(
            'list' => $articlesObj->list($page, $pagesize, $tag, $date),
            'group' => $articlesObj->groupArticleByDate(),
        );
        Response::json($result, 200, "查询成功！");
    }
}