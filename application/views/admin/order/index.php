<!-- head -->
<?php $this->load->view('admin/order/head', $this->data)?>

<div class="line"></div>

<div id="main_product" class="wrapper">
    <?php $this->load->view('admin/message', $this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách Đơn hàng sản phẩm
            </h6>
            <div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
        </div>


        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">

            <thead class="filter"><tr><td colspan="6">
                    <form method="get" action="<?php echo admin_url('order')?>" class="list_filter form">
                        <table width="80%" cellspacing="0" cellpadding="0"><tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value="<?php echo $this->input->get('id')?>" name="id"></td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url('order')?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                            </tbody></table>
                    </form>
                </td></tr></thead>

            <thead>
            <tr>
                <td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
                <td style="width:60px;">Mã số</td>
                <td>Tên sản phẩm</td>
                <td>Số lượng</td>
                <td>Số tiền</td>
                <td>Trạng thái</td>
                <td style="width:120px;">Hành động</td>
            </tr>
            </thead>

            <tfoot class="auto_check_pages">
            <tr>
                <td colspan="6">
                    <div class="list_action itemActions">
                        <a url="<?php echo admin_url('order/delete_multi')?>" class="button blueB" id="submit" href="#submit">
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
            <?php foreach ($orders as $order):?>
                <tr class="row_<?php echo $order->id?>">
                    <td><input type="checkbox" value="<?php echo $order->id?>" name="id[]"></td>

                    <td class="textC"><?php echo $order->id ?></td>
                    <td class="textC"><?php echo $order->name ?></td>
                    <td class="textC"><?php echo $order->qty ?></td>
                    <td>
                        <?php echo number_format($order->amount); ?>
                    </td>
                    <td>
                        <?php
                        if($order->status == 0)
                            echo 'Chưa chuyển hàng';
                        else if($order->status == 1)
                            echo 'Đã chuyển hàng';
                        else
                            echo 'Đã bị hủy';
                        ?>
                    </td>

                    <td class="option textC">
                        <a title="Đã chuyển hàng" class="tipS" href="<?php echo admin_url('order/chuyenhang/'.$order->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png">
                        </a>
                        <a title="Hủy đơn hàng" class="tipS" href="<?php echo admin_url('order/huydon/'.$order->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/block.png">
                        </a>
                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('order/delete/'.$order->id)?>">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
    </div>

</div>