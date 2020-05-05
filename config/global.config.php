<?php
    date_default_timezone_set('PRC');
    $global_lifeTime = 60 * 60 * 2 * 1;
    session_set_cookie_params($global_lifeTime); // 全局默认SESSION 有效时间：（60）秒 （60）分 （24）时 （365）天
?>