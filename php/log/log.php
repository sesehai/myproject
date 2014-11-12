<?php
define('ROOT_PATH',dirname(dirname(__FILE__)));
require_once ROOT_PATH.'/common.php';

require_once 'Log.php';
$log = Log::factory($handler="console", $name = '', $ident = '',$conf = array(), $level = PEAR_LOG_DEBUG);
//$log = Log::factory($handler="composite", $name = '', $ident = '',$conf = array(), $level = PEAR_LOG_DEBUG);

$log->log($message="test log \n name ...", $priority = null)
?>