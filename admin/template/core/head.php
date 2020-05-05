<!doctype html>
<html lang="zh-CN">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="assets/images/favicon.ico">

    <!-- Messgaes CSS -->
    <link href="assets/css/pages/messages.css" rel="stylesheet">

    <!-- Base CSS -->
    <link rel="stylesheet" href="assets/css/basestyle/style.css">

    <!-- Material Icons -->
    <link href="assets/css/font.css" rel="stylesheet">

    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker/daterangepicker.css" />

    <!-- Full Calendar Icons -->
    <link href="assets/css/fullcalendar/fullcalendar.css" rel="stylesheet">


    <title>仪表板管理</title>

    <script src="assets/js/lib/jquery.min.js"></script>

    <script src="../core/jquery.base64.js"></script>
</head>
<body>

<!-- Pre Loader-->
<div class="loader-wrapper">
    <div class="spinner">
        <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="length" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="28"></circle>
        </svg>
        <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="28"></circle>
        </svg>
        <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="28"></circle>
        </svg>
        <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="28"></circle>
        </svg>
    </div>
</div>
<!-- Pre Loader-->



<section class="wrapper">


    <!-- SIDEBAR -->
    <aside class="sidebar">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand m-0 py-2 brand-title" href="#">管理中心</a>
            <span></span>
            <a class="navbar-brand py-2 material-icons toggle-sidebar" href="#">menu</a>
        </nav>

        <nav class="navigation" >
            <ul>
                <li><a href="index.php" title="控制台"><span class="nav-icon material-icons">public</span> 控制台</a></li>
<!--                <li title="主题设置"><a href="theme-setting.html"><span class="nav-icon material-icons ">color_lens</span> 主题设置 </a>-->
<!--                </li>-->
<!--                <li><a href="#" title="布局选项"><span class="nav-icon material-icons">dashboard</span>布局选项<span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="top-navigation.html" title="Top Navigation">顶部导航</a></li>-->
<!--                        <li><a href="fixed-layout.html" title="Fixed Layout">固定布局</a></li>-->
<!--                        <li><a href="sidebar-variations.html" title="Compact Menu">侧边栏更改</a></li>-->
<!--                        <li><a href="fluid-content.html" title="Fluid Content">不固定内容</a></li>-->
<!--                        <li><a href="fixed-content.html" title="Fixed Content">固定内容</a></li>-->
<!--                        <li><a href="tabded-header.html" title="Tabded Header">制表符标题</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
                    <!--                    <a href="#" title="电子商务"><span class="nav-icon material-icons ">shopping_cart</span> 电子商务 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="ecommerce-dashboard.html" title="仪表板">仪表板</a></li>-->
                        <li><a href="order.php" title="订单管理">订单管理</a></li>
                        <li><a href="products.php" title="商品管理">商品管理</a></li>
                        <li><a href="users.php" title="用户管理">用户管理</a></li>

<!--                    </ul>-->
<!--                </li>-->
            </ul>

<!--            <label title="UI Elements & Widgets"><span>UI元素和小部件</span></label>-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <a href="#" title="UI 元素"><span class="nav-icon material-icons ">extension</span> UI 元素 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="general-elements.html" title="基本要素">基本要素</a></li>-->
<!--                        <li><a href="buttons.html" title="按钮">按钮</a></li>-->
<!--                        <li><a href="modals.html" title="情态动词">情态动词</a></li>-->
<!--                        <li><a href="tabs-navs.html" title="标签和名称">标签和名称</a></li>-->
<!--                        <li><a href="full-calendar.html" title="全日历表">全日历表</a></li>-->
<!--                        <li><a href="icons.html" title="图标">图标</a></li>-->
<!--                        <li><a href="typography.html" title="字体排版">字体排版</a></li>-->
<!--                        <li><a href="tree-view.html" title="树视图">树视图</a></li>-->
<!--                        <li><a href="bootstrap-grid.html" title="引导网络">引导网络</a></li>-->
<!--                        <li><a href="loaders.html" title="加载器">加载器</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="Form Stuff">-->
<!--                    <a href="#" title=""><span class="nav-icon material-icons ">assignment</span> 表格材料 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="form-styling.html" title="表格样式">表格样式</a></li>-->
<!--                        <li><a href="form-validation.html" title="表格验证">表格验证</a></li>-->
<!--                        <li><a href="pickers.html" title="选择器">选择器</a></li>-->
<!--                        <li><a href="form-wizard.html" title="表格导向">表格导向</a></li>-->
<!--                        <li><a href="code-editor.html" title="代码编辑器">代码编辑器</a></li>-->
<!--                        <li><a href="wysihtml-editor.html" title="Wysihtml编辑器">Wysihtml编辑器</a></li>-->
<!--                        <li><a href="file-uploder.html" title="文件上传器">文件上传器</a></li>-->
<!--                        <li><a href="image-croping.html" title="图片裁剪">图片裁剪</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" title="数据网络"><span class="nav-icon material-icons ">apps</span> 数据网络 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="basic-tables.html" title="基本表">基本表</a></li>-->
<!--                        <li><a href="static-data-grid.html" title="静态数据网络">静态数据网络</a></li>-->
<!--                        <li><a href="data-grid.html" title="数据网络">数据网络</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" title="图表"><span class="nav-icon material-icons ">equalizer</span> 图表 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="basic-charts.html" title="Basic Charts">基本图表</a></li>-->
<!--                        <li><a href="advanced-charts.html" title="Advanced Charts">高级图表</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" title="Google 地图"><span class="nav-icon material-icons ">place</span> Google 地图 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="general-maps.html" title="地图">一般地图</a></li>-->
<!--                        <li><a href="advanced-maps.html" title="地图">进阶地图</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!---->
<!--            <label title="Applications and Pages"><span>应用程序和页面</span></label>-->
            <ul>
<!--                <li>-->
<!--                       <a href="#" title="电子商务"><span class="nav-icon material-icons ">shopping_cart</span> 电子商务 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="ecommerce-dashboard.html" title="仪表板">仪表板</a></li>-->
<!--                        <li><a href="ecommerce-orders.html" title="命令">命令</a></li>-->
<!--                        <li><a href="ecommerce-products.html" title="产品展示">产品展示</a></li>-->
<!--                        <li><a href="ecommerce-customers.html" title="顾客">顾客</a></li>-->
<!---->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" title=""><span class="nav-icon material-icons ">widgets</span> 应用程序 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="mailbox.html" title="邮箱">邮箱</a></li>-->
<!--                        <li><a href="messages.html" title="留言内容">留言内容</a></li>-->
<!--                        <li><a href="task-manager.html" title="任务管理器">任务管理器</a></li>-->
<!--                        <li><a href="notes.html" title="笔记">笔记</a></li>-->
<!--                        <li><a href="calendar.html" title="日历">日历</a></li>-->
<!--                        <li><a href="photos-videos.html" title="照片和视频">照片和视频</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li ><a href="#" title="博客"><span class="nav-icon material-icons">comment</span> 博客 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="blogger-feed-list.html" title="Feed List">咨询提供清单</a></li>-->
<!--                        <li><a href="blogger-post.html" title="Post">发布</a></li>-->
<!--                        <li><a href="blogger-add-post.html" title="Add Post">添加帖子</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li ><a href="#" title="通用页面"><span class="nav-icon material-icons">school</span> 通用页面 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="http://cosmoadmin.com/" target="_blank" title="登录页面">登录页面</a></li>-->
<!--                        <li><a href="timeline.html" title="时间线">时间线</a></li>-->
<!--                        <li><a href="profile.html" title="轮廓">轮廓</a></li>-->
<!--                        <li><a href="invoice.html" title="发票">发票</a></li>-->
<!--                        <li><a href="search.html" title="搜索">搜索</a></li>-->
<!--                        <li><a href="faq.html" title="常见问题">常见问题</a></li>-->
<!--                        <li><a href="about-us.html" title="关于我们">关于我们</a></li>-->
<!--                        <li><a href="conatct-us.html" title="联系我们">联系我们</a></li>-->
<!--                        <li><a href="full-screen.html" title="全屏">全屏</a></li>-->
<!--                        <li><a href="blank-page.html" title="空白页">空白页</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li ><a href="#" title="系统页面"><span class="nav-icon material-icons">settings</span> 系统页面 <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a>-->
<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="sign-in.html" title="登入">登入</a></li>-->
<!--                        <li><a href="sign-up.html" title="注册">注册</a></li>-->
<!--                        <li><a href="coming-soon.html" title="快来了">快来了</a></li>-->
<!--                        <li><a href="404-page.html" title="404 页">404 页</a></li>-->
<!--                        <li><a href="500-page.html" title="500 页">500 页</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!--<li class="notification alert-notify"><a href="#"><span class="nav-icon material-icons">question_answer</span> Forms <span class="toogle-sub-nav material-icons">keyboard_arrow_right</span></a></li>-->
            </ul>
<!---->
<!--            <label title="Knowlage Center"><span>Knowlage Center</span></label>-->
<!--            <ul>-->
<!--                <li><a href="documentation.html" title="Documentation"><span class="nav-icon material-icons">school</span> Documentation</a></li>-->
<!--                <li><a target="_blank" href="https://themeforest.net/item/cosmo-bootstrap-4-responsive-admin-dashboard-template/22392885/support" title="Help & Support"><span class="nav-icon material-icons">help</span> Help &amp; Support</a></li>-->
<!--                <li><a href="utilities.html" title="Utilities"><span class="nav-icon material-icons">build</span> Utilities</a></li>-->
<!---->
<!--            </ul>-->
        </nav>

    </aside>



    <!--RIGHT CONTENT AREA-->
    <div class="content-area">

        <header class="header sticky-top">
            <nav class="navbar navbar-light bg-white px-sm-4 ">
                <a class="navbar-brand py-2 d-md-none  m-0 material-icons toggle-sidebar" href="#">menu</a>
                <ul class="navbar-nav flex-row ml-auto">
<!--                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Switch Application">-->
<!--                        <a data-toggle="modal" href="#" data-target="#switchApp" class="nav-link"><span class="material-icons align-middle">apps</span></a>-->
<!--                    </li>-->
<!--                    <li class="nav-item notification" >-->
<!--                        <a href="#" id="notificationDropdown" data-toggle="dropdown" class="nav-link"><span class="material-icons align-middle">notifications_none</span></a>-->
<!--                        <div class="dropdown-menu p-0 dropdown-lg notificationDropdown dropdown-menu-right" aria-labelledby="notificationDropdown">-->
<!---->
<!--                            <a class="dropdown-item py-3 border-bottom" href="#">-->
<!--                                <p class="text-muted mb-1"><small>John Doe Application</small></p>-->
<!--                                <div class="progress" style="height:8px;">-->
<!--                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item py-3 border-bottom" href="#">-->
<!--                                <p class="text-muted mb-1"><small>Akshay Application</small></p>-->
<!--                                <div class="progress" style="height:8px;">-->
<!--                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item whitespace-normal py-3 border-bottom" href="#">-->
<!--                                <div class="media">-->
<!--                                    <img class="mr-3 rounded" width="26" src="assets/images/user.png" >-->
<!--                                    <div class="media-body">-->
<!--                                        <h6 class="m-0 weight-400">Media heading</h6>-->
<!--                                        <small class="text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.</small>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </a>-->
<!---->
<!--                            <a class="dropdown-item py-3 border-bottom" href="#">-->
<!--                                <p class="text-muted mb-1"><small>Uploading Documents</small></p>-->
<!--                                <div class="progress" style="height:8px;">-->
<!--                                    <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 40%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item py-3 border-bottom" href="#">-->
<!--                                <span class="badge badge-pill badge-danger mr-2">Warning</span> <small class="text-muted">Somthing went wrong !</small>-->
<!--                            </a>-->
<!--                            <button type="button" class="btn btn-light btn-sm btn-block">View All</button>-->
<!--                        </div>-->
<!--                    </li>-->
                    <li class="nav-item ml-sm-3 user-logedin dropdown">
                        <a href="#" id="userLogedinDropdown" data-toggle="dropdown" class="nav-link weight-400 dropdown-toggle">
<!--                            <img src="assets/images/user.png" class="mr-2 rounded" width="28">-->
                            <?php echo $_SESSION['user'];?></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userLogedinDropdown">
                            <a class="dropdown-item" href="../index.php">返回前台</a>
<!--                            <a class="dropdown-item" href="profile.html">Account Settings</a>-->
<!--                            <a class="dropdown-item" target="_blank" href="https://themeforest.net/item/brio-web-app-bootstrap-admin-template-dashboard/9529051/support">Help & Support</a>-->
                            <div class="dropdown-divider"></div>
                            <p id="logout" class="dropdown-item" >退出登录</p>
                        </div>
                    </li>

                </ul>
            </nav>
        </header>

        <script>
            $(document).ready(function () {
                $(".navigation").children().eq(0).addClass('active')
                $('#logout').on('click', function () {
                    $.ajax({
                        url: '../core/Logout.php',
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