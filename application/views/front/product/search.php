<section class="flat-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li class="trail-item">
                        <a href="<?php echo base_url() ?>" title="">Home</a>
                        <span><img src="<?php echo public_url()?>front/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title="">Search</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<main id="shop" class="style2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-shop">
                    <div class="wrap-imagebox">
                        <div class="flat-row-title style4">
                            <h3>Kết quả tìm kiếm cho: <b><?php echo $key ?></b></h3>
                            <span>
										Showing 1–15 of 20 results
									</span>
                            <div class="clearfix"></div>
                        </div><!-- /.flat-row-title style4 -->
                        <div class="sort-product style1">
                            <ul class="icons">
                                <li>
                                    <img src="<?php echo public_url()?>front/images/icons/list-1.png" alt="">
                                </li>
                                <li>
                                    <img src="<?php echo public_url()?>front/images/icons/list-2.png" alt="">
                                </li>
                            </ul><!-- /.icons -->
                            <div class="clearfix"></div>
                        </div><!-- /.sort-product style1 -->
                        <div class="row">
                            <?php foreach ($list as $product): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="product-box">
                                    <div class="imagebox">
                                        <?php $image_list = $product->image_list != NULL ? json_decode($product->image_list->load()) : NULL;?>
                                        <div class="box-image <?php if(is_array($image_list)):?> owl-carousel-1 <?php endif;?>">
                                            <div class="image">
                                                <a href="<?php echo base_url('product/detail/'.$product->id)?>" title="">
                                                    <img src="<?php echo base_url('upload/product/'.$product->image_link);?>" alt="">
                                                </a>
                                            </div>
                                            <?php if(is_array($image_list)):?>
                                            <?php foreach ($image_list as $img):?>
                                                    <div class="image">
                                                        <a href="#" title="">
                                                            <img src="<?php echo base_url('upload/product/'.$img)?>" alt="">
                                                        </a>
                                                    </div>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </div><!-- /.box-image -->
                                        <div class="box-content">
                                            <div class="cat-name">
                                                <a href="#" title="">Category</a>
                                            </div>
                                            <div class="product-name">
                                                <a href="<?php echo base_url('product/detail/'.$product->id)?>" title=""><?php echo $product->name; ?></a>
                                            </div>
                                            <div class="price">
                                                <<?php if($product->discount > 0):?>
                                                    <?php $price_new = $product->price - $product->discount;?>
                                                    <span class="sale"><?php echo number_format($price_new)?>đ</span>
                                                    <span class="regular"><?php echo number_format($product->price); ?>đ</span>
                                                <?php else: ?>
                                                    <span class="sale"><?php echo number_format($product->price)?>đ</span>
                                                <?php endif; ?>
                                            </div>
                                        </div><!-- /.box-content -->
                                        <div class="box-bottom">
                                            <div class="btn-add-cart">
                                                <a href="<?php echo base_url('cart/add/'.$product->id) ?>" title="">
                                                    <img src="<?php echo public_url()?>/front/images/icons/add-cart.png" alt="">Add to Cart
                                                </a>
                                            </div>
                                            <div class="compare-wishlist">
                                                <a href="#" class="compare" title="">
                                                    <img src="<?php echo public_url()?>/front/images/icons/compare.png" alt="">Compare
                                                </a>
                                                <a href="#" class="wishlist" title="">
                                                    <img src="<?php echo public_url()?>/front/images/icons/wishlist.png" alt="">Wishlist
                                                </a>
                                            </div>
                                        </div><!-- /.box-bottom -->
                                    </div><!-- /.imagebox -->
                                </div><!-- /.product-box -->
                            </div><!-- /.col-lg-3 col-md-4 col-sm-6 -->
                            <?php endforeach; ?>
                        </div><!-- /.row -->
                    </div><!-- /.wrap-imagebox -->
                </div><!-- /.main-shop -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</main><!-- /#shop -->
