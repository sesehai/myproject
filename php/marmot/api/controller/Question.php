<?php
/**
 * 问题控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model;

class Question extends Controller{

    public function listAction(){
        $category = Request::get('category', '');
        $question = new model\Question();
        $result = $question->loadList($category);
        Response::json(array('data' => $result));
    }
}