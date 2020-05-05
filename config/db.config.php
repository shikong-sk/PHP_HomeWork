<?php
    header('Content-Type:text/html;charset=utf-8');
    $user = 'root';
    $passwd = '';
    $dbip = '127.0.0.1';
    $dbport = '3306';
    $dbname = 'work_test';
    $tbname = '';
    $salt = 'shikong';
    $database = new mysqli();
    $database->connect($dbip.':'.$dbport,$user,$passwd);
    if($database->connect_error)
    {
        die('数据库连接失败,请检查数据库配置文件 ./config/sql.config.php 配置是否有误');
    }
    $database->query('set names utf8');

?>