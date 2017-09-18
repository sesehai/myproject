<?php
// 设置php错误报告级别
error_reporting(E_ALL);
// 设置输入是否输出
ini_set('display_errors', 'on');
// 设置默认时区
date_default_timezone_set('Asia/Shanghai');
// 设置全局常量，工作目录
define('ROOT_PATH', dirname(__FILE__));
// 使用composer 生成的自动加载文件，实现类的自动加载
require __DIR__. DIRECTORY_SEPARATOR . 'vendor' .DIRECTORY_SEPARATOR. 'autoload.php';
// 引入: 派发器
use core\Dispatcher;
// 引入: 请求处理器
use core\Request;
// 引入: 响应处理器
use core\Response;

// 引用第三方日志模块: monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// 初始化日志模块
$log = new Logger('marmot_api');
$log->pushHandler(new StreamHandler(__DIR__ . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'php.log', Logger::DEBUG));
Dispatcher::$log = $log;

// 初始化派发器
$app = Dispatcher::getInstance();
try {
    // 加载配置文件
    $app->config(ROOT_PATH . DIRECTORY_SEPARATOR .'config'.DIRECTORY_SEPARATOR.'config.php');
    // 启动应用
    $app->start();
} catch(Exception $e) {
    // 异常处理
    if(stripos(Request::header('Accept'), 'application/json')){
        Response::json(array(),500, $e->getMessage());
    }else{
        echo "<pre>";
        $error = "Exception:". PHP_EOL;
        $error .= "File:" . $e->getFile() . ",line:" .$e->getLine() . PHP_EOL;
        $error .= "Message:" .$e->getMessage() . PHP_EOL;
        echo $error;
        Dispatcher::$log->addError($error);
    }
}