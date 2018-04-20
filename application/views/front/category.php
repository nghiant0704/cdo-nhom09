<div id="mega-menu">
    <div class="btn-mega"><span></span>ALL CATEGORIES</div>
    <ul class="menu">
        <?php foreach ($categories as $category): ?>
        <li>
            <a href="<?php echo base_url('product/category/'.$category->id); ?>" title="" <?php if(!empty($category->subs)): ?> class="dropdown" <?php endif; ?>>
                <span class="menu-img">
                    <img src="<?php echo public_url()?>/front/images/icons/menu/01.png" alt="">
                </span>
                <span class="menu-title">
												<?php echo $category->name; ?>
											</span>
            </a>
            <?php if(!empty($category->subs)): ?>
            <div class="drop-menu">
                <div class="one-third">
                    <div class="cat-title">
                        <?php echo $category->name; ?>
                    </div>
                    <ul>
                        <?php foreach ($category->subs as $sub): ?>
                        <li>
                            <a href="<?php echo base_url('product/category/'.$sub->id); ?>" title=""><?php echo $sub->name; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="show">
                        <a href="#" title="">Shop All</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>