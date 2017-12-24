<?php
/**
 * 问题控制器
 */
namespace controller;
use core\Controller;
use core\Request;
use core\Response;
use model\Question;

class QuestionController extends Controller{

    public function listAction(){
        $question = new Question();
        $result = $question->loadList();
        Response::json(array('data' => $result));
    }

    public function saveAction(){
        $getData = Request::post('question', '{}');
        $data = array(
            'question' => $getData,
            'ctime' => date('Y-m-d H:m:i')
        );
        $questionModel = new Question();
        $question = $questionModel->insert($data);

        Response::json(array('data' => json_decode($question)));
    }
}