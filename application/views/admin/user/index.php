<!-- head -->
<?php $this->load->view('admin/user/head', $this->data)?>

<div class="line"></div>

<div id="main_product" class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách Thành viên
            </h6>
            <div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
        </div>


        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">

            <thead class="filter"><tr><td colspan="6">
                    <form method="get" action="<?php echo admin_url('user')?>" class="list_filter form">
                        <table width="80%" cellspacing="0" cellpadding="0"><tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value="<?php echo $this->input->get('id')?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Email</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="<?php echo $this->input->get('email')?>" name="email"></td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('user')?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                            </tbody></table>
                    </form>
                </td></tr></thead>

            <thead>
            <tr>
                <td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
                <td style="width:60px;">Mã số</td>
                <td>Tên</td>
                <td>Email</td>
                <td>Số điện thoại</td>
                <td>Địa chỉ</td>
                <td style="width:75px;">Ngày tạo</td>
                <td style="width:120px;">Hành động</td>
            </tr>
            </thead>

            <tfoot class="auto_check_pages">
            <tr>
                <td colspan="6">
                    <div class="list_action itemActions">
                        <a url="<?php echo admin_url('user/delete_multi')?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xóa mục chọn</span>
                        </a>
                    </div>

                    <div class="pagination">
                        <?php echo $this->pagination->create_links()?>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody class="list_item">
            <?php foreach ($users as $user):?>
                <tr class="row_<?php echo $user->id?>">
                    <td><input type="checkbox" value="<?php echo $user->id?>" name="id[]"></td>

                    <td class="textC"><?php echo $user->id?></td>

                    <td class="textC"><?php echo $user->name?></td>
                    <td class="textC"><?php echo $user->email?></td>
                    <td class="textC"><?php echo $user->phone?></td>
                    <td class="textC"><?php echo $user->address?></td>
                    <td class="textC"><?php echo $user->created ?></td>

                    <td class="option textC">
                        <a class="tipS" title="Chỉnh sửa" href="<?php echo admin_url('user/edit/'.$user->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/edit.png">
                        </a>

                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('user/delete/'.$user->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
    </div>

</div>