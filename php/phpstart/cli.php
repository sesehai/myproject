<?php
$total = isset($argv[1]) ? $argv[1]:100;

echo "starting ... \n";
for($i = 1;$i<=$total;$i++){
    echo "number:",$i,"\n";
    if( $i%10 == 0 ){
        echo "sleep 5 seconds ....\n";
        sleep(5);
    }
}

echo "Finish. \n";