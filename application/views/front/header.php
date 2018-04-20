<section id="header" class="header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <ul class="flat-infomation">
                        <li class="phone">
                            Call Us: <a href="#" title="">(012)68104648</a>
                        </li>
                    </ul><!-- /.flat-infomation -->
                </div><!-- /.col-md-4 -->

                <div class="col-md-2">
                    <?php if(!isset($user_id_login)): ?>
                    <ul class="flat-support">
                        <li>
                            <a href="<?php echo base_url('user/login'); ?>" title="">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('user/register'); ?>" title="">Register</a>
                        </li>
                    </ul><!-- /.flat-support -->
                    <?php else: ?>
                        <ul class="flat-unstyled">
                            <li class="account">
                                <a href="#" title="">My Account<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="unstyled">
                                    <li>
                                        <a href="<?php echo base_url('user/edit'); ?>" title="">My Account</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('user/transaction'); ?>" title="">Đơn hàng</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('user/edit'); ?>" title="">Sửa thông tin cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('user/logout'); ?>" title="">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul><!-- /.flat-unstyled -->
                    <?php endif; ?>
                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.header-top -->
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div id="logo" class="logo">
                        <a href="<?php echo base_url(); ?>" title="">
                            <img src="<?php echo public_url()?>/front/images/logos/logo.png" alt="">
                        </a>
                    </div><!-- /#logo -->
                </div><!-- /.col-md-3 -->
                <div class="col-md-6">
                    <div class="top-search">
                        <form action="<?php echo base_url('product/search'); ?>" method="get" class="form-search" accept-charset="utf-8">
                            <div class="box-search">
                                <input type="text" id="text_search" name="search" placeholder="Search what you looking for ?" value="<?php echo isset($key) ? $key : '' ?>">
                                <span class="btn-search">
											<button type="submit" class="waves-effect"><img src="<?php echo public_url()?>/front/images/icons/search.png" alt=""></button>
										</span>
                            </div><!-- /.box-search -->
                        </form><!-- /.form-search -->
						<div id="txtAllowSearch"></div>
                    </div><!-- /.top-search -->
                </div><!-- /.col-md-6 -->
                <div class="col-md-3">
                    <div class="box-cart">
                        <div class="inner-box">
                            <a href="#" title="">
                                <div class="icon-cart">
                                    <img src="<?php echo public_url()?>/front/images/icons/cart.png" alt="">
                                    <span><?php echo $total_cart; ?></span>
                                </div>
                                <div class="price">
                                    <?php echo number_format($amount_cart); ?> đ
                                </div>
                            </a>
                            <div class="dropdown-box">
                                <ul>
                                    <?php foreach ($carts as $cart): ?>
                                    <li>
                                        <div class="img-product">
                                            <img src="<?php echo base_url('upload/product/'.$cart['image_link']);?>" alt="">
                                        </div>
                                        <div class="info-product">
                                            <div class="name">
                                                <?php echo $cart['name']; ?>
                                            </div>
                                            <div class="price">
                                                <span><?php echo $cart['qty']; ?> x</span>
                                                <span><?php echo number_format($cart['price']); ?> đ</span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <span class="delete"><a href="<?php echo base_url('cart/delete/'.$cart['id']) ?>" >x</a></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="total">
                                    <span>Subtotal:</span>
                                    <span class="price"><?php echo number_format($amount_cart); ?> đ</span>
                                </div>
                                <div class="btn-cart">
                                    <a href="<?php echo base_url('cart'); ?>" class="view-cart" title="">View Cart</a>
                                    <a href="<?php echo base_url('order/checkout'); ?>" class="check-out" title="">Checkout</a>
                                </div>
                            </div>
                        </div><!-- /.inner-box -->
                    </div><!-- /.box-cart -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.header-middle -->
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-2">
                    <?php $this->load->view('front/category', $this->data); ?>
                </div><!-- /.col-md-3 -->
                <div class="col-md-9 col-10">
                    <div class="nav-wrap">
                        <div id="mainnav" class="mainnav">
                            <ul class="menu">
                                <li class="column-1">
                                    <a href="<?php echo base_url() ?>" title="">Home</a>
                                </li><!-- /.column-1 -->
                                <li class="column-1">
                                    <a href="shop.html" title="">Shop</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="shop.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop left sidebar</a>
                                        </li>
                                        <li>
                                            <a href="shop-v2.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop right sidebar</a>
                                        </li>
                                        <li>
                                            <a href="shop-v3.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop list view</a>
                                        </li>
                                        <li>
                                            <a href="shop-v4.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop full width</a>
                                        </li>
                                        <li>
                                            <a href="shop-v5.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop 03 column</a>
                                        </li>
                                        <li>
                                            <a href="shop-cart.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop cart</a>
                                        </li>
                                        <li>
                                            <a href="shop-checkout.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Shop checkout</a>
                                        </li>
                                    </ul><!-- /.submenu -->
                                </li><!-- /.column-1 -->
                                <li class="column-1">
                                    <a href="#" title="">Features</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Home Theater Systems</a>
                                        </li>
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Receivers & Amplifiers</a>
                                        </li>
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Speakers</a>
                                        </li>
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>CD Players & Turntables</a>
                                        </li>
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>High-Resolution Audio</a>
                                        </li>
                                        <li>
                                            <a href="#" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>4K Ultra HD TVs</a>
                                        </li>
                                    </ul><!-- /.submenu -->
                                </li><!-- /.column-1 -->
                                <li class="has-mega-menu">
                                    <a href="#" title="">Electronic</a>
                                    <div class="submenu">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12">
                                                <h3 class="cat-title">Accessories</h3>
                                                <ul class="submenu-child">
                                                    <li>
                                                        <a href="#" title="">Electronics</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Furniture</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Accessories</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Divided</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Everyday Fashion</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Modern Classic</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Party</a>
                                                    </li>
                                                </ul>
                                                <div class="show">
                                                    <a href="#" title="">Shop All</a>
                                                </div>
                                            </div><!-- /.col-lg-3 col-md-12 -->
                                            <div class="col-lg-3 col-md-12">
                                                <h3 class="cat-title">Laptop And Computer</h3>
                                                <ul class="submenu-child">
                                                    <li>
                                                        <a href="#" title="">Networking & Internet Devices</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Laptops, Desktops & Monitors</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Hard Drives & Memory Cards</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Printers & Ink</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Networking & Internet Devices</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Computer Accessories</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Software</a>
                                                    </li>
                                                </ul>
                                                <div class="show">
                                                    <a href="#" title="">Shop All</a>
                                                </div>
                                            </div><!-- /.col-lg-3 col-md-12 -->
                                            <div class="col-lg-4 col-md-12">
                                                <h3 class="cat-title">Audio & Video</h3>
                                                <ul class="submenu-child">
                                                    <li>
                                                        <a href="#" title="">Headphones & Speakers</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Home Entertainment Systems</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">MP3 & Media Players</a>
                                                    </li>
                                                </ul>
                                                <div class="show">
                                                    <a href="#" title="">Shop All</a>
                                                </div>
                                            </div><!-- /.col-lg-4 col-md-12 -->
                                            <div class="col-lg-2 col-md-12">
                                                <h3 class="cat-title">Home Audio</h3>
                                                <ul class="submenu-child">
                                                    <li>
                                                        <a href="#" title="">Home Theater Systems</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Receivers & Amplifiers</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">Speakers</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">CD Players & Turntables</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">High-Resolution Audio</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="">4K Ultra HD TVs</a>
                                                    </li>
                                                </ul>
                                                <div class="show">
                                                    <a href="#" title="">Shop All</a>
                                                </div>
                                            </div><!-- /.col-lg-2 col-md-12 -->
                                        </div><!-- /.row -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="banner-box">
                                                    <div class="inner-box">
                                                        <a href="#" title="">
                                                            <img src="<?php echo public_url()?>/front/images/banner_boxes/submenu-01.png" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="banner-box">
                                                    <div class="inner-box">
                                                        <a href="#" title="">
                                                            <img src="<?php echo public_url()?>/front/images/banner_boxes/submenu-02.png" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.submenu -->
                                </li><!-- /.has-mega-menu -->
                                <li class="column-1">
                                    <a href="#" title="">Pages</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="about.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>About</a>
                                        </li>
                                        <li>
                                            <a href="404.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>404 Page</a>
                                        </li>
                                        <li>
                                            <a href="brands.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Brands Page</a>
                                        </li>
                                        <li>
                                            <a href="categories.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Categories 01</a>
                                        </li>
                                        <li>
                                            <a href="categories-v2.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Categories 02</a>
                                        </li>
                                        <li>
                                            <a href="element.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Element</a>
                                        </li>
                                        <li>
                                            <a href="faq.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>FAQ</a>
                                        </li>
                                        <li>
                                            <a href="order-tracking.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Order Tracking</a>
                                        </li>
                                        <li>
                                            <a href="term-condition.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Terms & Conditions</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product 01</a>
                                        </li>
                                        <li>
                                            <a href="single-product-v2.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product 02</a>
                                        </li>
                                        <li>
                                            <a href="single-product-v3.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product 03</a>
                                        </li>
                                        <li>
                                            <a href="single-product-v4.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product 04</a>
                                        </li>
                                        <li>
                                            <a href="single-product-v5.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product 05</a>
                                        </li>
                                    </ul><!-- /.submenu -->
                                </li><!-- /.column-1 -->
                                <li class="column-1">
                                    <a href="blog.html" title="">Blog</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="blog.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog left sidebar</a>
                                        </li>
                                        <li>
                                            <a href="blog-v2.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog right sidebar</a>
                                        </li>
                                        <li>
                                            <a href="blog-v3.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog list</a>
                                        </li>
                                        <li>
                                            <a href="blog-v4.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog 02 column</a>
                                        </li>
                                        <li>
                                            <a href="blog-v5.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog full width</a>
                                        </li>
                                        <li>
                                            <a href="blog-single.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Blog single</a>
                                        </li>
                                    </ul><!-- /.submenu -->
                                </li><!-- /.column-1 -->
                                <li class="column-1">
                                    <a href="contact.html" title="">Contact</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="contact.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Contact 01</a>
                                        </li>
                                        <li>
                                            <a href="contact-v2.html" title=""><i class="fa fa-angle-right" aria-hidden="true"></i>Contact 02</a>
                                        </li>
                                    </ul><!-- /.submenu -->
                                </li><!-- /.column-1 -->
                            </ul><!-- /.menu -->
                        </div><!-- /.mainnav -->
                    </div><!-- /.nav-wrap -->
                    <?php if(isset($user_id_login)): ?>
                    <div class="today-deal">
                        <span>Chào,</span> <a href="<?php echo base_url('user/edit') ?>" title=""><?php echo $user_info->name ?></a>
                    </div><!-- /.today-deal -->
                    <?php endif; ?>
                    <div class="btn-menu">
                        <span></span>
                    </div><!-- //mobile menu button -->
                </div><!-- /.col-md-9 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.header-bottom -->
</section><!-- /#header -->