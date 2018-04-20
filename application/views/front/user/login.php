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
                        <a href="#" title="">Đăng nhập</a>
                    </li>
                </ul><!-- /.breacrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section class="flat-account background">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="form-login">
                    <div class="title">
                        <h3>Login</h3>
                    </div>
                    <?php if(validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors('','<br />') ?>
                        </div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('success_msg')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('user/login')?>" method="post" id="form-login" accept-charset="utf-8">
                        <div class="form-box">
                            <label for="name-login">Email address * </label>
                            <input type="text" id="name-login" name="txtEmail" value="<?php echo set_value('txtEmail'); ?>">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="password-login">Password * </label>
                            <input type="password" id="password-login" name="txtPass">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <button type="submit" class="login">Login</button>
                            <a href="#" title="">Lost your password?</a>
                        </div><!-- /.form-box -->
                    </form><!-- /#form-login -->
                </div><!-- /.form-login -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-account -->
