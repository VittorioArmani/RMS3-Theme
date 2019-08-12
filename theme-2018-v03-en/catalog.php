<?php
/*if (WEBSTUDIO != 'true') {
//    $components->default->categories_list(array('home' => false, 'current' => isset($curr_cat) ? $curr_cat : ''));
//}
*/?>

<section style="padding-top:30px" class="well <?php if (WEBSTUDIO == 'true') {
    echo 'templates2';
} else {
    echo 'templates';
} ?>">
    <div class="cleafix"></div>
    <div class="container">
		<ul class="breadcrumb" style="margin-bottom:30px">
           <li><a href="<?php echo S_SITE_URL ?>">Home</a></li>
           <li><?php echo $catalog->getVisibleName() ?></li>
       </ul>
       <?php $components->default->text_block(array('text' => $catalog->getText('header')))?>
    </div>
    <div id="templates_block" class="container">
        <!-- <h2>Templates found in <?php echo $catalog->getName(); ?> "<?php echo $catalog->getVisibleName() ?>"</h2> -->
        <div class="row">
            <?php $templates_params = array('templates' => $templates,
                'cols' => COLS,
                'rows' => ROWS,
                'title' => $catalog->getVisibleName(),
                'max_page' => $max_page,
                'page' => $num_page,
                'url' => '',
                'pattern' => $catalog->getUrlPattern(),
                'catalog_type' => $catalog->getName(),
                'alias' => $catalog->getAlias()
            );
            ?>
            <?php if (isset($similar)) {
                $templates_params['message'] = 'NO ITEMS FOUND MATCHING YOUR SEARCH CRITERIA<br/>Please browse similar templates';
            } ?>
            
            <div style="display: none; position: absolute;z-index:110;" id="preview_div"></div>
            <?php $components->default->templates($templates_params) ?>
        </div>
    </div>
    <div class="cleafix"></div>
    <div class="container">
        <?php $components->default->text_block(array('text' => $catalog->getText('footer')))?>
    </div>
</section>
<?php //$components->default->text_block(array('text' => $catalog->getText('footer')))?>
<?php $components->other->banners_by_group(array("name" => "default-2", 'max' => 1)); ?>
<?php $components->other->banners_by_group(array("name" => "default", 'max' => 3)); ?>
