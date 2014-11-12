<?php
require_once 'XML/RPC.php';

$input = "lisi";
$params = array(
    new XML_RPC_Value($input, 'string'),
    new XML_RPC_Value("30", 'int'),
);
$msg = new XML_RPC_Message('obj', $params);

$cli = new XML_RPC_Client('/rpc/xmlrpc.php', '33.33.33.10');
// $cli->setDebug(1);
$resp = $cli->send($msg);

if (!$resp) {
    echo 'Communication error: ' . $cli->errstr;
    exit;
}

if (!$resp->faultCode()) {
    $val = $resp->value();
    echo $val->scalarval();
} else {
    /*
     * Display problems that have been gracefully cought and
     * reported by the xmlrpc.php script.
     */
    echo 'Fault Code: ' . $resp->faultCode() . "\n";
    echo 'Fault Reason: ' . $resp->faultString() . "\n";
}
?>
