<!-- head -->
<?php $this->load->view('admin/user/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
    <div class="widget">
        <div class="title">
            <h6>Thêm mới Thành viên</h6>
        </div>


        <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
            <fieldset>
                <div class="formRow">
                    <label for="param_name" class="formLeft">Tên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo set_value('txtName')?>" name="txtName"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtName')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Email:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('txtEmail')?>" id="param_emsil" name="txtEmail"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtEmail')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="password" _autocheck="true" id="param_password" name="txtPass"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtPass')?></div>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="formRow">
                    <label for="param_username" class="formLeft">Nhập lại mật khẩu:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="password" _autocheck="true" id="param_re_password" name="txtRePass"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtRePass')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Số điện thoại:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('txtPhone')?>" id="param_phone" name="txtPhone"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtPhone')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label for="param_username" class="formLeft">Địa chỉ:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input type="text" _autocheck="true" value="<?php echo set_value('txtAddress')?>" id="param_address" name="txtAddress"></span>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"><?php echo form_error('txtAddress')?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input type="submit" class="redB" value="Thêm mới">
                </div>
            </fieldset>
        </form>

    </div>
</div>