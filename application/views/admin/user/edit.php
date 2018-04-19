<!-- head -->
<?php $this->load->view('admin/user/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Sửa thông tin Thành viên</h6>
        </div>

        <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $user->name?>" name="name"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('name')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $user->email?>" id="param_email" name="email"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('email')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Password:<span class="req">*</span></label>
                    <div class="formRight">
                		<span class="oneTwo">
                		<input type="password" _autocheck="true" id="param_password" name="password">
                		<p>Nếu cập nhật mật khẩu thì mới nhập giá trị</p>
                		</span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('password')?></div>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="formRow">
                    <label for="param_username" class="formLeft">Nhập lại mật khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="password" _autocheck="true" id="param_re_password" name="re_password"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('re_password')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Số điện thoại:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $user->phone?>" id="param_phone" name="phone"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('phone')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Địa chỉ:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo $user->address?>" id="param_address" name="address"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('address')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input type="submit" class="redB" value="Cập nhật">
                </div>
            </fieldset>
        </form>

    </div>
</div>
