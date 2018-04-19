<!-- head -->
<?php $this->load->view('admin/category/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">

    <?php $this->load->view('admin/message', $this->data);?>

    <div class="widget">

        <div class="title">
			<span class="titleIcon">
			<div class="checker" id="uniform-titleCheck">
    			<span>
    			   <input type="checkbox" name="titleCheck" id="titleCheck" style="opacity: 0;">
    			</span>
			</div>
			</span>
            <h6>Danh sách danh mục sản phẩm</h6>
            <div class="num f12">Tổng số: <b><?php echo count($categories)?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
                <td style="width:80px;">Mã số</td>
                <td style="width:80px;">Thư tự hiện thị</td>
                <td>Tên danh mục</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="7">
                    <div class="list_action itemActions">
                        <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('category/delete_multi')?>">
                            <span style='color:white;'>Xóa hết</span>
                        </a>
                    </div>

                    <div class='pagination'>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody>
            <?php foreach ($categories as $category):?>
                <tr class="row_<?php echo $category->id?>">
                    <td><input type="checkbox" name="id[]" value="<?php echo $category->id?>" /></td>

                    <td class="textC"><?php echo $category->id?></td>
                    <td class="textC"><?php echo $category->sort_order?></td>

                    <td>
						<span title="<?php echo $category->name?>" class="tipS">
							<?php echo $category->name?>
						</span>
                    </td>


                    <td class="option">
                        <a href="<?php echo admin_url('category/edit/'.$category->id)?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
                        </a>

                        <a href="<?php echo admin_url('category/delete/'.$category->id)?>" title="Xóa" class="tipS verify_action" >
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
