<?php
require_once '../core/core.php';

session_start();

if(isset($_SESSION['user']))
{
    if(isset($_POST['user']))
    {
        $table = 'user';
        $json = Array();
        $user_sql = "SELECT username,money,Fname,Lname,email,address,payPassword FROM $dbname.$table WHERE username =".'"'.$_SESSION['user'].'"';
        $res = $database->query($user_sql);
        $res = $res->fetch_assoc();
        foreach ( array_slice($res,0,6) as $data )
        {
            array_push($json,$data);
        }

        if($res["payPassword"] === "------")
        {
            $json['setPayPassword'] ='1';
        }
        $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        header('Content-Type:application/json; charset=utf-8');
        exit($json);
    }

    if(isset($_POST['changeUser']))
    {
        header('Content-Type:application/json; charset=utf-8');
        $table = 'user';
        $json = Array();
        if(!isset($_POST['pwd']) || !isset($_POST['Npwd']))
        {
            $user_mod = "UPDATE $dbname.$table SET email = ".'"'.$_POST['email'].'" , '. "Fname = ".'"'.$_POST['Fname'].'" , '. "Lname = ".'"'.$_POST['Lname'].'" '. 'WHERE username = "'.$_SESSION['user'].'"';
        }
        else
        {
            $user_search = "SELECT username from $dbname.$table WHERE username = ".'"'.$_SESSION['user'].'" AND '."password = ".'"'.sha1($_POST['pwd'].$salt).'"';
            if($database->query($user_search)->fetch_assoc() === null){
                $json = Array('Error' => '密码错误');
                $json = json_encode($json,JSON_UNESCAPED_UNICODE);
                exit($json);
            }
            $user_mod = "UPDATE $dbname.$table SET password = ".'"'.sha1($_POST['Npwd'].$salt).'" , '. "email = ".'"'.$_POST['email'].'" , '. "Fname = ".'"'.$_POST['Fname'].'" , '. "Lname = ".'"'.$_POST['Lname'].'" '. 'WHERE username = "'.$_SESSION['user'].'"';
        }
        $database->query('use'.$dbname);
        $res = $database->query($user_mod);
        if($res === FALSE)
        {
            $json = Array('Error' => '用户信息修改失败，请检查信息是否正确');
            $json = json_encode($json,JSON_UNESCAPED_UNICODE);
            exit($json);
        }
        else
        {
            $json = Array('Success' => '个人信息修改成功');
            $json = json_encode($json,JSON_UNESCAPED_UNICODE);
            exit($json);
        }
    }

    if (isset($_POST['address'])) {

        header('Content-Type:application/json; charset=utf-8');
        $json = Array();

        $user_table = 'user';

        $address_mod = "UPDATE $dbname.$user_table SET address = " . '"' . $_POST['address']. '" ' . 'WHERE username = "' . $_SESSION['user'] . '"';

        $database->query('use' . $dbname);
        $res = $database->query($address_mod);
        if ($res === FALSE) {
            $json = Array('Error' => '地址信息修改失败，请稍后再试');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        } else {
            $json = Array('Success' => '地址信息修改成功');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }
    }

    if(isset($_POST['myOrderList']))
    {

        header('Content-Type:application/json; charset=utf-8');
        $json = Array();

        $user_table = 'user';
        $order_table = 'order';
        $cart_table = 'cart';
        $shop_table = 'shop';

        $select_orderList_sql = "SELECT a.ID,c.productName,c.productID,a.address,a.statu,a.payment FROM $dbname.$order_table a,$dbname.$user_table b,$dbname.$shop_table c where a.userID = b.ID AND a.productID = c.productID AND b.username = '".$_SESSION['user']."' AND a.statu <> '已取消' ORDER BY a.ID DESC";

        $orderListTop = $database->query($select_orderList_sql);

        $resNum = 0;

        while ($orderListTop->data_seek($resNum)){
            array_push($json,$orderListTop->fetch_row());
            $resNum ++;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}
else
{
    die('Forbidden');
}