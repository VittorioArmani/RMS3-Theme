<?php
foreach ($list as $key => $item) { ?>
    <h2><?php echo '' . $item->getVisibleName() ?></h2>
    <?php $components->default->featured_templates(array('alias' => $item->getAlias(),
        'cols' => FCOLS,
        'rows' => FROWS,
        'title' => '' . $item->getVisibleName()
    )); ?>
	<?php $url_category = $item->getAlias();
           $category = $item->getVisibleName(); ?>
	<a class="btn3 all_btn" href="<?php echo trim(S_SITE_URL, '/') . '/' . $url_category . '-type/'; ?>"><?php echo 'All ' . $category; ?></a>
    <?php } ?>
    <div style="display: none; position: absolute;z-index:110;" id="preview_div"></div>