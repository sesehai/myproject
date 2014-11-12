<?php
define("ROOT_PATH", dirname(__FILE__));
header("Content-type: text/html; charset=utf-8");
require_once ROOT_PATH.'/markdown.php';
$text = file_get_contents(ROOT_PATH.'/readme.md');
$content = Markdown($text);

printHeader();
echo $content;
printFooter();

function printHeader(){
        $html_header = '<!DOCTYPE html>
<html>
<head>
<title>php start</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="Stylesheet" type="text/css" href="http://css.letvcdn.com/css/201209/19/style.css" />
<style>
body{
font-size:1.2em;
}
pre{
line-height:25px;
}
</style>
</head>
<body>
<div id="all">
<div id="cse"></div>
<div id="main">';
        echo $html_header;

    }

function printFooter(){
        $html_footer = '<div id="footer">
    <p>
    &copy; letv.com &nbsp;&nbsp;
    </p>
</div>
</div>
<script src="http://js.letvcdn.com/js/201211/28/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="http://js.letvcdn.com/js/201211/28/vimwiki.js" type="text/javascript"></script>
</body>
</html>';
        echo $html_footer;

    }