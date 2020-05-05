<?php
session_start();

require_once './core.php';

//创建一张宽120高30的图像
$image = "";
function VerifyCode($width=120,$height=30,$len=6)
{
    global $image;
    $image = imagecreatetruecolor($width, $height);
    //为$image设置背景颜色为白色
    $bgcolor = imagecolorallocate($image, 255, 255, 255);
    //填充背景颜色
    imagefill($image, 0, 0, $bgcolor);

    $captch_code = "";
    for ($i = 0; $i < $len; $i++) {
        $fontsize = 60;
        $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
//        $data = "1234567890abcdefghigklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ";
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //设置每次产生的字符从$data中每次截取一个字符
        $fontcontent = substr($data, rand(0, strlen($data)), 1);
        //让产生的四个字符拼接起来
        $captch_code .= $fontcontent;
        //控制每次出现的字符的坐标防止相互覆盖即x->left y->top
        $x = ($i * $width / $len) + rand(5, 10);
        $y = rand(5, $height-15);
        //此函数用来将产生的字符在背景图上画出来
        imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
    }

    $rgb=array();
    $direct=rand(0,1);
    $width = imagesx($image);
    $height = imagesy($image);
    $level = $width / 65;
    for($j = 0;$j < $height;$j++) {
        for($i = 0;$i < $width;$i++) {
            $rgb[$i] = imagecolorat($image, $i , $j);
        }
        for($i = 0;$i < $width;$i++) {
            $r = sin($j / $height * 2 * M_PI - M_PI * 0.5) * ($direct ? $level : -$level);
            imagesetpixel($image, $i + $r , $j , $rgb[$i]);
        }
    }

//    $_SESSION['authCode'] = $captch_code;//把产生的验证码存入session中
    //用来在背景图片上产生干扰点
    for ($i = 0; $i < 300; $i++) {
        //干扰点的颜色
        $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
        //该函数用来把每个干扰点在背景上描绘出来
        imagesetpixel($image, rand(1, $width-1), rand(1, $height-1), $pointcolor);
    }

    //干扰线
    for ($i = 0; $i < 6; $i++) {
        //干扰线的颜色
        $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
        //画出每条干扰线
        imageline($image, rand(1, $width), rand(1, $height), rand(1, $width), rand(1, $height), $linecolor);
    }

    return $captch_code;
}

//$vCode = guid();
//$_SESSION['token'] = $vCode;

//echo $_SESSION['token'];
//var_dump($_GET);
if(isset($_GET['authToken']) && $_GET['authToken'] === $_SESSION['authToken']) {
    while (true) {
        $_SESSION['authCode'] = VerifyCode();
        if (strlen($_SESSION['authCode']) < 6) {
            $_SESSION['authCode'] = VerifyCode();
        } else {
            //设置header图片格式为png
            header('content-type:image/png');
            //显示图片
            imagepng($image);   //以 PNG 格式将图像输出到浏览器或文件
//            setcookie('code',$_SESSION['authCode'],time()+5); //测试
            //destory
            imagedestroy($image);  //图像处理完成后，使用 imagedestroy() 指令销毁图像资源以释放内存，虽然该函数不是必须的，但使用它是一个好习惯。
//            return $img;
            $_SESSION['authToken'] = md5(base64_encode(sha1(guid())));
            break;
        }
    }
}
else
{
    echo 'Forbidden';
}

