<?php
define("ROOT_PATH", dirname(__FILE__));

require_once 'base.php';
spl_autoload_register(array('Base','auto_load'));

$mobile = new Mobile();
echo $mobile->getName(),"<br>";


$android_phone = new Android_Phone();
echo $android_phone->getName(),"<br>";

$android_pad = new Android_Pad();
echo $android_pad->getName(),"<br>";
