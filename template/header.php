<!--== Start Header Section ==-->
<header id="header-area">
    <!-- Start PreHeader Area -->
    <div class="preheader-area">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-6">
                    <div class="preheader-contact-info d-flex align-items-center justify-content-between justify-content-md-start">
                        <div class="single-contact-info">
                           
                            <a href="#" class="contact-text">
                               社区
                            </a>
                        </div>
                        <div class="single-contact-info">
                           
                            <a href="" class="contact-text">
                               体验店
                            </a>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-7 col-lg-6 mt-xs-10">
                    <div class="site-setting-menu">
                        <ul class="nav justify-content-center justify-content-md-end">

                            <!--<li><a href="cart.php">购物车</a></li>-->

                            <!--                            <li class="switcher dropdown-show"><a href="#" class="arrow-toggle">中文</a>-->
                            <!--                                <ul class="dropdown-nav">-->
                            <!--                                    <li><a href="#">孟加拉</a></li>-->
                            <!--                                    <li><a href="#">中文</a></li>-->
                            <!--                                    <li><a href="#">印地语</a></li>-->
                            <!--                                    <li><a href="#">乌尔都语</a></li>-->
                            <!--                                </ul>-->
                            <!--                            </li>-->

                            <?php

                            if (isset($_SESSION['user'])) {
                                echo '<li><a href="my.php">个人中心</a></li>';
                                if($_SESSION['group'] = '管理员') echo '<li><a href="./admin/index.php">管理中心</a></li>';
                                echo '<li class="switcher dropdown-show"><a href="#" class="text-danger" id="logout">退出登录</a></li>';
                            } else {
                                echo '<li><a href="login.php">登录</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PreHeader Area -->

    <!-- Start Header Middle Area -->
    <div class="header-middle-area">
        <div class="container">
            <div class="row">
                <!-- Logo Area Start -->
                <div class="col-4 col-md-2 col-xl-3 m-auto text-center text-lg-left">
                    <a href="index.php" class="logo-wrap d-block">
                        <img src="assets/img/logo.png" alt="Logo" class="img-fluid"/>
                    </a>
                </div>
                <!-- Logo Area End -->

                <!-- Search Box Area Start -->
                <div class="col-8 col-md-7 col- m-auto ">
                    <div class="search-box-wrap">
                        <form class="search-form d-flex" action="shop.php" method="get">
                            <input type="search" name="search" placeholder="输入关键词搜索"/>
                            <button class="btn btn-search"><img src="assets/img/icons/icon-search.png"
                                                                alt="Search Icon"/>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search Box Area End -->

                <!-- Mini Cart Area Start -->
                <div class="col-12 col-md-3 col-xl-2 m-auto text-center text-lg-right mt-xs-15">
                    <div class="minicart-wrapper">
                        <button class="btn btn-minicart">购物车<sup class="cart-count" style="display: none"></sup>
                        </button>
                        <div class="minicart-content" style=" max-height: 500px; overflow-y: scroll;">
                            <div class="mini-cart-body">

                            </div>
                            <div class="mini-cart-footer">
                                <a href="cart.php" class="btn w-100">结算</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {

                        $('.btn-minicart').on('click', function () {
                            if ($('.minicart-content').css('display') != 'block') {
                                $.ajax({
                                    url: './cart.php',
                                    type: 'POST',
                                    data: {
                                        'select': ''
                                    },
                                    async: false,
                                    success: function (datas) {
                                        contain = ''
                                        var data = -1
                                        for (data in datas) {
                                            contain += '                                <!-- Single Cart Item Start -->\n' +
                                                '                                <div class="single-cart-item d-flex">\n' +
                                                '                                    <figure class="product-thumb">\n' +
                                                '                                        <a href="product.php?pid='+datas[data][3]+'">\n' +
                                                '                                            <img src="images/product/'+datas[data][3]+'/img.jpg" alt="Products"/></a>\n' +
                                                '                                    </figure>\n' +
                                                '                                    <div class="product-details">\n' +
                                                '                                        <h2><a href="product.php?pid='+datas[data][3]+'">' + datas[data][0] + '</a></h2>\n' +
                                                '                                        <div class="cal d-flex align-items-center">\n' +
                                                '                                            <span class="quantity">' + datas[data][1] + '</span>\n' +
                                                '                                            <span class="multiplication">X</span>\n' +
                                                '                                            <span class="price">' + datas[data][2] + '</span>\n' +
                                                '                                        </div>\n' +
                                                '                                    </div>\n' +
                                                '                                    <a href="#" class="remove-icon" pid="' + datas[data][3] + '"><i class="fa fa-trash-o"></i></a>\n' +
                                                '                                </div>\n' +
                                                '                                <!-- Single Cart Item End -->'
                                        }

                                        $(document).ready(function () {
                                            $('.remove-icon').on('click', function () {
                                                $.ajax({
                                                    url: './cart.php',
                                                    type: 'POST',
                                                    data: {
                                                        'delete': $(this).attr('pid'),
                                                    },
                                                    async: false,
                                                    success: function (datas) {
                                                        if ('Error' in datas) {
                                                            alert(datas['Error'])
                                                        } else {
                                                            contain = ''
                                                            var data = -1
                                                            for (data in datas) {
                                                                contain += '                                <!-- Single Cart Item Start -->\n' +
                                                                    '                                <div class="single-cart-item d-flex">\n' +
                                                                    '                                    <figure class="product-thumb">\n' +
                                                                    '                                        <a href="product.php?pid='+datas[data][3]+'">\n' +
                                                                    '                                            <img src="images/product/'+datas[data][3]+'/img.jpg" alt="Products"/></a>\n' +
                                                                    '                                    </figure>\n' +
                                                                    '                                    <div class="product-details">\n' +
                                                                    '                                        <h2><a href="product.php?pid='+datas[data][3]+'">' + datas[data][0] + '</a></h2>\n' +
                                                                    '                                        <div class="cal d-flex align-items-center">\n' +
                                                                    '                                            <span class="quantity">' + datas[data][1] + '</span>\n' +
                                                                    '                                            <span class="multiplication">X</span>\n' +
                                                                    '                                            <span class="price">' + datas[data][2] + '</span>\n' +
                                                                    '                                        </div>\n' +
                                                                    '                                    </div>\n' +
                                                                    '                                    <a href="#" class="remove-icon" pid="' + datas[data][3] + '"><i class="fa fa-trash-o"></i></a>\n' +
                                                                    '                                </div>\n' +
                                                                    '                                <!-- Single Cart Item End -->'
                                                            }

                                                            if (data > -1) {
                                                                $('.cart-count').css({'display': 'inline-block'}).html(parseInt(data) + 1)
                                                            } else {
                                                                $('.cart-count').css({'display': 'none'})
                                                                contain = '<div class="single-cart-item d-flex"><h4 class="text-center mx-auto text-dark">购物车内暂无商品</h4></div>'
                                                            }
                                                            $('.mini-cart-body').html(contain)
                                                        }
                                                    }
                                                })
                                            })
                                        })


                                        if (data > -1) {
                                            $('.cart-count').css({'display': 'inline-block'}).html(parseInt(data) + 1)
                                        } else {
                                            $('.cart-count').css({'display': 'none'})
                                            contain = '<div class="single-cart-item d-flex"><h4 class="text-center mx-auto text-dark">购物车内暂无商品</h4></div>'
                                        }
                                        $('.mini-cart-body').html(contain)
                                    }
                                })
                            }
                        })

                        $('.btn-minicart').click()


                    })
                </script>
                <!-- Mini Cart Area End -->
            </div>
        </div>
    </div>
    <!-- End Header Middle Area -->

    <!-- Start Main Menu Area -->
    <div class="navigation-area" id="fixheader">
        <div class="container">
            <div class="row">
                <!-- Categories List Start -->
                <div class="col-10 col-lg-3">
                    <div class="categories-list-wrap">
                        <button class="btn btn-category d-none d-lg-inline-block"><i class="fa fa-bars"></i>商品种类
                        </button>
                        <ul class="category-list-menu">
                            <li class="category-item-parent dropdown-show">
                                <a href="#" class="category-item arrow-toggle">
                                    <img src="assets/img/icons/desktop.png" alt="Computer"/>
                                    <span>手机</span>
                                </a>
                                <ul class="mega-menu-wrap dropdown-nav">
                                    <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">小米手机</a>
                                        <ul>
                                            <li><a href="product.php?pid=04ADA990-B37F-6355-4B2F-E970F328B8A8">小米CC9 Pro</a></li>
                                            <li><a href="product.php?pid=04ADA990-B37F-6355-4B2F-E970F328B8A8">小米9 Pro 5G</a></li>
                                            <li><a href="product.php?pid=04ADA990-B37F-6355-4B2F-E970F328B8A8">小米CC9</a></li>
                                            <li><a href="product.php?pid=04ADA990-B37F-6355-4B2F-E970F328B8A8">小米CC9 美图定制版</a></li>
                                        </ul>
                                    </li>

                                    <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">Redmi手机</a>
                                        <ul>
                                            <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K30</a></li>
                                            <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K30 5G</a></li>
                                            <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi 8A</a></li>
                                            <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K20 Pro 尊享版</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="category-item-parent dropdown-show">
                                <a href="#" class="category-item arrow-toggle">
                                    <img src="assets/img/icons/desktop.png" alt="Computer"/>
                                    <span>电脑</span>
                                </a>
                                <ul class="mega-menu-wrap dropdown-nav">
                                    <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">小米笔记本</a>
                                        <ul>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">RedmiBook 13</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">RedmiBook 14</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">小米笔记本Air 12.5</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">小米笔记本Air</a></li>
                                        </ul>
                                    </li>

                                    <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">荣耀笔记本</a>
                                        <ul>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">荣耀 MagicBook Pro</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">荣耀 MagicBook Pro 科技尝鲜版</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">荣耀MagicBook 2019 科技尝鲜版</a></li>
                                            <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">荣耀MagicBook 锐龙版</a></li>
                                        </ul>
                                    </li>

                                    <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">其他</a>
                                        <ul>
                                            <li><a href="shop.php">更多详情</a></li>
                                           
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/camera.png" alt="Camera"/>
                                    <span>家电</span>
                                </a>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/fan.png" alt="Camera"/>
                                    <span> 穿戴 </span>
                                </a>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/games.png" alt="Camera"/>
                                    <span>路由器</span>
                                </a>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/tv.png" alt="Camera"/>
                                    <span> 配件 </span>
                                </a>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/desktop.png" alt="Computer"/>
                                    <span>显示器</span>
                                </a>
                            </li>
                            <li class="category-item-parent hidden">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/mobile.png" alt="Mobile"/>
                                    <span>耳机 音响 </span>
                                </a>
                            </li>
                            <li class="category-item-parent hidden">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/camera.png" alt="Camera"/>
                                    <span>摄像机</span>
                                </a>
                            </li>
                            <li class="category-item-parent hidden">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/fan.png" alt="Camera"/>
                                    <span>风扇</span>
                                </a>
                            </li>
                            <li class="category-item-parent hidden">
                                <a href="shop.php" class="category-item">
                                    <img src="assets/img/icons/games.png" alt="Camera"/>
                                    <span>游戏机</span>
                                </a>
                            </li>
                            <li class="category-item-parent">
                                <a href="shop.php" class="category-item btn-more">更多种类</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Categories List End -->

                <!-- Main Menu Start -->
                <div class="col-2 col-lg-9 d-none d-lg-block">
                    <div class="main-menu-wrap">
                        <nav class="mainmenu">
                            <ul class="main-navbar clearfix">
                                <li class="dropdown-show">
                                    <a href="index.php" class="">首页</a>
<!--                                    <ul class="dropdown-nav sub-dropdown">-->
<!--                                        <li><a href="index.php">首页 1</a></li>-->
<!--                                        <li><a href="index2.html">首页 2</a></li>-->
<!--                                        <li><a href="index3.html">首页 3</a></li>-->
<!--                                        <li><a href="index4.html">首页 4</a></li>-->
<!--                                    </ul>-->
                                </li>
<!--                                <li><a href="about.html">关于我们</a></li>-->
                                <li class="dropdown-show"><a href="shop.php" class="arrow-toggle">手机</a>
                                    <ul class="mega-menu-wrap dropdown-nav">
                                        <li class="mega-menu-item"><a href="shop.php" class="mega-item-title">小米手机</a>
                                            <ul>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米CC9 Pro</a></li>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米9 Pro 5G</a></li>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米CC9</a></li>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米CC9e</a></li>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米CC9 美图定制版</a></li>
                                                <li><a href="product.php?pid=19E95F8D-36F2-3985-3501-92EE23819179">小米MIX 3</a></li>
                                                
                                            </ul>
                                        </li>

                                        <li class="mega-menu-item"><a href="shop.php"
                                                                      class="mega-item-title">Redmi 红米</a>
                                            <ul>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K30</a></li>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K30 5G</a></li>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi 8A</a></li>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi Note 8</a></li>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi K20 Pro 尊享版</a></li>
                                                <li><a href="product.php?pid=056CF9A2-3B6E-00FA-5364-D972803FEF89">Redmi Note 8 Pro</a></li>
                                                
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="dropdown-show"><a href="shop.php" class="arrow-toggle">笔记本</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">RedmiBook 13</a></li>
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">小米笔记本Pro 15.6</a></li>
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">RedmiBook 14</a></li>
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">游戏本2019款</a></li>
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">小米笔记本 15.6</a></li>
                                        <li><a href="product.php?pid=454A6049-4A14-34C9-E9E7-6DA8489F44B7">小米笔记本Air 12.5</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-show"><a href="shop.php" class="arrow-toggle">家电</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">米家互联网空调C1（一级能效）</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">米家互联网空调（一级能效）</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">Redmi全自动波轮洗衣机1A</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">米家互联网洗烘一体机10kg</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米净水器</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-show"><a href="shop.php" class="arrow-toggle">路由器</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">Redmi路由器AC2100</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米路由器AC2100</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米路由器 Mesh</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米路由器4A 千兆版</a></li>
                                        <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米路由器 4C</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-show"><a href="shop.php" class="arrow-toggle">其他</a>
                                    <ul class="mega-menu-wrap dropdown-nav">
                                        <li class="mega-menu-item"><a href="shop.php"
                                                                      class="mega-item-title">智能硬件</a>
                                            <ul>
                                                <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米米家智能摄像机云台版</a></li>
                                                <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米小爱老师</a></li>
                                                <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米米家智能门锁</a></li>
                                                <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">小米小爱触屏音箱</a></li>
                                                <li><a href="product.php?pid=57DA087B-5BC5-59B1-FD45-DD2912600D42">Redmi小爱音箱 Play</a></li>
                                            </ul>
                                        </li>

                                        <li class="mega-menu-item"><a href="shop.php"
                                                                      class="mega-item-title">服务</a>
                                           
                                        </li>

                                        <li class="mega-menu-item"><a href="shop.php"
                                                                      class="mega-item-title">社区</a>
                                            
                                        </li>

                                        
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Main Menu End -->
            </div>
        </div>
    </div>
    <!-- End Main Menu Area -->
</header>
<!--== End Header Section ==-->

<script>
    $(document).ready(function () {
        $('#logout').on('click', function () {
            $.ajax({
                url: './core/system.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'LoginOut': ''
                },
                async: false,
                success: function (data) {
                    content = ''
                    for (x in data) {
                        location.reload();
                    }
                }
            })
        })
    })
</script>