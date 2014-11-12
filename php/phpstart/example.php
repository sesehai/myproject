<?php
header("Content-type: text/html; charset=utf-8");
class ArrayDemo{
    function getArray() {
        //产生一个array
        $aAry = array(
            'one',
            'tow',
            'three',
            '1',
            '2',
        );

        $bAry = explode(',', "1,2,a,w,c");

        foreach ($aAry as $key=>$val){
            echo "$key => $val, <br>\n";
        }

        echo "<br>\n";
        foreach ($bAry as $key=>$val){
            echo "$key => $val, <br>\n";
        }
    }

    function sortArray() {
        $aAry = array('b'=>'zhangsan','d'=>'lisi','a'=>'wangwu');

        sort($aAry);
        echo "<br>\n";
        foreach ($aAry as $key=>$val){
            echo "$key => $val, <br>\n";
        }
    }

    function pushArray() {
        $aAry = array('b'=>'zhangsan','d'=>'lisi','a'=>'wangwu');

        array_push($aAry, '小六');
        echo "<br>\n";
        print_r($aAry);
    }

    function popArray() {
        $aAry = array('b'=>'zhangsan','d'=>'lisi','a'=>'wangwu');

        $theEnd = array_pop($aAry);
        echo "<br>\n";
        echo "出栈数据：",$theEnd,"<Br>\n";

        echo "剩余数据：","<Br>\n";
        foreach ($aAry as $key=>$val){
            echo "$key => $val, <br>\n";
        }
    }


}

$oArrayDemo = new arrayDemo();

echo "---getArray 产生数组--- <br>\n";
$oArrayDemo->getArray();

echo "---sortArray 排序--- <br>\n";
$oArrayDemo->sortArray();

echo "---getArray 入栈--- <br>\n";
$oArrayDemo->pushArray();

echo "---popArray 出栈--- <br>\n";
$oArrayDemo->popArray();


