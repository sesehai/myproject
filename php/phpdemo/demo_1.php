<?php
require_once "home_zhangsan_demo.php";
require_once "home_lisi_demo.php";
use \home\zhangsan\Demo as ZSDemo;
use \home\lisi\Demo as LSDemo;
 
$zhangsan = new ZSDemo();
$lisi = new LSDemo();
 
echo $zhangsan->getName() . PHP_EOL;
echo $lisi->getName() . PHP_EOL;
?>
