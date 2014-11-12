<?php
define("ROOT_PATH", dirname(dirname(dirname(__FILE__))));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

$phpcli_colors = new Phpcli_Colors();
echo $phpcli_colors->getColoredString("Testing Colors class, this is purple string on yellow background.", "purple", "yellow") . "\n";
echo $phpcli_colors->getColoredString("Testing Colors class, this is blue string on light gray background.", "blue", "light_gray") . "\n";
echo $phpcli_colors->getColoredString("Testing Colors class, this is red string on black background.", "red", "black") . "\n";
echo $phpcli_colors->getColoredString("Testing Colors class, this is cyan string on green background.", "cyan", "green") . "\n";
echo $phpcli_colors->getColoredString("Testing Colors class, this is cyan string on default background.", "cyan") . "\n";
echo $phpcli_colors->getColoredString("Testing Colors class, this is default string on cyan background.", null, "cyan") . "\n";
