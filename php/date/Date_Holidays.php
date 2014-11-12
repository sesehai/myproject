<?php
define('ROOT_PATH',dirname(dirname(__FILE__)));
require_once ROOT_PATH.'/common.php';
require_once 'Date/Calc.php';

$calc = new Date_Calc();

echo $calc->dateFormat($day='03', $month="04", $year="2012", $format="%Y%t%A%t%B");
?>