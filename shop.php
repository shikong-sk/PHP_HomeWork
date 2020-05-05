<?php

require_once './core/core.php';
require_once './config/db.config.php';

session_start();

require_once './template/core/head.html';

require_once './template/header.php';


if(isset($_GET['search']))
{
    $search = $_GET['search'];
}
else
{
    $search = '';
}

include_once 'template/shop.html';

require_once './template/footer.html';