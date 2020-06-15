<?php
$men_array = [];

foreach ($product_array as $product) {
    if ($product['product_category'] == 'Men') {
        $men_array[] = $product;
    }
}




?>
<!-- Man Banner Section Begin -->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        <li class="active">Clothings</li>
                        <li>HandBag</li>
                        <li>Shoes</li>
                        <li>Accessories</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <?php foreach ($men_array as $item) : ?>
                        <div class="product-item">
                            <div class="pi-pic">
                                <a href="<?php printf('./%s?product_id=%s', 'product.php', $item['product_id']); ?>"> <img src="<?php echo $item['product_image'] ?>" alt=""></a>
                                <?php if ($item['product_price'] < 20) : ?>
                                    <div class="sale">Sale</div>
                                <?php endif; ?>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active">
                                        <form method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                            <input type="hidden" name="user_id" value="2">
                                            <a href="#" style="cursor: pointer;" onclick="this.parentNode.submit();" name="product_add_to_cart"><i class="icon_bag_alt"></i></a>
                                        </form>
                                    </li>
                                    <li class="quick-view"><a href="#">+ Quick View</a></li>
                                    
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">Coat</div>
                                <a href="#">
                                    <h5><?php echo $item['product_name'] ?></h5>
                                </a>
                                <div class="product-price">
                                    $<?php echo $item['product_price'] ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="img/products/man-large.jpg">
                    <h2>Men’s</h2>
                    <a href="./menCollection.php">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Man Banner Section End -->