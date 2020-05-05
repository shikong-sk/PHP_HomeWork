<?php

require_once './core/core.php';
require_once './config/db.config.php';

session_start();


if (!isset($_POST['pid']) && !isset($_POST['select']) && !isset($_POST['delete'])) {

    if(!isset($_SESSION['user']))
    {
        header('Location:login.php');

    }

    require_once './template/core/head.html';

    require_once './template/header.php';

    require_once './template/cart.html';

    require_once './template/footer.html';
}
else
{
    if (isset($_POST['pid']) && !isset($_POST['select']))
    {
        header('Content-Type:application/json; charset=utf-8');
        $json = Array();
        if (!isset($_SESSION['user']) && !isset($_SESSION['userID'])) {
            $json = Array('Error' => '请登录后再操作');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }
        $shop_table = 'shop';
        $cart_table = 'cart';
        $product_sql = "SELECT * FROM $dbname.$shop_table WHERE productID = " . '"' . $_POST['pid'] . '"';
        $res = $database->query($product_sql);
        if ($res->num_rows != 1) {
            $json = Array('Error' => '商品信息不正确 或 商品不存在');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        } else {
            $res = $res->fetch_assoc();
            $cart_sql = "INSERT INTO $dbname.$cart_table (`userID`,`productID`,`productNum`) values (" . '"' . $_SESSION['userID'] . '","' . $res['productID'] . '",' . $_POST['num'] . ')';
            if ($database->query($cart_sql) === FALSE) {
                $cart_sql = "UPDATE $dbname.$cart_table SET productNum = " . '"' . $_POST['num'] . '" WHERE userID = "' . $_SESSION['userID'] . '" AND productID = "' . $res['productID'] . '"';
                if ($database->query($cart_sql) === FALSE) {
                    $json = Array('Error' => '商品信息不正确 或 商品不存在');
                    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                    exit($json);
                }
            }
            $json = Array('Success' => '商品已添加至购物车');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }
    }

    if(!isset($_POST['pid']) && isset($_POST['select']))
    {
        header('Content-Type:application/json; charset=utf-8');
        $json = Array();
        $cart_list = Array();

        $cart_table = 'cart';
        $shop_table = 'shop';

        if (!isset($_SESSION['user']) && !isset($_SESSION['userID'])) {
            $json = Array('Error' => '请登录后再操作');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }

        $cart_select = "SELECT b.productName,a.productNum,b.Price,a.productID FROM $dbname.$cart_table a,$dbname.$shop_table b WHERE userID = ".'"'.$_SESSION['userID'].'" AND a.productID = b.productID';

        $res = $database->query($cart_select);

        while($r = $res->fetch_assoc())
        {
            array_push($cart_list,Array($r['productName'],$r['productNum'],$r['Price'],$r['productID']));
        }
        $json = json_encode($cart_list,JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(!isset($_POST['pid']) && isset($_POST['delete'])) {
        header('Content-Type:application/json; charset=utf-8');
        $json = Array();
        $cart_list = Array();

        $cart_table = 'cart';
        $shop_table = 'shop';

        if (!isset($_SESSION['user']) && !isset($_SESSION['userID'])) {
            $json = Array('Error' => '请登录后再操作');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }

        $cart_delete = "DELETE FROM $dbname.$cart_table WHERE `productID` = ".'"'.$_POST['delete'].'" AND `userID` = '.'"'.$_SESSION['userID'].'"';

        if($database->query($cart_delete) === FALSE)
        {
            $json = Array('Error'=>'操作失败,请稍后再试');
            $json = json_encode($json,JSON_UNESCAPED_UNICODE);
            exit($json);
        }

        $cart_select = "SELECT b.productName,a.productNum,b.Price,a.productID FROM $dbname.$cart_table a,$dbname.$shop_table b WHERE userID = ".'"'.$_SESSION['userID'].'" AND a.productID = b.productID';

        $res = $database->query($cart_select);

        while($r = $res->fetch_assoc())
        {
            array_push($cart_list,Array($r['productName'],$r['productNum'],$r['Price'],$r['productID']));
        }
        $json = json_encode($cart_list,JSON_UNESCAPED_UNICODE);
        exit($json);
    }
    die('Forbidden');
}


