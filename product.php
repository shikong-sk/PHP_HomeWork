<?php

require_once './core/core.php';
require_once './config/db.config.php';

session_start();

if(!isset($_REQUEST['pid']))
{
    die('Forbidden');
}

$shop_table = 'shop';
$product_sql = "select * from $dbname.$shop_table WHERE productID = (".'"' . $_REQUEST['pid'] . '"'.')';
$res = $database->query($product_sql);

require_once './template/core/head.html';

require_once './template/header.php';

if($res->num_rows > 0) {
    $r = $res->fetch_assoc();
    include_once 'template/product.php';
}
else
{
    echo '<div class="container-fluid" style="height: 300px">
        <h1 class="text-center">404 NotFound</h1>
        <h1 class="text-center">没有找到该商品</h1>
</div>';
}
require_once './template/footer.html';