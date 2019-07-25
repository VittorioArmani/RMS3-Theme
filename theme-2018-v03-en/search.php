<section class="well1" style="padding-top:30px; padding-bottom: 0px;">
    <div class="container">
        <?php       
        //$components->default->categories_list(array('home' => false));
        $templates_params = array('templates' => $templates,
            'cols' => COLS,
            'rows' => ROWS,
            'title' => 'Search Results',
            'max_page' => $max_page,
            'page' => $page,
            'url' => $url,
            'pattern' => $pattern,
            'catalog_type' => $catalog_type,
            'alias' => $alias);
        ?>
		<ul class="breadcrumb">
           <li><a href="<?php echo S_SITE_URL ?>">Home</a></li>
           <li>Search Results:</li>
		   <?php if($_GET['type']){?><li>CMS Type: <?php echo $_GET['type'];?></li><?php } ?>
		   <?php if($_GET['category']){?><li>Category: <?php echo $_GET['category'];?></li><?php } ?>
		   <?php if($_GET['keyword']){?><li>Keyword: <?php echo $_GET['keyword'];?></li><?php } ?>
       </ul>
       <?php
		if(strpos((string)'x' . HIDE_TEMPLATES, (string)$_GET['keyword']) !== false){
		echo '<div class="notification search">No items found matching your search criteria</div>';
		echo '<h4>Please return <strong><u><a href=' . S_SITE_URL . '>back</a></u></strong> and try again</h4>';
		}
		
		
         if (isset($similar)) {
            //$templates_params['message'] = 'No items found matching your search criteria.<br />';
            echo '<div class="notification search">No items found matching your search criteria</div>';
            echo '<h4>Please browse similar templates</h4>';
         }
        ?>
    </div>
</section>
<section id="templates_block" class="well <?php if (WEBSTUDIO == 'true') {
    echo 'templates2';
} else {
    echo 'templates';
} ?>">

    <div class="container">
	
        <div class="row">
            <?php $components->default->templates($templates_params) ?>
            <div style="display: none; position: absolute;z-index:110;" id="preview_div"> </div>
        </div>
    </div>
</section>
<?php //$components->other->banners_by_group(array("name"=>"default-2", 'max'=>1));?>
<?php //$components->other->banners_by_group(array("name"=>"default", 'max'=>3));?>