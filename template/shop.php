<?php
require_once '../core/core.php';

$json = Array();

$shop_table = 'shop';

if(isset($_POST['search']) && $_POST['search']!='' )
{
    $shop_sql = "select * from $dbname.$shop_table where productName Like '%".$_POST['search']."%'";
}
else
{
    $shop_sql = "select * from $dbname.$shop_table";
}
$resNum = "select count(*) as resNum from (${shop_sql}) num";
$resNum = $database->query($resNum)->fetch_assoc();
$resNum = $resNum['resNum'];
$pageRow = 12;
$maxPage = (int)ceil($resNum / $pageRow);
array_push($json, $maxPage);
$contain = '';
if (isset($_POST['pageNum'])) {
    $page = $_POST['pageNum'];
} else {
    $page = 1;
}
$page = strval((intval($page) - 1) * $pageRow);
$shop_sql = $shop_sql . " limit $page,$pageRow";
$res = $database->query($shop_sql);
if ($res->num_rows > 0) {
    $r = $res->fetch_assoc();
    mysqli_data_seek($res, 0);
    while ($r = $res->fetch_assoc()) {
        $contain .=
            '<div class="col-lg-4 col-sm-6">
                                                    <div class="single-product-item">
                                                        <figure class="product-thumb">
                                                            <a href="./product.php?pid='.$r['productID'].'">
                                                                <img src="images/product/'.$r['productID'].'/img.jpg" alt="Product">
                                                            </a>
                                                            <a href="#" class="btn btn-round btn-cart" title="Quick View" data-toggle="modal" data-target="#P_' . $r['productID'] . '">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </figure>
                                                        <div class="product-details">
                                                            <h2 class="product-title">
                                                                <a href="./product.php?pid='.$r['productID'].'">
                                                                ' . $r['productName'] . '
                                                                </a>
                                                            </h2>
                                                            <div class="rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <span class="product-price">' . $r['Price'] . '</span>
                                                            <p class="pro-desc">
                                                                ' . $r['description'] . '
                                                            </p>

<!--
                                                        <div class="product-meta">
                                                            <a href="#" class="btn btn-round btn-cart" title="添加到购物车">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>
                                                            <a href="wishlist.html" class="btn btn-round btn-cart" title="添加到收藏">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                            <a href="compare.html" class="btn btn-round btn-cart" title="添加到对比">
                                                                <i class="fa fa-exchange"></i>
                                                            </a>
                                                        </div>
                                                        -->
                                                    </div>
                                                </div>
                                            </div>';

        $contain .=
            '                                <!--== Product Quick View Modal Area Wrap ==-->
                                <div class="modal quickView" id="P_' . $r['productID'] . '" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 5%;right: 5%;">
                                                <span aria-hidden="true"><img src="assets/img/icons/cancel.png" alt="Close" class="img-fluid" /></span>
                                            </button>
                                            <div class="modal-body">
                                                <div class="quick-view-content single-product-page-content">
                                                    <div class="row">
                                                        <!-- Product Thumbnail Start -->
                                                        <div class="col-lg-5 col-md-6">
                                                            <div class="product-thumbnail-wrap">
                                                                <div class="product-thumb-carousel owl-carousel">';
        $dir = '../images/product/' . $r['productID'];
        $rDir = './images/product/' . $r['productID'];
        $path = '../images/product/';
//        error_reporting(-1);
        if(!is_dir($dir))
        {
            if(!is_dir($path))
            {
                mkdir($path,0777);
            }
            mkdir($dir,0777);
        }
        $rData = scandir($dir);
        $rData = array_diff($rData, Array('.', '..', 'img.jpg'));
        foreach ($rData as $data) {
            $data = iconv('gbk', 'utf-8', $data);
            $contain .= "                                    <div class=\"single-thumb-item\">
                                        <a href=\"#\"><img class=\"img-fluid\"
                                                                           src=\"".$rDir.'/'.$data."\"
                                                                           alt=\"Product\"/></a>
                                    </div>";
        }
//                                                                    <div class="single-thumb-item">
//                                                                        <a href="single-product.html"><img class="img-fluid" src="assets/img/single-pro-1.jpg" alt="Product" /></a>
//                                                                    </div>
//
//                                                                    <div class="single-thumb-item">
//                                                                        <a href="single-product.html"><img class="img-fluid" src="assets/img/single-pro-2.jpg" alt="Product" /></a>
//                                                                    </div>
//
//                                                                    <div class="single-thumb-item">
//                                                                        <a href="single-product.html"><img class="img-fluid" src="assets/img/single-pro-3.jpg" alt="Product" /></a>
//                                                                    </div>
//
//                                                                    <div class="single-thumb-item">
//                                                                        <a href="single-product.html"><img class="img-fluid" src="assets/img/single-pro-4.jpg" alt="Product" /></a>
//                                                                    </div>
                                                                $contain .= '</div>
                                                            </div>
                                                        </div>
                                                        <!-- Product Thumbnail End -->

                                                        <!-- Product Details Start -->
                                                        <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                                                            <div class="product-details">
                                                                <h2><a href="single-product.html">' . $r['productName'] . '</a></h2>

                                                                <div class="rating">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-half"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                </div>

                                                                <span class="price">' . $r['Price'] . '</span>

                                                                <div class="product-info-stock-sku">';
        if ((int)$r['productNum'] > 0) {
            $contain .= '<span class="product-stock-status text-success">有货</span>';
        } else {
            $contain .= '<span class="product-stock-status text-danger">缺货</span>';
        }
        $contain .=
            '<span class="product-sku-status ml-5" style="font-size: 14px"><strong>库存：</strong> ' . $r['productNum'] . '</span> 
                                                                </div>

                                                                <p class="products-desc">' . $r['description'] . '</p>
                                                                <div class="shopping-option-item">
                                                                    <h4>Color</h4>
                                                                    <ul class="color-option-select d-flex">
                                                                        <li class="color-item black">
                                                                            <div class="color-hvr">
                                                                                <span class="color-fill"></span>
                                                                                <span class="color-name">Black</span>
                                                                            </div>
                                                                        </li>

                                                                        <li class="color-item green">
                                                                            <div class="color-hvr">
                                                                                <span class="color-fill"></span>
                                                                                <span class="color-name">green</span>
                                                                            </div>
                                                                        </li>

                                                                        <li class="color-item orange">
                                                                            <div class="color-hvr">
                                                                                <span class="color-fill"></span>
                                                                                <span class="color-name">Orange</span>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div class="product-quantity d-flex align-items-center">
                                                                    <div class="quantity-field">
                                                                        <label for="qty">数量：</label>
                                                                        <input type="number" pid="' . $r['productID'] . '" min="1" max="100" value="1" />
                                                                    </div>

                                                                    <a href="#" pid="'.$r['productID'].'"class="btn add-cart">添加到购物车</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--== Product Quick View Modal Area End ==-->';
    }
    $contain .=
        '<script>        $(\'.product-thumb-carousel\').owlCarousel({
            loop: true,
            items: 1,
            dots: false,
            smartSpeed: 500,
            nav: true,
            navText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\'],
            thumbs: true,
            thumbImage: true,
            thumbContainerClass: \'owl-thumbs\',
            thumbItemClass: \'owl-thumb-item\'
        });</script>';
    array_push($json, $contain);
    $json = json_encode($json, JSON_UNESCAPED_UNICODE);
    header('Content-Type:application/json; charset=utf-8');
    exit($json);
}
?>