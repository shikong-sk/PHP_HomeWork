<!--== Start Page Breadcrumb ==-->
<div class="page-breadcrumb-wrap" style="margin-top: -25px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-breadcrumb">
                    <ul class="nav">
                        <li><a href="index.php">首页</a></li>
                        <li><a href="shop.php">商品</a></li>
                        <li><a href="#" class="active"><?php echo $r['productName']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== End Page Breadcrumb ==-->

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <!-- Single Product Page Content Start -->
            <div class="col-lg-12">
                <div class="single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5">
                            <div class="product-thumbnail-wrap tab-style-top">
                                <div class="product-thumb-carousel owl-carousel">
                                    <?php
                                    $dir = './images/product/' . $_GET['pid'];
                                    $res = scandir($dir);
                                    $res = array_diff($res, Array('.', '..', 'img.jpg'));
                                    foreach ($res as $data) {
                                        $data = iconv('gbk', 'utf-8', $data);
                                        echo "                                    <div class=\"single-thumb-item\">
                                        <a href=\"#\"><img class=\"img-fluid\"
                                                                           src=\"".$dir.'/'.$data."\"
                                                                           alt=\"Product\"/></a>
                                    </div>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7">
                            <div class="product-details">
                                <script>
                                    document.title += " - <?php echo $r['productName']; ?>";
                                </script>
                                <h2><?php echo $r['productName']; ?><br>
                                    <!--                                <h5 style="color: #aaa;">2K+90Hz流体屏，高通骁龙 855 Plus，超广角三摄</h5>-->

                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <span class="price"><?php echo $r['Price']; ?></span>

                                    <div class="product-info-stock-sku">
                                        <?php
                                        if ($r['productNum'] > 0) {
                                            echo '<span class="product-stock-status text-success">有货</span>';
                                        } else {
                                            echo '<span class="product-stock-status text-danger">缺货</span>';
                                        }
                                        echo '<span class="product-sku-status"><strong>库存：' . $r['productNum'] . '</strong></span>';
                                        ?>

                                        <!--                                    <a href="#"  style="color:red; border:1px solid; border-color: red;border-radius: 5px;">满1000减30</a>-->
                                        <!--                                    <a href="#"  style="color:red; border:1px solid; border-color: red;border-radius: 5px;">满2000减80</a>-->
                                        <!--                                    <a href="#"  style="color:red; border:1px solid; border-color: red;border-radius: 5px;">满3000减100</a>-->
                                    </div>

                                    <p class="products-desc" style="font-weight: 100;font-size: 1.6rem;">
                                        <?php
                                        echo $r["description"];
                                        ?>
                                    </p>

                                    <div class="shopping-option-item d-sm-none d-md-block">
                                        <h4>选择颜色</h4>
                                        <ul class="color-option-select d-flex">
                                            <li class="color-item black">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">幻夜黑</span>
                                                </div>
                                            </li>

                                            <li class="color-item green">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">翡翠绿</span>
                                                </div>
                                            </li>

                                            <li class="color-item red">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">密语红</span>
                                                </div>
                                            </li>

                                            <li class="color-item yellow">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">尊贵金</span>
                                                </div>
                                            </li>

                                            <li class="color-item orange">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">丹霞橙</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="quantity-field">
                                            <label for="qty">数量</label>
                                            <input type="number" id="qty" min="1" value="1"/>
                                        </div>

                                        <a href="<?php
                                        if (isset($_SESSION['user'])) {
                                            echo "#";
                                        } else {
                                            echo './login.php';
                                        }
                                        ?>" class="btn btn-cart-large"><i class="fa fa-shopping-cart"></i> 加入购物车</a>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $('.btn-cart-large[href="#"]').click(function () {
                                                $.ajax({
                                                    url: './cart.php',
                                                    type: 'POST',
                                                    data: {
                                                        'pid': "<?php echo $r['productID']; ?>",
                                                        'num': $('#qty').val()
                                                    },
                                                    async: false,
                                                    success: function (data) {
                                                        if ('Error' in data) {
                                                            alert(data['Error'])
                                                        } else {
                                                            contain = ''
                                                            for (x in data) {
                                                                contain += data[x]
                                                            }
                                                            alert(contain)
                                                            location.reload()
                                                        }

                                                    },
                                                })
                                            })
                                        })
                                    </script>
                                    <div class="product-btn-group">
                                        <a href="wishlist.html" class="btn btn-round btn-cart"><i
                                                    class="fa fa-star-o"></i></a>
                                        <a href="compare.html" class="btn btn-round btn-cart"><i
                                                    class="fa fa-smile-o"></i></a>
                                        <a href="single-product-gruop.html" class="btn btn-round btn-cart"><i
                                                    class="fa fa-share-alt"></i></a>
                                    </div>
                            </div>
                        </div>
                        <!-- Product Details End -->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Product Full Description Start -->
                            <div class="product-full-info-reviews">
                                <!-- Single Product tab Menu -->
                                <nav class="nav" id="nav-tab">
                                    <a class="active" id="description-tab" data-toggle="tab" href="#description">参数</a>
                                    <a id="reviews-tab" data-toggle="tab" href="#reviews">评价</a>
                                </nav>
                                <!-- Single Product tab Menu -->

                                <!-- Single Product tab Content -->
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="description">
                                        <?php echo $r['parameter']; ?>
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="product-ratting-wrap">
                                                    <div class="pro-avg-ratting">
                                                        <h4>4.5</h4>
                                                        <span>近期评论</span>
                                                    </div>
                                                    <div class="ratting-list">
                                                        <div class="sin-list float-left">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <span>(5)</span>
                                                        </div>
                                                        <div class="sin-list float-left">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <span>(3)</span>
                                                        </div>
                                                        <div class="sin-list float-left">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <span>(1)</span>
                                                        </div>
                                                        <div class="sin-list float-left">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <span>(0)</span>
                                                        </div>
                                                    </div>
                                                    <div class="rattings-wrapper">

                                                        <div class="sin-rattings">
                                                            <div class="ratting-author">
                                                                <h3>出水芙蓉+微qwx5207801</h3>
                                                                <div class="ratting-star">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <span>(5)</span>
                                                                </div>
                                                            </div>
                                                            <p>性价比高，性能优秀，颜色外观设计时尚美观，必须买。我已经预订好了，就等着到货使用，真实期待呢</p>
                                                        </div>

                                                        <div class="sin-rattings">
                                                            <div class="ratting-author">
                                                                <h3>凯皇牛逼丶</h3>
                                                                <div class="ratting-star">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <span>(5)</span>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                性价比跟性能成正比，2k90hz的刷新率，无可挑剔，但是任何东西多没有完美的，他的缺点就是厚，8.8毫米的厚度，让人看上去有点笨拙的感觉</p>
                                                        </div>

                                                        <div class="sin-rattings">
                                                            <div class="ratting-author">
                                                                <h3>薛之谦丶不羡仙</h3>
                                                                <div class="ratting-star">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <span>(5)</span>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                外形外观：外观和一加7Pro一样多个激光感光器，外观很精致和三星有的一比屏幕音效：按上电源锁屏时候，有一声很清脆类似于的响指声，听的很有感觉！拍照效果：这款比一加七Pro多了视频防抖和镜头微距功能，提升还可以。拍照效果比华为荣耀要好，但是比起三星旗舰和华为旗舰还是差了那么一丢丢。综合来说这手机拍照效果加上手机软件及屏幕显示加持下拍的图片挺不错的。运行速度：运行速度很快，加上H2OS系统的加持，够我们这些资深安卓老玩家养老退烧了。待机时间：一天上班十个小时左右的话基本够用了，刷下~，玩下吃鸡，看下头条基本顶的住。其他特色：特色其实怎么说了，我买的时候，其实就是图个屏，毕竟天天在看嘛，屏做的好，看的舒服，享受。我以前是三星的真粉，三星手机做的还可以，就是性价比低了一点。?荷包紧啊，能省一点算一点。手机嘛，革新换代太快了，哪天这款一加5G出来了，搞不好被我拿去置换了</p>
                                                        </div>

                                                    </div>
                                                    <div class="ratting-form-wrapper">
                                                        <h3>加入点评</h3>
                                                        <form action="#" method="post">
                                                            <div class="ratting-form row">
                                                                <div class="col-12 mb-4">
                                                                    <h5>评级:</h5>
                                                                    <div class="ratting-star fix">
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12 mb-4">
                                                                    <label for="name">用户名:</label>
                                                                    <input id="name" placeholder="Name" type="text">
                                                                </div>
                                                                <div class="col-md-6 col-12 mb-4">
                                                                    <label for="email">邮箱:</label>
                                                                    <input id="email" placeholder="Email" type="text">
                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                    <label for="your-review">你的点评:</label>
                                                                    <textarea name="review" id="your-review"
                                                                              placeholder="Write a review"></textarea>
                                                                </div>
                                                                <div class="col-12">

                                                                    <input value="评论" type="submit">

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product tab Content -->
                            </div>
                            <!-- Product Full Description End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Product Page Content End -->
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->