<div id="related_block">
    <dl id="related_category">
        <dt>Related Categories:</dt>
        <?php $bottom_info_counter = 1 ?>
        <?php foreach ($template->categories as $category){ ?>
        <dd><a href="<?php echo SITE_DOMAIN?><?php echo $category_url[$category->getAlias()]?>"><?php echo $category->getVisibleName() ?></a><?php if(count($template->categories) > $bottom_info_counter++) echo ','; ?></dd>
        <?php } ?>
        <?php if ($template->getKeywords()!='') { ?>
        <dl id="related_keyword">
            <dt>Related Keywords:</dt>
            <dd><?php echo $template->getKeywords() ?></dd>
        </dl>
        <?php } ?>
    </dl>
</div>