<?php

require_once './core/core.php';
require_once './config/db.config.php';

session_start();

if(!isset($_SESSION['user']))
{
    header('Location:login.php');
}

require_once './template/core/head.html';

require_once './template/header.php';

include_once 'template/my.html';

require_once './template/footer.html';