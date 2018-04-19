<!-- head -->
<?php $this->load->view('admin/product/head', $this->data)?>

<div class="line"></div>

<div id="main_product" class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách sản phẩm
            </h6>
            <div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
        </div>


        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">

            <thead class="filter"><tr><td colspan="6">
                    <form method="get" action="<?php echo admin_url('product')?>" class="list_filter form">
                        <table width="80%" cellspacing="0" cellpadding="0"><tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value="<?php echo $this->input->get('id')?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tên</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="<?php echo $this->input->get('name')?>" name="name"></td>

                                <td style="width:60px;" class="label"><label for="filter_status">Thể loại</label></td>
                                <td class="item">
                                    <select name="category">
                                        <option value=""></option>
                                        <!-- kiem tra danh muc co danh muc con hay khong -->
                                        <?php foreach ($categories as $category):?>
                                            <?php if(count($category->subs) > 1):?>
                                                <optgroup label="<?php echo $category->name?>">
                                                    <?php foreach ($category->subs as $sub):?>
                                                        <option value="<?php echo $sub->id?>" <?php echo ($this->input->get('category') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->name?> </option>
                                                    <?php endforeach;?>
                                                </optgroup>
                                            <?php else:?>
                                                <option value="<?php echo $category->id?>" <?php echo ($this->input->get('category') == $category->id) ? 'selected' : ''?>><?php echo $category->name?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('product')?>'; " value="Reset" class="basic">
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
                <td>Giá</td>
                <td style="width:75px;">Ngày tạo</td>
                <td style="width:120px;">Hành động</td>
            </tr>
            </thead>

            <tfoot class="auto_check_pages">
            <tr>
                <td colspan="6">
                    <div class="list_action itemActions">
                        <a url="<?php echo admin_url('product/delete_multi')?>" class="button blueB" id="submit" href="#submit">
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
            <?php foreach ($products as $pd):?>
                <tr class="row_<?php echo $pd->id?>">
                    <td><input type="checkbox" value="<?php echo $pd->id?>" name="id[]"></td>

                    <td class="textC"><?php echo $pd->id?></td>

                    <td>
                        <div class="image_thumb">
                            <img height="50" src="<?php echo base_url('upload/product/'.$pd->image_link)?>">
                            <div class="clear"></div>
                        </div>

                        <a target="_blank" title="" class="tipS" href="">
                            <b><?php echo $pd->name?></b>
                        </a>

                        <div class="f11">
                            Đã bán: <?php echo $pd->buyed?>	| Xem: <?php echo $pd->view?>
                        </div>

                    </td>

                    <td class="textR">
                        <?php if($pd->discount > 0):?>
                            <?php $price_new = $pd->price - $pd->discount;?>
                            <b style="color:red"><?php echo number_format($price_new)?> đ</b>
                            <p style="text-decoration:line-through"><?php echo number_format($pd->price)?> đ</p>
                        <?php else:?>
                            <b style="color:red"><?php echo number_format($pd->price)?> đ</b>
                        <?php endif;?>
                    </td>

                    <td class="textC"><?php echo $pd->created ?></td>

                    <td class="option textC">
                        <a title="Xem chi tiết sản phẩm" class="tipS" target="_blank" href="product/view/9.html">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
                        </a>

                        <a class="tipS" title="Chỉnh sửa" href="<?php echo admin_url('product/edit/'.$pd->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/edit.png">
                        </a>

                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('product/delete/'.$pd->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
    </div>

</div>