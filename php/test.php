<?php
function check($devid, $percent)
{
    $tmp = hexdec(substr(md5($devid), -4));
    echo $tmp . PHP_EOL;
    echo 3 % 100, PHP_EOL;
    if ($tmp % 100 <= $percent) {
        return '1';
    }
    return '0';
}


echo check("13651181081", 10) , PHP_EOL;
?>