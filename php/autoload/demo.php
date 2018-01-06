<?php
define("ROOT_PATH", dirname(__FILE__));

require_once 'base.php';
spl_autoload_register(array('Base','auto_load'));

$mobile = new Mobile();
echo $mobile->getName(),"\n";


$android_phone = new Android_Phone();
echo $android_phone->getName(),"\n";

$android_pad = new Android_Pad();
echo $android_pad->getName(),"\n";

echo "\n";
echo $argv[1];
var_dump($argv);
