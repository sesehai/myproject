PHP 主要应用领域是网站开发。PHP运行在服务器上，用户通过浏览器访问页面，php处理请求，并返回给浏览器。
使用HTML开发的页面，可以给浏览者提供提前写好的静态内容。而使用php可以提供给浏览者动态的信息，并且可以接收用户提交的信息。

如果你的电脑上已经安装了php 版本>=5.4, php 提供了一个内置的Web服务器。

编写一个php的文件 demo.php
内容如下:
```php
<?php
    echo "I am happy!";
?>
```

在dome.php所在的目录下执行命令:

```php
php -S 127.0.0.1:80 -t ./
```

接下来在浏览器中输入:
```php
http://127.0.0.1/demo.php
```
会看到，上面编写的那句话 "I am happy!"。

接着我们增加一个小功能，接收用户提交的信息，并返回给用户。
编写代码：
```php
<?php
    $name = $_GET["name"];
    echo "I am happy! Welcome," . $name;
?>
```

接下来在浏览器中输入:
```php
http://127.0.0.1/demo.php?name=Lily
```
会看到，上面编写的那句话 "I am happy! Welcome,Lily"。

PHP可结合HTML输出内容，我们修改代码如下:
```php
<html>
    <body>
        <h3>Welcome to PHP world!</h3>
        <?php
            $name = $_GET["name"];
            echo "I am happy! Welcome," . $name;
        ?>
    </body>
</html> 
```
接下来在浏览器中输入:
```php
http://127.0.0.1/demo.php?name=Lily
```
有了不错的效果吧。
PHP就这么简单，创建了一个动态交互的页面。

