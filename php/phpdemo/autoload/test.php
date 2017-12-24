<?php
spl_autoload_register(function($class){
$file = str_replace("\\", "/", $class);
    $file = $file . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});

$bar = new foo\bar\Test();
$bar->hello();

?>
