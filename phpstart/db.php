<?php
class mysqlCommon{
    public static function opendb($host = 'localhost',$user = 'root',$pwd = '123456',$db = 'test',$port='3306'){
        $connection = mysql_connect($host.":".$port,$user,$pwd) or die('can not connect to mysql:'.mysql_error());
        mysql_select_db($db) or die('can not select this database');
        mysql_query("SET NAMES 'UTF8'");
        mysql_query("SET CHARACTER SET UTF8");
        mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
        return $connection;
    }

    public static function closedb(){
        mysql_close($connection);
    }
}

class pdoCommon{
    public static function closedb($connection){
        $connection = null;
    }

    public static function openpdo($host = 'localhost',$user = 'root',$pwd = '123456',$db = 'test',$port='3306'){
        $dsn = "mysql:dbname=$db;host=$host;port=$port";
        try {
            $dbh = new PDO($dsn, $user, $pwd, array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $dbh;
        } catch (PDOException $e) {
            echo 'Connection failed: '. $e->getMessage();
        }
    }

}


function getUser(){
    //打开数据库连接

    $oPdo_vrs = pdoCommon::openpdo($host = 'localhost',$user = 'root',$pwd = '123456',$db = 'test' ,$port='3306');
    $sql_query = "SELECT `name` FROM `user` WHERE `name` = 'demo' ";

    try{
        $sth = $oPdo_vrs->prepare($sql_query);
        $sth->execute();
        $result = $sth->fetchAll();
        if( $result ){
            echo $sql_query,"---exist \n";
            foreach($result as $row){
                echo "name:",$row['name'],"\n";
            }
        }else{
            echo $sql_query,"\n";
        }
    }catch(Exception $e){
        $e->getMessage();
        echo '<br>';
        echo $e->getTraceAsString();
        exit;
    }


    pdoCommon::closedb($oPdo_vrs);
}


function getUserMysql(){
    //打开数据库连接

    $dbconnect = mysqlCommon::opendb($host = 'localhost',$user = 'root',$pwd = '123456',$db = 'test' ,$port='3306');
    $sql_query = "SELECT `name` FROM `user` WHERE `name` = 'demo' ";

    try{
        $result = mysql_query($sql_query,$dbconnect);
        if( $result ){
            echo $sql_query,"---exist \n";
            while($row = mysql_fetch_array($result)){
                echo "name:",$row['name'],"\n";
            }
        }else{
            echo $sql_query,"\n";
        }
    }catch(Exception $e){
        $e->getMessage();
        echo '<br>';
        echo $e->getTraceAsString();
        exit;
    }


    mysqlCommon::closedb($dbconnect);
}

//getUser();
getUserMysql();

