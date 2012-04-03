<?php
define('ROOT_PATH',dirname(dirname(__FILE__)));
require_once ROOT_PATH.'/common.php';

require_once 'DB.php';
$DbManager = new DB();
$db = $DbManager->factory($type="mysqli", $options = false);


$dsn = array(
      'phptype'  => 'mysqli',
      'username' => 'mclient_readonly',
      'password' => '!HY%wn&#*nse',
      'hostspec' => '60.28.199.202',
      'database' => 'mclient',
      'key'      => '',
      'cert'     => '',
      'ca'       => '',
      'capath'   => '',
      'cipher'   => '',
);

$options = array(
      'ssl' => true,
);
$db->connect($dsn, $persistent = false);
$query="select * from mclient_vrsupdate limit 5";
$rows = $db->simpleQuery($query);
$rowsAry = array();
while($db->fetchInto($rows, &$rowsAry, $fetchmode='', $rownum = null)){
    print_r($rowsAry);
}
?>