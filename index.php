<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache");
setlocale(LC_ALL, 'zh_CN.utf-8');
date_default_timezone_set('Asia/Chongqing');
require 'loader.php';
// 加载library文件夹
Loader::includeLibrary();
require 'kint/Kint.class.php';
try
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    spl_autoload_register(array('Loader', 'autoLoad'));
    $route = Loader::extractUri();
    $class = new ReflectionClass($route['controller']);
    $instance = $class->newInstance();
    $class->getMethod($route['method'])->invoke($instance);
}
catch (Exception $e)
{
    dd($e);
    echo "出错了！";
}
