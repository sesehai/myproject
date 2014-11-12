<?php
require_once 'XML/RPC/Server.php';

/*
 * Declare the functions, etc.
 */
function returnTimes2($params) {
    $obj = new some_class_name;
    return $obj->returnTimes2($params);
}

class some_class_name {
    public function returnTimes2($params) {
        $param = $params->getParam(0);

        // This error checking syntax was added in Release 1.3.0
        if (!XML_RPC_Value::isValue($param)) {
            return $param;
        }

        $val = new XML_RPC_Value($param->scalarval() * 2, 'int'); 
        return new XML_RPC_Response($val);
    }

    public function returnJson($params){
        $name = $params->getParam(0);
        $age = $params->getParam(1);
        // This error checking syntax was added in Release 1.3.0
        if ( !XML_RPC_Value::isValue($name) || !XML_RPC_Value::isValue($age) ) {
            return $param;
        }

        $result = array(
            'data'=> array(
                'name' => $name,
                'age' => $age,
            ),
        );
        $val = new XML_RPC_Value(json_encode($result), 'string'); 
        return new XML_RPC_Response($val);
    }
}

$some_object = new some_class_name;


/*
 * Establish the dispatch map and XML_RPC server instance.
 */
$server = new XML_RPC_Server(
    array(
        'function_times2' => array(
            'function' => 'returnTimes2'
        ),
        'class_paamayim_nekudotayim_times2' => array(
            'function' => 'some_class_name::returnTimes2'
        ),
        'class_times2' => array(
            'function' => array('some_class_name', 'returnTimes2')
        ),
        'object_times2' => array(
            'function' => array($some_object, 'returnTimes2')
        ),
        'obj' => array(
            'function' => array($some_object, 'returnJson')
        ),
    ),
    1  // serviceNow
);
?>
