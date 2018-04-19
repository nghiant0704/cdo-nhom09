<?php $this->load->view('admin/admin/head', $this->data); ?>

<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <div class="title">
			<span class="titleIcon">
			<div class="checker" id="uniform-titleCheck">
    			<span>
    			   <input type="checkbox" name="titleCheck" id="titleCheck" style="opacity: 0;">
    			</span>
			</div>
			</span>
            <h6>Danh sách admin</h6>
            <div class="num f12">Tổng số: <b><?php echo count($admins); ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
                <td style="width:80px;">STT</td>
                <td>Họ và tên</td>
                <td>Username</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="7">
                    <div class='pagination'>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody>
            <?php foreach ($admins as $ad):?>
                <tr>
                    <td><input type="checkbox" name="id[]" value="<?php echo $ad->id?>" /></td>

                    <td class="textC"><?php echo $ad->id?></td>

                    <td>
						<span title="<?php echo $ad->name?>" class="tipS">
							<?php echo $ad->name?>
						</span></td>

                    <td><span title="<?php echo $ad->username?>" class="tipS">
							<?php echo $ad->username?>
						</span></td>


                    <td class="option">
                        <a href="<?php echo admin_url('admin/edit/'.$ad->id); ?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
                        </a>

                        <a href="<?php echo admin_url('admin/delete/'.$ad->id); ?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="clear mt30"></div>
