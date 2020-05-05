<?php
require_once './core.php';
require_once '../config/db.config.php';

session_start();

$user_table = 'user';
$order_table = 'order';
$cart_table = 'cart';
$shop_table = 'shop';

if (isset($_POST['LoginSub'])) {

    $user = $_POST['user'];
    $password = $_POST['password'];

    $password = sha1($password . $salt);

    $login_sql = "SELECT username,ID,`group` from $dbname.$user_table WHERE username = " . '"' . $user . '" AND ' . "password = " . '"' . $password . '"';

    $database->query('use ' . $dbname);

    $res = $database->query($login_sql)->fetch_assoc();
    header('Content-Type:application/json; charset=utf-8');
    if ($res === null) {
        session_unset();
        $json = Array('错误' => '用户名或密码错误');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    } else {
        $_SESSION['token'] = sha1(base64_encode(guid() . $salt) . $salt);
        $_SESSION['user'] = $res['username'];
        $_SESSION['userID'] = $res['ID'];
        $_SESSION['group'] = $res['group'];

        setcookie('token', $_SESSION['token'], time() + $global_lifeTime);
        $json = Array('用户名' => $_SESSION['user'], 'token' => $_SESSION['token']);
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}

if (isset($_POST['SESSION'])) {
    header('Content-Type:application/json; charset=utf-8');
    if ($_POST['SESSION'] != '' && isset($_COOKIE['token'])) {
        session_id($_POST['SESSION']);
        if (isset($_SESSION['token']) && ($_SESSION['token'] === $_COOKIE['token'])) {
            if (isset($_SESSION['user'])) {
                $_SESSION['token'] = sha1(base64_encode(guid() . $salt) . $salt);
                setcookie('token', $_SESSION['token'], time() + $global_lifeTime);
                header('Content-Type:application/json; charset=utf-8');
                $json = Array('用户名' => $_SESSION['user']);
                $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                exit($json);
            }
        } else {
            session_id(sha1(base64_encode(guid() . time() . $salt) . mtime() . $salt));
        }
    }
}

if (isset($_POST['LoginOut'])) {
    header('Content-Type:application/json; charset=utf-8');
    setcookie('token', '', time() - 1);
    session_unset();
    session_destroy();
    $json = Array('' => '已退出登录');
    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
    exit($json);
}

// 获取唯一 Token
if (isset($_POST['getAuthToken'])) {
    $_SESSION['authToken'] = md5(base64_encode(sha1(guid())));
    exit($_SESSION['authToken']);
}

if (isset($_POST['RegisterSub'])) {
    header('Content-Type:application/json; charset=utf-8');
    if (strtolower($_POST['authCode']) === strtolower($_SESSION['authCode'])) {
        if (strlen($_POST['username']) < 5) {
            $json = Array('error' => '用户名长度必须大于5个字符');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }

        $user = $_POST['username'];
        $password = sha1($_POST['password'] . $salt);

        $user_Group = '普通用户';
        $user_ID = trim(guid(), '{}');

        $reg_sql = "INSERT INTO $dbname.$user_table (`ID`,`username`,`password`,`group`) values (" . '"' . $user_ID . '","' . $user . '","' . $password . '","' . $user_Group . '")';

        $database->query('use ' . $dbname);

        if ($database->query($reg_sql) === FALSE) {
            $json = Array('error' => '账号 ' . $user . ' 已被注册');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        } else {
            $json = Array('success' => '账号 ' . $user . ' 注册成功');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }
    } else {
        $json = Array('error' => '验证码错误');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}

if (isset($_POST['checkout'])) {
    $json = Array();
    header('Content-Type:application/json; charset=utf-8');
    $validatePayPassword_sql = "SELECT payPassword FROM $dbname.$user_table WHERE username = " . '"' . $_SESSION['user'] . '" AND ID = "' . $_SESSION['userID'] . '" AND payPassword = "' . $_POST['validatePayPassword'] . '"';

    if ($database->query($validatePayPassword_sql)->num_rows == 0) {
        $json = Array('error' => "支付密码错误\n如果您是第一次购买请到个人中心 => 账号 & 安全\n设置支付密码后才能使用交易功能");
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    } else {

        switch ($_POST['payment']) {
            case 'pay':
                $payment = '余额支付';
                break;
            case 'cash':
                $payment = '货到付款';
                break;
            default:
                {
                    $json = Array('error' => '请选择正确的支付方式');
                    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                    exit($json);
                }
        }

        $select_address_sql = "SELECT address FROM $dbname.$user_table WHERE username = " . '"' . $_SESSION['user'] . '" AND ID = "' . $_SESSION['userID'] . '" AND payPassword = "' . $_POST['validatePayPassword'] . '"';

        $addressRes = $database->query($select_address_sql)->fetch_assoc();
        $address = $addressRes['address'];
        if ( $address === null ||  $address === '') {
            $json = Array('error' => "收件地址尚未设置\n如果您是第一次购买请到个人中心 => 收件信息\n设置收件后才能继续使用交易功能");
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }


        $select_orderMaxID_sql = "SELECT MAX(ID) FROM $dbname.$order_table";
        $select_cart_sql = "SELECT * FROM $dbname.$cart_table WHERE userID = " . '"' . $_SESSION['userID'] . '"';

        if ($payment === '余额支付') {
            $select_cartMoney_sql = "SELECT sum(b.Price * a.productNum) AS price FROM $dbname.$cart_table a,$dbname.$shop_table b WHERE userID = " . '"' . $_SESSION['userID'] . '" AND b.productID = a.productID';
            $select_userMoney_sql = "SELECT money FROM $dbname.$user_table WHERE ID = " . '"' . $_SESSION['userID'] . '" AND username = "' . $_SESSION['user'] . '"';

            $moneyRes = $database->query($select_userMoney_sql)->fetch_row();
            $money = floatval($moneyRes[0]);

            $priceRes = $database->query($select_cartMoney_sql)->fetch_row();
            $price = floatval($priceRes[0]);

            if ($_POST['shipping'] === 'sf') $price += 25;

            if ($money - $price < 0) {
                $json = Array('error' => '账户余额不足，请充值后再交易');
                $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                exit($json);
            }

        }

        $cart = $database->query($select_cart_sql);

        $resNum = 0;

        $resNum = intval($resNum);

        $t = udate('YmdHisu') . time() . mtime() . '00';


        while ($cart->data_seek($resNum)) {
            $cartRes = $cart->fetch_assoc();
            $cartProductNum = $cartRes['productNum'];
            $select_shopNum_sql = "SELECT productName,productNum FROM $dbname.$shop_table WHERE productID = '" . $cartRes['productID'] . "'";

            $shopNumRes = $database->query($select_shopNum_sql)->fetch_assoc();
            $shopNum = $shopNumRes['productNum'];

            if ($shopNum - $cartProductNum < 0) {
                $json = Array('error' => '商品 "' . $shopNumRes['productName'] . '" 库存不足，交易失败');
                $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                exit($json);
            }

            $resNum++;
        }

        $resNum = 0;

        while ($cart->data_seek($resNum)) {

            $cartRes = $cart->fetch_assoc();

            $res = $database->query($select_orderMaxID_sql)->fetch_row();

            $select_shopPrice_sql = "SELECT price FROM $dbname.$shop_table WHERE productID = '" . $cartRes['productID'] . "'";
            $shopRes = $database->query($select_shopPrice_sql)->fetch_row();
            $shopPrice = floatval($shopRes[0]);
//            echo $t;
//            var_dump($res);

            $update_shop_sql = "UPDATE $dbname.$shop_table SET productNum = productNum - " . $cartRes['productNum'] . " WHERE productID = '" . $cartRes['productID'] . "'";

            $update_user_sql = "UPDATE $dbname.$user_table SET money = money - " . $price . " WHERE ID = " . '"' . $_SESSION['userID'] . '"';

            if (strnatcasecmp($t, $res[0]) == 1) {

                $price = $shopPrice * $cartRes['productNum'];

                $insert_ord_sql = "INSERT INTO $dbname.$order_table (`ID`,`userID`,`productID`,`statu`,`payment`,`productNum`,`Price`,`address`) VALUES (" . '"' . $t . '","' . $_SESSION['userID'] . '","' . $cartRes['productID'] . '","' . '待处理' . '","' . $payment . '","'.$cartRes['productNum'].'","'.$price.'","'.$address.'")';

                $database->query($update_shop_sql);

                $database->query($update_user_sql);


                if ($database->query($insert_ord_sql) === FALSE) {
                    $json = Array('error' => '交易失败，请稍后再试');
                    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                    exit($json);
                }

                $delete_cart_sql = "DELETE FROM $dbname.$cart_table WHERE productID = " . '"' . $cartRes['productID'] . '" AND userID = "' . $_SESSION['userID'] . '"';

                $database->query($delete_cart_sql);

            } else {
                $r = substr($res[0], 30, 2);
                $r = strval(intval($r) + 1);
                if ($r > 99) {
                    $r = 0;
                    usleep(1);
                    $t = udate('YmdHisu') . time() . mtime();
                }
                if ($r < 10) $r = '0' . $r;
                $t = substr($t, 0, 30) . $r;

                $price = $shopPrice * $cartRes['productNum'];

                $insert_ord_sql = "INSERT INTO $dbname.$order_table (`ID`,`userID`,`productID`,`statu`,`payment`,`productNum`,`Price`,`address`) VALUES (" . '"' . $t . '","' . $_SESSION['userID'] . '","' . $cartRes['productID'] . '","' . '待处理' . '","' . $payment . '","'.$cartRes['productNum'].'","'.$price.'","'.$address.'")';

                $database->query($update_shop_sql);

                $database->query($update_user_sql);

                if ($database->query($insert_ord_sql) === FALSE) {
                    $json = Array('error' => '交易失败，请稍后再试');
                    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                    exit($json);
                }
                $delete_cart_sql = "DELETE FROM $dbname.$cart_table WHERE productID = " . '"' . $cartRes['productID'] . '" AND userID = "' . $_SESSION['userID'] . '"';

                $database->query($delete_cart_sql);
            }

            $resNum++;
        }

        if ($_POST['shipping'] === 'sf') {
            $update_user_sql = "UPDATE $dbname.$user_table SET money = money - 25 WHERE ID = " . '"' . $_SESSION['userID'] . '"';
            $database->query($update_user_sql);
        }


        $json = Array('success' => '订单提交成功');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}

if (isset($_POST['changePayPassword'])) {

    header('Content-Type:application/json; charset=utf-8');
    $json = Array();

    if ($_POST['payPassword'] === '' || $_POST['payPassword'] === '------') {
        $_POST['payPassword'] = '------';
    }

    if(strlen($_POST['newPayPassword']) != 6)
    {
        $json = Array('Error' => '请输入6位支付密码');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    $user_search = "SELECT username from $dbname.$user_table WHERE username = " . '"' . $_SESSION['user'] . '" AND ' . 'payPassword = "' .$_POST['payPassword'].'"';
    if ($database->query($user_search)->fetch_assoc() === null) {
        $json = Array('Error' => '支付密码错误');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
    $payPassword_mod = "UPDATE $dbname.$user_table SET payPassword = " . '"' . $_POST['newPayPassword']. '" ' . 'WHERE username = "' . $_SESSION['user'] . '"';

    $database->query('use' . $dbname);
    $res = $database->query($payPassword_mod);
    if ($res === FALSE) {
        $json = Array('Error' => '支付密码修改失败，请检查信息是否正确');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    } else {
        $json = Array('Success' => '支付密码修改成功');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}

if(isset($_SESSION['user']) && isset($_SESSION['group']) && $_SESSION['group'] === '管理员')
{
    header('Content-Type:application/json; charset=utf-8');
    $json = Array();

    if(isset($_POST['data']))
    {
        $select_shopNum_sql = "select count(*) as num FROM $dbname.$shop_table";
        $select_orderPrice_sql = "select IFNULL(SUM(Price),0.00) as price FROM $dbname.$order_table where statu = '已完成'";
        $select_orderWait_sql = "SELECT COUNT(*) as num FROM $dbname.$order_table where statu = '待处理'";
        $count_user_sql = "select COUNT(*) as num FROM $dbname.$user_table";

        $shopNumRes = $database->query($select_shopNum_sql)->fetch_row();
        $shopNum = $shopNumRes[0];

        $orderPriceRes = $database->query($select_orderPrice_sql)->fetch_row();
        $orderPrice = $orderPriceRes[0];

        $orderWaitRes = $database->query($select_orderWait_sql)->fetch_row();
        $orderWait = $orderWaitRes[0];

        $countUserRes = $database->query($count_user_sql)->fetch_row();
        $countUser = $countUserRes[0];

        $json = Array($shopNum,$orderPrice,$orderWait,$countUser);
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);

    }

    if(isset($_POST['orderStatus']))
    {
        $select_orderStatus_sql = "SELECT COUNT(CASE WHEN statu='待处理' THEN 1 END) as wait,COUNT(CASE WHEN statu='已发货' THEN 1 END) as going,COUNT(CASE WHEN statu='已完成' THEN 1 END) as done FROM $dbname.$order_table";

        $orderStatusRes = $database->query($select_orderStatus_sql)->fetch_row();

        $json = $orderStatusRes;

        $json = json_encode($json, JSON_UNESCAPED_UNICODE);

        exit($json);
    }

    if(isset($_POST['orderListTop']))
    {

        $select_orderListTop_sql = "SELECT a.ID,b.ID,b.username,b.Fname,b.Lname,a.address,a.statu,a.payment FROM $dbname.$order_table a,$dbname.$user_table b where a.userID = b.ID ORDER BY a.ID DESC limit 0,10";

        $orderListTop = $database->query($select_orderListTop_sql);

        $resNum = 0;

        while ($orderListTop->data_seek($resNum)){
            array_push($json,$orderListTop->fetch_row());
            $resNum ++;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['orderList']))
    {

        $count_ResNum_sql = "SELECT count(*) FROM $dbname.$order_table a,$dbname.$shop_table b,$dbname.$user_table c WHERE a.productID = b.productID AND a.userID = c.ID ORDER BY a.ID DESC";

        $resNum = $database->query($count_ResNum_sql)->fetch_row();

        $resNum = $resNum[0];

        $pageRow = 10;

        $maxPage = (int)ceil($resNum / $pageRow );

        if (isset($_POST['pageNum'])) {
            $page = $_POST['pageNum'];
        } else {
            $page = 1;
        }

        array_push($json,Array('maxPage'=>$maxPage,'rows'=>$resNum,'now'=>$page));

        $page = strval((intval($page) - 1) * $pageRow);

        $select_orderList_sql = "SELECT a.productID,b.productName,a.ID,c.ID,c.username,a.productNum,LEFT(DATE_FORMAT(LEFT(a.ID,17),'%Y-%m-%d %H:%i:%s.%f'),23),a.statu,a.payment as time FROM $dbname.$order_table a,$dbname.$shop_table b,$dbname.$user_table c WHERE a.productID = b.productID AND a.userID = c.ID ORDER BY a.ID DESC";

        $select_orderList_sql = $select_orderList_sql. " limit $page,$pageRow";

        $orderList = $database->query($select_orderList_sql);

        $resNum = 0;

        while ($orderList->data_seek($resNum)){
            array_push($json,$orderList->fetch_row());
            $resNum ++;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['updateOrder']))
    {
        switch ($_POST['updateOrder'])
        {
            case 'wait':$work = '待处理';break;
            case 'going':$work = "已发货";break;
            case 'done':$work = "已完成";break;
            case 'cancel':$work = "已取消";break;
            default:$json = Array('error' => '操作失败，请检查订单号是否正确');exit($json);
        }
        $update_order_sql = "UPDATE $dbname.$order_table SET statu = '$work' WHERE ID=".'"'.$_POST['order'].'"';

        if($database->query($update_order_sql) === FALSE)
        {
            var_dump($update_order_sql);
            $json = Array('error' => '操作失败，请检查订单号是否正确');
        }
        else
        {
            $json = Array('success' => '操作成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['productList']))
    {

        $count_ResNum_sql = "SELECT count(*) FROM $dbname.$shop_table";

        $resNum = $database->query($count_ResNum_sql)->fetch_row();

        $resNum = $resNum[0];

        $pageRow = 10;

        $maxPage = (int)ceil($resNum / $pageRow );

        if (isset($_POST['pageNum'])) {
            $page = $_POST['pageNum'];
        } else {
            $page = 1;
        }

        array_push($json,Array('maxPage'=>$maxPage,'rows'=>$resNum,'now'=>$page));

        $page = strval((intval($page) - 1) * $pageRow);

        $select_productList_sql = "SELECT productID,productName,productNum,Price,category,description,parameter FROM $dbname.$shop_table";

        $select_productList_sql = $select_productList_sql. " limit $page,$pageRow";

        $productList = $database->query($select_productList_sql);

        $resNum = 0;

        while ($productList->data_seek($resNum)){
            $tmp = $productList->fetch_row();
            $tmp[5] = htmlspecialchars($tmp[5]);
            $tmp[6] = htmlspecialchars($tmp[6]);
            array_push($json,$tmp);
            $resNum ++;
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['uploadShowImg']))
    {
        $fileList = Array('png','jpg','jpeg','bmp');
        $path = '../images/product';
        $dir = $path.'/'.$_POST['productID'];
        if(!is_dir($dir))
        {
            if(!is_dir($path))
            {
                mkdir($path,0777);
            }
            mkdir($dir,0777);
        }
        $files = sFileone();

        if(!in_array(substr(strrchr($files['name'],'.'),1),$fileList))
        {
            $json = Array('error' => '只支持上传png、jpg、jpeg、bmp格式图片');
            $json = json_encode($json, JSON_UNESCAPED_UNICODE);
            exit($json);
        }
        move_uploaded_file($files['tmp_name'],$dir.'/img.jpg');
        $json = Array('success' => '图片更新成功');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }


    if (isset($_POST['updateProducts']))
    {
        $pid = $_POST['updateProducts'];

        $update_product_sql = "UPDATE $dbname.$shop_table SET `productName` = '".$_POST['productName']."',`productNum` = ".$_POST['productNum'].", `Price` = ".$_POST['Price'].", `category` = '".$_POST['category']."', `description` = '".base64_decode($_POST['description'])."', `parameter` = '".base64_decode($_POST["parameter"])."' WHERE `productID` = '".$_POST['updateProducts']."'";

        if($database->query($update_product_sql) === FALSE)
        {
            $json = Array('error'=>'商品信息修改失败');
        }
        else{
            $json = Array('success'=>'商品信息修改成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if (isset($_POST['newProducts']))
    {
        $pid = trim(guid(), '{}');
        base64_decode($_POST['description']);
        base64_decode($_POST["parameter"]);
        $insert_product_sql = "INSERT INTO $dbname.$shop_table (`productID`, `productName`, `productNum`, `Price`, `category`, `description`, `parameter`) VALUES ('".$pid."', '".$_POST['productName']."', ".$_POST['productNum'].",".$_POST['Price'].", '".$_POST['category']."', '".$_POST['description']."', '".$_POST['parameter']."');";

        if($database->query($insert_product_sql) === FALSE)
        {
            $json = Array('error'=>'商品添加失败');
        }
        else{
            $json = Array('success'=>'商品添加成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['showProductImg'])){
        $dir = '../images/product/'.$_POST['showProductImg'];
        $res = scandir($dir);
        $res = array_diff($res,Array('.','..','img.jpg'));
        foreach ( $res as $data)
        {
            $data = iconv('gbk' , 'utf-8',$data);
            array_push($json,$dir.'/'.$data);
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['delImg'])){
        $dir = '../images/product/'.$_POST['delImg'];
        if(unlink(iconv("utf-8","gbk",$dir.'/'.$_POST['path'])))
        {
            $json = Array('success'=>'删除文件成功');
        }
        else{
            $json = Array('error'=>'删除文件失败，请检查路径是否正确');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['uploadProductImg']))
    {
        $fileList = Array('png','jpg','jpeg','bmp');
        $path = '../images/product';
        $dir = $path.'/'.$_POST['uploadProductImg'];
        if(!is_dir($dir))
        {
            if(!is_dir($path))
            {
                mkdir($path,0777);
            }
            mkdir($dir,0777);
        }
        $files = sFile();
        foreach ( $files as $file)
        {
            if(!in_array(substr(strrchr($file['name'],'.'),1),$fileList))
            {
                $json = Array('error' => '只支持上传png、jpg、jpeg、bmp格式图片');
                $json = json_encode($json, JSON_UNESCAPED_UNICODE);
                exit($json);
            }
        }

        foreach ( $files as $file)
        {
            move_uploaded_file($file['tmp_name'],iconv("utf-8","gbk",$dir.'/'.$file['name']));
        }

        $json = Array('success' => '图片更新成功');
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['userList']))
    {
        $count_ResNum_sql = "SELECT count(*) FROM $dbname.$user_table";

        $resNum = $database->query($count_ResNum_sql)->fetch_row();

        $resNum = $resNum[0];

        $pageRow = 10;

        $maxPage = (int)ceil($resNum / $pageRow );

        if (isset($_POST['pageNum'])) {
            $page = $_POST['pageNum'];
        } else {
            $page = 1;
        }

        array_push($json,Array('maxPage'=>$maxPage,'rows'=>$resNum,'now'=>$page));

        $page = strval((intval($page) - 1) * $pageRow);

        $select_userList_sql =  "SELECT ID,username,money,Fname,Lname,email,address,`group` FROM $dbname.$user_table";

        $select_userList_sql = $select_userList_sql. " limit $page,$pageRow";

        $userList = $database->query($select_userList_sql);

        $resNum = 0;
        while( $userList->data_seek($resNum))
        {
            array_push($json,$userList->fetch_row());
            $resNum++;
        }
        $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['reSetPasswd']))
    {
        $newPasswd = sha1(sha1('000000').$salt);
        $reSetPasswd_sql = "UPDATE $dbname.$user_table SET `password` = '$newPasswd' WHERE `ID` = '".$_POST['reSetPasswd']."'";
        if($database->query($reSetPasswd_sql) === FALSE)
        {
            $json = Array('error' => '用户密码重置失败');
        }
        else
        {
            $json = Array('success' => '用户密码重置成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['reSetPayPasswd']))
    {
        $newPayPasswd = '------';
        $reSetPayPasswd_sql = "UPDATE $dbname.$user_table SET `payPassword` = '$newPayPasswd' WHERE `ID` = '".$_POST['reSetPayPasswd']."'";
        if($database->query($reSetPayPasswd_sql) === FALSE)
        {
            $json = Array('error' => '支付密码重置失败');
        }
        else
        {
            $json = Array('success' => '支付密码重置成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }

    if(isset($_POST['changeGroup']))
    {
        $changeGroup = $_POST['changeGroupTo'];

        $changeGroup_sql = "UPDATE $dbname.$user_table SET `group` = '$changeGroup' WHERE `ID` = '".$_POST['changeGroup']."'";
        if($database->query($changeGroup_sql) === FALSE)
        {
            $json = Array('error' => '用户组修改失败');
        }
        else
        {
            $json = Array('success' => '用户组修改成功');
        }
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        exit($json);
    }
}