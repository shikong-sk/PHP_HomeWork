<?php
require_once './core.php';

$shop_table = 'shop';


function showShop()
{
    global $database, $dbname, $tbname;
    global $shop_table;
    $shop_sql = 'select * from ' . $dbname . '.' . $tbname . $shop_table . ' order by productName desc';

    $res = $database->query($shop_sql);
    if ($res->num_rows > 0) {
        $r = $res->fetch_assoc();
        mysqli_data_seek($res, 0);
        foreach (array_keys($r) as $key) {
            echo '<p style="display: inline-block;width: calc(100%/6);font-size: 12px;text-align: center;margin-bottom: 5px;">' . $key . ' </p>';
        }
        while ($r = $res->fetch_assoc())
        {
            foreach ($r as $key => $value)
            {
                echo '<p style="display: inline-block;width: calc(100%/6);font-size: 12px;text-align: center;margin-bottom: 5px;">'.$value.' </p>';
            }
            echo '<br>';
        }
    }
}

function addShop()
{
    global $database, $dbname, $tbname;
    global $shop_table;
    $field = Array();
    $shop_sql = 'select * from ' . $dbname . '.' . $tbname . $shop_table . ' order by productName desc limit 0,1';
    $res = $database->query($shop_sql);
    if ($res->num_rows > 0) {
        $r = array_keys($res->fetch_assoc());
        echo '<script>window.onload = function (){document.getElementsByTagName("body")[0].addEventListener("keydown",function(event) {if(event.keyCode == 13){document.getElementById("add").click();}})}</script>';
        foreach ($r as $key) {
            if($key == 'productID')continue;
            echo '<p style="display: inline-block;width: 20%;font-size: 12px;text-align: center;margin-bottom: 5px;">' . $key . ' </p>';
        }

    }
    echo '<form action="" method="post">';
    foreach ($res->fetch_fields() as $key) {
        foreach($key as $k)
        {
            array_push($field,$k);
            break;
        }
    }

    foreach ($field as $key) {
        if($key === 'productID') continue;
        echo '<input name="' . $key . '" style="display: inline-block;width: 20%;font-size: 12px;text-align: center;margin-bottom: 5px;" ' . ($key == "productName" ? "autofocus='autofocus'" : '') . ' placeholder="'.$key.'">';
    }
    echo '<input id="add" type="submit" value="提交" style="width: 100%" name="add">';
    echo '</form>';
}

addShop();
showShop();

if (isset($_POST['add'])) {
    $key = array('productName','Price','category','productNum','description');
    $null = array('productName','Price','category','productNum','description');
    foreach ($key as $x) {
        if (isset($_POST[$x])) {
            if ($_POST[$x] == '') {
                if (in_array($x, $null)) {
                    $_POST[$x] = 'NULL';
                } else {
//                        $error = '';
//                        foreach(array_diff($key,$null) as $e)
//                            $error .= $e.',';
//                        $error = rtrim($error,',');
//                        die('参数有误：<br>'.$error.'<br>不能为空');
                    die('参数有误：<span style="color: red">' . $x . '属性</span> 不能为空');
                }
            }
        } else {
            die('参数有误');
        }
    }
    $shop_insert = "
        INSERT INTO " . $dbname . "." . $tbname . $shop_table . " (productID,productName,Price,category,productNum,description ) 
        VALUES ('".trim(guid(), '{}')."','".$_POST['productName']."','".$_POST['Price']."','".$_POST['category']."','".$_POST['productNum']."','".$_POST['description']."');";
    echo $shop_insert;
    if ($database->query($shop_insert) === FALSE) {
        echo '<br>数据添加失败，请检查参数是否有误<br>';
        die($database->error);
    } else {
        echo '<br>数据添加成功<br>';
        header('Location:product.core.php');
    }
}
?>