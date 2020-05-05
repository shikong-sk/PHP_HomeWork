<?php
    error_reporting(2);

    define('__ROOT__',dirname(__FILE__).'/../');

    require_once __ROOT__.'./config/global.config.php';
    require_once  __ROOT__.'./config/db.config.php';

    function mtime()
    {
        $t = explode(' ',microtime());
        $t = $t[0] * 1000;
        $t = round($t,0);
        if($t < 100) $t = '0'.strval($t);
        if($t < 10) $t = '0'.strval($t);
        if($t < 1) $t = '0'.strval($t);
        return $t;
    }

    function udate($format)
    {
        return date(preg_replace('`(?<!\\\\)u`',mtime(),$format));
    }

    function guid() {
        if (function_exists('com_create_guid')){
            $uuid = com_create_guid();
        }else{
            mt_srand();//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = "-";
            $uuid = "{"
                .substr($charid,0,8 ).$hyphen
                .substr($charid, 8,4 ).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20)
                ."}";
        }
        return $uuid;
    }

function sSize($size){
    $i = 0;
    $sz ='bkMGTP';
    while(1){
        if ($size >= 1024 && $i < strlen($sz)-1)
        {
            $size /= 1024;
            ++$i;
        }
        else
        {
            if($i>= strlen($sz))
            {
                return round($size, 2) . $sz[strlen($sz) - 1];
            }
            return round($size,2).$sz[$i];
        }
    }
}

function sFileOne()
{
    $files = array();
    foreach ($_FILES as $FILE => $file)
    {
        $i=0;
//            echo($FILE);
        $num = count($file['name']);
        if ($num == 1)
        {
            $files['name']=$file['name'];
            $files['type']=$file['type'];
            $files['tmp_name']=$file['tmp_name'];
            $files['error']=$file['error'];
            $files['size']=Ssize($file['size']);
        }
        else
        {
            for(;$i<$num;$i++)
            {
                $files[$i]['name']=$file['name'][$i];
                $files[$i]['type']=$file['type'][$i];
                $files[$i]['tmp_name']=$file['tmp_name'][$i];
                $files[$i]['error']=$file['error'][$i];
                $files[$i]['size']=Ssize($file['size'][$i]);
            }
        }
    }
    return $files;
}

function sFile()
{
    $files = array();
    foreach ($_FILES as $FILE => $file)
    {
        $i=0;
//            echo($FILE);
        $num = count($file['name']);
        if ($num == 1)
        {
            $files[$i]['name']=$file['name'][$i];
            $files[$i]['type']=$file['type'][$i];
            $files[$i]['tmp_name']=$file['tmp_name'][$i];
            $files[$i]['error']=$file['error'][$i];
            $files[$i]['size']=Ssize($file['size'][$i]);
        }
        else
        {
            for(;$i<$num;$i++)
            {
                $files[$i]['name']=$file['name'][$i];
                $files[$i]['type']=$file['type'][$i];
                $files[$i]['tmp_name']=$file['tmp_name'][$i];
                $files[$i]['error']=$file['error'][$i];
                $files[$i]['size']=Ssize($file['size'][$i]);
            }
        }
    }
    return $files;
}


$blacklist = Array("order by",'or','and','rpad','concat',' ','union','%a0',',','if','xor','join','rand','floor','outfile','mid','#','\|\|','--+','0[xX][0-9a-fA-F]+');
    foreach ($_POST as $key => $value)
    {
        foreach ($blacklist as $blackItem){
            if (preg_match('/\b' . $blackItem . '\b/im', $value)) {
                die('非法参数'.$value);
            }
        }
    }

?>