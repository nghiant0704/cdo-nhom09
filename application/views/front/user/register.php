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
                        <a href="#" title="">Đăng kí</a>
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
                <div class="form-register">
                    <div class="title">
                        <h3>Register</h3>
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

                    <form action="<?php echo base_url('user/register')?>" method="post" id="form-register" accept-charset="utf-8">
                        <div class="form-box">
                            <label for="email-register">Email address * </label>
                            <input type="text" id="email-register" name="txtEmail" value="<?php echo set_value('txtEmail'); ?>">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="password-register">Password * </label>
                            <input type="password" id="password-register" name="txtPass">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="repassword-register">RePassword * </label>
                            <input type="password" id="repassword-register" name="txtRePass">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="name-register">Họ và tên * </label>
                            <input type="text" id="name-register" name="txtName" value="<?php echo set_value('txtName'); ?>">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="phone-register">Số điện thoại * </label>
                            <input type="text" id="phone-register" name="txtPhone" value="<?php echo set_value('txtPhone'); ?>">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <label for="address-register">Địa chỉ * </label>
                            <input type="text" id="address-register" name="txtAddress" value="<?php echo set_value('txtAddress'); ?>">
                        </div><!-- /.form-box -->
                        <div class="form-box">
                            <button type="submit" class="register">Register</button>
                        </div><!-- /.form-box -->
                    </form><!-- /#form-register -->
                </div><!-- /.form-register -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-account -->
