<?php

include_once './core/core.php';
session_start();
//$r = mt_rand(0,99);
//if($r<10) $r = '0'.strval($r);
//
//$t = udate('YmdHisu').time().mtime().$r;
////echo $t;
//
//var_dump($t);
//
//echo '<br>';
//
//var_dump($_SESSION);
//$dir = './images/product/3C9D5D55-4C65-2F2A-3CA8-B66D9431D851';
//$res = scandir($dir);
//$res = array_diff($res,Array('.','..'));
//foreach ( $res as $file )
//{
//    echo '<img src="'.$dir.'/'.$file.'"/><br>';
//}
error_reporting(-1);
$settings = file_get_contents('./config/db.config.php');

//show_source($settings);
//highlight_string($settings);

$dbconfig = fopen('./config/db.config.php','r+');
$dbconfigList = Array(
    'user'=>'/\$user.*?=.*?[\'"](.*?)[\'"].*?;/',
    'passwd'=>'/\$passwd.*?=.*?[\'"](.*?)[\'"].*?;/',
    'dbip'=>'/\$dbip.*?=.*?[\'"](.*?)[\'"].*?;/',
    'dbport'=>'/\$dbport.*?=.*?[\'"](.*?)[\'"].*?;/',
    'dbname'=>'/\$dbname.*?=.*?[\'"](.*?)[\'"].*?;/',
    'tbname'=>'/\$tbname.*?=.*?[\'"](.*?)[\'"].*?;/',
    'salt'=>'/\$salt.*?=.*?[\'"](.*?)[\'"].*?;/',
    );
$dbconfigData = Array();
while(!feof($dbconfig))
{
    $context = fgets($dbconfig);
    highlight_string($context);
    foreach ( $dbconfigList as $key => $rule)
    {
        if(preg_match($rule,$context,$res))
        {
            $dbconfigData[$key] = $res[1];
        }
    }
}
fclose($dbconfig);
echo '<br>数据库配置文件读取<br>';
foreach ($dbconfigData as $key => $value)
{
    echo $key.'：&nbsp;'.$value.'<br>';
}