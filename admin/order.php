<?php
require_once '../core/core.php';
require_once '../config/db.config.php';

session_start();

if(!isset($_SESSION['user']))
{
    header('Location:../login.php');

}
else if($_SESSION['group'] != '管理员')
{
    header('Location:../index.php');
}



include_once './template/core/head.php';

include_once './template/orders.html';

include_once './template/core/foot.html';