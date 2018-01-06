<?php
/**
 * 默认控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Articles;

class ArticleController extends Controller{

    /**
     * 添加,更新
     */
    public function saveAction(){
        $user = $this->_checkToken();
        $id = Request::post('id');
        $title = Request::post('title');
        $description = Request::post('description');
        $content = Request::post('content');
        if(empty($title) || empty($content) || empty($description)){
            Response::json(array(), 2000, '请填写完整！');
        }
        $articlesObj = new Articles();
        if(!empty($id)){
            // 更新
            $article = $articlesObj->getObjByPrimaryKey($id);
        }else{
            // 新增
            $article['user_id'] = $user['id'];
            $article['user_name'] = $user['name'];
            $article['ctime'] = date('Y-m-d H:i:s');
        }
        $article['title'] = $title;
        $article['content'] = $content;
        $article['description'] = $description;
        $article['utime'] = date('Y-m-d H:i:s');

        if($articlesObj->saveObj($article)){
            Response::json(array(), 200, "保存成功！");
        }else{
            Response::json(array(), 300, "保存失败！");
        }
    }

    /**
     * 列表
     */
    public function listAction(){
        $user = $this->_checkToken();
        $page = Request::get('page');
        if(empty($page) || $page < 0){
            $page = 1;
        }
        $pagesize = Request::get('pagesize');
        if(empty($pagesize) || $pagesize < 0){
            $pagesize = 10;
        }
        
        $articlesObj = new Articles();
        $result = $articlesObj->list($page, $pagesize);
        Response::json($result, 200, "查询成功！");
    }

    /**
     * 获取
     */
    public function detailAction(){
        $id = Request::get('id');
        $articlesObj = new Articles();
        $article = $articlesObj->getObjByPrimaryKey($id);
        Response::json($article, 200, "查询成功！");
    }

    /**
     * 删除
     */
    public function delAction(){
        $id = Request::get('id');
        $articlesObj = new Articles();
        if($articlesObj->deleteObj($id)){
            Response::json(array(), 200, "删除成功！");
        }else{
            Response::json(array(), 300, "删除失败！");
        } 
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
        
        $articlesObj = new Articles();
        $result = $articlesObj->list($page, $pagesize);
        Response::json($result, 200, "查询成功！");
    }
}