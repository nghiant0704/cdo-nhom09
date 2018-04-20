<section class="flat-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li class="trail-item">
                        <a href="<?php echo base_url() ?>" title="">Home</a>
                        <span><img src="<?php echo public_url()?>front/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-item">
                        <a href="#" title="">Shop</a>
                        <span><img src="<?php echo public_url()?>front/images/icons/arrow-right.png" alt=""></span>
                    </li>
                    <li class="trail-end">
                        <a href="#" title=""><?php echo $pdcategory->name; ?></a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="flat-product-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="flexslider">
                    <ul class="slides">
                        <li data-thumb="<?php echo base_url('upload/product/'.$product->image_link);?>">
                            <img src="<?php echo base_url('upload/product/'.$product->image_link);?>" alt="image slider" />
                            <span>NEW</span>
                        </li>
                        <?php $image_list = $product->image_list != NULL ? json_decode($product->image_list->load()) : NULL;?>
                        <?php if(is_array($image_list)):?>
                            <?php foreach ($image_list as $img):?>
                                <li data-thumb="<?php echo base_url('upload/product/'.$img)?>">
                                    <img src="<?php echo base_url('upload/product/'.$img)?>" alt="image slider" />
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul><!-- /.slides -->
                </div><!-- /.flexslider -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="product-detail">
                    <div class="header-detail">
                        <h4 class="name"><?php echo $product->name; ?></h4>
                        <div class="category">
                            <?php echo $pdcategory->name; ?>
                        </div>
                        <div class="reviewed">
                            <div class="review">
                                <div class="queue">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                                <div class="text">
                                    <span><?php echo count($comments) ?> Reviews</span>
                                    <span class="add-review">Add Your Review</span>
                                </div>
                            </div><!-- /.review -->
                            <?php if($product->warranty != ''): ?>
                            <div class="status-product">
                                Bảo hành <span><?php echo $product->warranty; ?></span>
                            </div>
                            <?php endif; ?>
                        </div><!-- /.reviewed -->
                    </div><!-- /.header-detail -->
                    <div class="content-detail">
                        <div class="price">
                            <?php if($product->discount > 0):?>
                            <?php $price_new = $product->price - $product->discount;?>
                            <div class="regular">
                                <?php echo number_format($product->price); ?> đ
                            </div>
                            <div class="sale">
                                <?php echo number_format($price_new)?> đ
                            </div>
                            <?php else: ?>
                                <div class="sale">
                                    <?php echo number_format($product->price)?> đ
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="info-text">
                            <?php echo $product->content != NULL ? $product->content->load() : ''; ?>
                        </div>
                        <?php if($product->gifts != ''): ?>
                        <div class="product-id">
                            Quà tặng: <span class="id"><?php echo $product->gifts; ?></span>
                        </div>
                        <?php endif; ?>
                    </div><!-- /.content-detail -->
                    <div class="footer-detail">
                        <div class="box-cart style2">
                            <div class="btn-add-cart">
                                <a href="<?php echo base_url('cart/add/'.$product->id) ?>" title=""><img src="<?php echo public_url()?>front/images/icons/add-cart.png" alt="">Add to Cart</a>
                            </div>
                            <div class="compare-wishlist">
                                <a href="#" class="compare" title=""><img src="<?php echo public_url()?>front/images/icons/compare.png" alt="">Compare</a>
                                <a href="#" class="wishlist" title=""><img src="<?php echo public_url()?>front/images/icons/wishlist.png" alt="">Wishlist</a>
                            </div>
                        </div><!-- /.box-cart -->
                        <div class="social-single">
                            <span>SHARE</span>
                            <ul class="social-list style2">
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-pinterest" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-dribbble" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="fa fa-google" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul><!-- /.social-list -->
                        </div><!-- /.social-single -->
                    </div><!-- /.footer-detail -->
                </div><!-- /.product-detail -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-product-detail -->

<section class="flat-product-content">
    <ul class="product-detail-bar">
        <li class="active">Video</li>
        <li>Reviews</li>
    </ul><!-- /.product-detail-bar -->
    <div class="container">
        <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-9">
                <iframe width="600" height="400"
                        src="<?php echo $product->video ?>">
                </iframe>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
            <?php if(isset($user_id_login)): ?>
            <div class="col-md-8">
                <div class="form-review">
                    <div class="title">
                        Add a review
                    </div>
                    <form action="<?php echo base_url('product/comment') ?>" method="post" accept-charset="utf-8">
                        <div class="review-form-name">
                            <label>Tên</label>
                            <input type="text" name="name" value="<?php echo $user_info->name; ?>" placeholder="Name">
                        </div>
                        <div class="review-form-email">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $user_info->email; ?>" placeholder="Email">
                        </div>
                        <div class="review-form-comment">
                            <textarea name="review-text" placeholder="Nhập nội dung review"></textarea>
                        </div>
                        <input type="hidden" name="pd_id" value="<?php echo $product->id; ?>">
                        <div class="btn-submit">
                            <button type="submit">Add Review</button>
                        </div>
                    </form>
                </div><!-- /.form-review -->
            </div><!-- /.col-md-6 -->
            <?php else: ?>
            <div class="box-checkout">
                <div class="checkout-login">
                        Bạn cần <a href="<?php echo base_url('user/login') ?>" title="">Đăng nhập</a> để thêm Review
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12">
                <ul class="review-list">
                    <?php foreach ($comments as $comment): ?>
                    <li>
                        <div class="review-metadata">
                            <div class="name">
                                <?php echo $comment->user_name; ?> : <span><?php echo $comment->created; ?></span>
                            </div>
                            <div class="queue">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div><!-- /.review-metadata -->
                        <div class="review-content">
                            <p>
                                <?php echo $comment->content != NULL ? $comment->content->load() : ''; ?>
                            </p>
                        </div><!-- /.review-content -->
                    </li>
                    <?php endforeach; ?>
                </ul><!-- /.review-list -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-product-content -->


