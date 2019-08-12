<?php if($template->pages->count()>1) { ?>
<h3>Use the Links Below to Browse the Subpages of this Template</h3>
<ul>
<?php
    $inner_pages_counter = 2;
    foreach ($template->pages as $tpage) {
        if (strtolower($tpage->getVisibleName()) != strtolower($page_name)) {?>
        <li><span title="<?php echo html::specialurlencode($tpage->getUrl())?>" class="preview_page"><?php echo html::specialchars($tpage->getVisibleName())?></span></li>
        <?php } else { ?>
        <li><span title="<?php echo html::specialurlencode($tpage->getUrl())?>" class="active preview_page"><?php echo html::specialchars($tpage->getVisibleName())?></span></li>
        <?php }
    }
?>
</ul>
<?php } ?>