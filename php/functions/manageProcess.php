<?php
date_default_timezone_set( 'PRC' );

/**
 * 根据进程名称，和运行了多长时间，管理进程
 * @param sting $precessName 进程名称
 * @param int $runTime 运行时间
 */
function manageProcessByTimeAndName($processName, $runTime = 5){
    $cmd = popen("ps -eo pid,start,command | grep '{$processName}' | grep -v grep  | awk '{print $1,$2}'", "r");
    $line = fread($cmd, 1024);
    $linesAry = explode("\n", $line);
    print_r($linesAry);
    $date = time();
    $mktime = mktime(date("H", $date), date("i", $date)-$runTime, date("s", $date), date("m", $date), date("d", $date), date("Y", $date));
    $time = date("H:i:s", $mktime);
    echo $time, "\n";
    foreach($linesAry as $key => $val){
        if( !empty($val) ){
            $lineAry = explode(" ", $val);
            if( isset($lineAry[0]) && !empty($lineAry[0]) && isset($lineAry[1]) && !empty($lineAry[1]) ){
                if( strpos($lineAry[1], ":") === false ){
                    echo "run time > {$runTime}m, pid:".$lineAry[0]."\n";
                }elseif( $time > $lineAry[1] ){
                    echo "run time > {$runTime}m, pid:".$lineAry[0]."\n";
                    $killCmd = popen("kill {$lineAry[0]}", "r");
                    pclose($killCmd);
                }else{
                    echo "run time < {$runTime}m, pid:".$lineAry[0]."\n";
                }
            }
        }
    }
    pclose($cmd);
}