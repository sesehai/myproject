<?php
/**
 * 响应处理类
 */
namespace core;

class Response{

    static protected $codeMsg = array(
        '2000' => '登录失败',
        '2001' => '11',
        '2002' => '注册失败, 用户已存在',
        '200' => '成功',
    );

    public function __construct()
    {
    }

    public static function redirect($url, $code = 302)
    {
        header("Location:$url", true, $code);
        exit();
    }

    public static function json($data, $code = 200, $msg = ''){
        header('Content-type: application/json;charset=utf-8');
        $result = array(
            'code' => $code,
            'msg' => !empty($msg) ? $msg : (isset(self::$codeMsg[$code]) ? self::$codeMsg[$code] : ''),
            'entity' => $data
        );
        echo json_encode($result);
        exit();
    }
}