<?php
define('ROOT_PATH',dirname(dirname(__FILE__)));
require_once ROOT_PATH.'/common.php';

require_once 'OS/Guess.php';

$OS_Guess = new OS_Guess();

print_r($OS_Guess);
?>