PHP 入门
-------

*   [php安装](#install)
    *   [PHP 主要用在三个领域](#fanwei)
*   [Hello World!](#hello)
    *   [例子](#example)
*   [代码格式](#syntax)
    *   [代码段](#block)
    *   [函数](#function)
    *   [类](#class)
*   [数据类型](#type)
*   [数组](#array)
*   [数据库](#db)


* * *
<h2 id="install">php安装</h2>

<h4 id="fanwei">PHP 主要用在三个领域</h4>
[php menu](http://www.php.net/manual/zh/)

* PHP 脚本主要用于以下三个领域：
    
        服务端脚本。这是 PHP 最传统，也是最主要的目标领域。开展这项工作需要具备以下三点：PHP 解析器（CGI 或者服务器模块）、web 服务器和 web 浏览器。需要在运行 web 服务器时，安装并配置 PHP，然后，可以用 web 浏览器来访问 PHP 程序的输出，即浏览服务端的 PHP 页面。如果只是实验 PHP 编程，所有的这些都可以运行在自己家里的电脑中。请查阅安装一章以获取更多信息。
        
        命令行脚本。可以编写一段 PHP 脚本，并且不需要任何服务器或者浏览器来运行它。通过这种方式，仅仅只需要 PHP 解析器来执行。这种用法对于依赖 cron（Unix 或者 Linux 环境）或者 Task Scheduler（Windows 环境）的日常运行的脚本来说是理想的选择。这些脚本也可以用来处理简单的文本。请参阅 PHP 的命令行模式以获取更多信息。
        
        编写桌面应用程序。对于有着图形界面的桌面应用程序来说，PHP 或许不是一种最好的语言，但是如果用户非常精通 PHP，并且希望在客户端应用程序中使用 PHP 的一些高级特性，可以利用 PHP-GTK 来编写这些程序。用这种方法，还可以编写跨平台的应用程序。PHP-GTK 是 PHP 的一个扩展，在通常发布的 PHP 包中并不包含它。如果对 PHP-GTK 感兴趣，请访问其» 网站以获取更多信息。
        
* 服务端脚本：

    -服务器启动：
        /usr/local/php-5.4.4/bin/php -S 0.0.0.0:8088 -t /root/luq/phpstart/
        
      [例子,接收外部变量](http://localhost/myproject/phpstart/web.php)
      
        <form action="web.php?act=show" method="POST">
            Name:  <input type="text" name="username"><br />
            Email: <input type="text" name="email"><br />
            <input type="submit" name="submit" value="Submit me!" />
        </form>
        
        <?php
        echo "act:".$_GET['act'],",<br>";
        echo "username:".$_POST['username'],",<br>";
        echo "email:".$_POST['email'],",<br>";
        ?>
      
* 命令行脚本:
        (例子，每执行10个任务暂定5秒):
        
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
            



<h2 id="hello">Hello World!</h2>

<h3 id="example">例子</h3>
代码如下：

    <?php
        //注释，打印出字符串
        #注释，打印出字符串
        /*
         * 注释，打印出字符串
         */
        echo 'Hello World!';

# 指令分隔符
  - PHP 需要在每个语句后用分号结束指令
# 代码注释

         //注释，打印出字符串
         #注释，打印出字符串
        /*
         * 注释，打印出字符串
         */



<h2 id="syntax">代码格式</h2>

<h3 id="function">代码段</h3>
    <?php
        echo 'Hello World!';

<h3 id="function">函数</h3>
    <?php
        function hello(){
            echo 'Hello World!';
        }
        hello();
        
<h3 id="type">类</h3>
    <?php
        class firstClass{
            public function hello(){
                echo 'Hello World!';
            }
        }
        $oFirst = new firstClass();
        
        
        
<h2 id="type">数据类型</h2>
* [php menu array](http://www.php.net/manual/zh/language.types.php)
    
                布尔类型
                整型
                浮点型
                字符串
                数组
                对象
                资源类型
                NULL

<h2 id="array">数组</h2>
* [php menu array](http://www.php.net/manual/zh/language.types.array.php)
* [例子:](http://localhost/myproject/phpstart/example.php)
    
                <?php
                
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

<h2 id="db">数据库</h2>
    

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
            $sql_query = "SELECT `name` FROM `mclient_user` WHERE `name` = 'luq' ";
        
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
        
            $dbconnect = mysqlCommon::opendb($host = '123.126.33.231',$user = 'mctadmin',$pwd = 'mtestletv',$db = 'mclient' ,$port='3306');
            $sql_query = "SELECT `name` FROM `mclient_user` WHERE `name` = 'luq' ";
        
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




