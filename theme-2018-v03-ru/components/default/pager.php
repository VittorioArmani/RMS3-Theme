<div class="pager">
    <?php if (isset($first_page)) {?>
        <a href="<?php echo SITE_DOMAIN?><?php echo $prev_page_url?>" class="prev-pager">Назад</a>&nbsp;
    <?php } ?>
    <?php foreach($number_urls as $i=>$url){ ?>
        <a href="<?php echo SITE_DOMAIN?><?php echo $url?>"<?php if ($i == $curr_page) {?> class="active"<?php } ?>><?php echo $i ?></a>&nbsp;
    <?php } ?>
    <?php if (isset($last_page)) {?>
        <a href="<?php echo SITE_DOMAIN?><?php echo $next_page_url?>" class="next-pager">Далее</a>&nbsp;
    <?php } ?>
</div>