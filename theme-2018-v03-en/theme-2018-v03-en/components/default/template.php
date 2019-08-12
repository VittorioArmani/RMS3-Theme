<?php
$template_id = $template->getId();
if(strpos((string)'x' . HIDE_TEMPLATES, (string)$template_id) == false){
	if ($template->getMainPreviewWidth() != '') {
    $template_img_width = $template->getMainPreviewWidth();
    $template_img_height = $template->getMainPreviewHeight();
    $template_img_src = $template->getMainPreview();
    $extension = substr($template_img_src, strlen($template_img_src) - 4);
    echo "<script type='text/javascript'>
              var tpl_$template_id = new Object();
              tpl_$template_id.id='tpl_$template_id';
              tpl_$template_id.title='Template #$template_id';
              tpl_$template_id.src='$template_img_src';
              tpl_$template_id.width=$template_img_width;
              tpl_$template_id.height=$template_img_height;
              tpl_$template_id.ext='$extension';
              templatesArray.push(tpl_$template_id);
          </script>
         ";
    $main_width = $template->getMainPreviewWidth();
    $main_height = $template->getMainPreviewHeight();
    //$mouseover = ($main_width != 0) ? "onmouseover=\"showtrail('" . $template->getMainPreview() . "','Template " . $template->getId() . "'," . $main_width . "," . $main_height . ")\"" : "";
	$mouseover = ($main_width != 0) ? "" : "";
}
$folder = floor($template_id / 100);
$url_image = "//scr.template-help.com/" . $folder . "00/" . $template_id . "-med.jpg";
if (!defined('DISCOUNT'))
    define('DISCOUNT',1);
if (WEBSTUDIO == 'true') { ?>
<?php if ( WHERE_WE_NOW == 'index' ) { ?>
    
	
	
	<div data-equal-group="5" id="template_<?php echo $template->getId()?>" class="col-lg-3 col-md-4 col-sm-6 <?php if (FEATURED_SLIDER_OFF == 'true'){echo 'template';}else{echo 'swiper-slide';}?>">
        <div class="template_thumbnail_new template_thumbnail">
            <a href="<?php echo $template->getUrl()?>" <?php echo $mouseover?> onmouseout="hidetrail()">
                <img src="<?php echo $url_image; ?>" id="<?php echo "tpl_$template_id"; ?>" alt="Template #<?php echo $template_id; ?>">
            </a>
        </div>
        <div class="template_info">
           <?php if($template->categories[0] == true){
            
                $url_category = "/category/" . $template->categories[0]->getAlias();
                $category = $template->categories[0]->getVisibleName(); 
            ?>
            <dl>
                <dt>Category: </dt>
                <dd><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></dd>				
            </dl>
            <?php } else echo '<dt>Category: </dt>'?>
            <dl>
                <dt>CMS Type:</dt>
                <dd><a href="<?php echo $template->type->getUrl()?>"><?php echo $template->type->getVisibleName() ?></a></dd>
            </dl>
            <?php $id = $template->getId(); ?>
            <div class="btn-box">
			
				<?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
				<a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank" class="btn3">Demo</a>
				<a href="<?php echo $template->getUrl()?>" class="btn">Details</a>
				<?php }else{?>
				<a href="<?php echo $template->getUrl()?>" class="btn" style="margin-top:20px">Details</a><?php } ?>
            </div>
        </div>
    </div>
	
	
	
<?php } else { ?>
    <div data-equal-group="5" id="template_<?php echo $template->getId()?>" class="col-lg-3 col-md-4 col-sm-6 <?php if (FEATURED_SLIDER_OFF == 'true'){echo 'template';}else{echo 'swiper-slide';}?>">
        <div class="template_thumbnail_new template_thumbnail">
            <a href="<?php echo $template->getUrl()?>" <?php echo $mouseover?> onmouseout="hidetrail()">
                <img src="<?php echo $url_image; ?>" id="<?php echo "tpl_$template_id"; ?>" alt="Template #<?php echo $template_id; ?>">
            </a>
        </div>
        <div class="template_info">
           <?php if($template->categories[0] == true){
            
                $url_category = "/category/" . $template->categories[0]->getAlias();
                $category = $template->categories[0]->getVisibleName(); 
            ?>
            <dl>
                <dt>Category: </dt>
                <dd><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></dd>
            </dl>
            <?php } else echo '<dt>Category: </dt>'?>
            <dl>
                <dt>CMS Type:</dt>
                <dd><a href="<?php echo $template->type->getUrl()?>"><?php echo $template->type->getVisibleName() ?></a></dd>
            </dl>
            <?php $id = $template->getId(); ?>
            <div class="btn-box">
				<?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
				<a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank" class="btn3">Demo</a>
				<a href="<?php echo $template->getUrl()?>" class="btn">Details</a>
				<?php }else{ ?>
				<a href="<?php echo $template->getUrl()?>" class="btn" style="margin-top:20px">Details</a><?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php } else if ( WHERE_WE_NOW == 'index' ) { ?>


    <div id="template_<?php echo $template->getId()?>" class="col-lg-3 col-md-4 col-sm-6 <?php if (FEATURED_SLIDER_OFF == 'true'){echo 'template';}else{echo 'swiper-slide';}?>">
        <div class="template_thumbnail_new template_thumbnail">
            <a href="<?php echo $template->getUrl()?>" <?php echo $mouseover?> onmouseout="hidetrail()">
                <img src="<?php echo $url_image; ?>" id="<?php echo "tpl_$template_id"; ?>" alt="Template #<?php echo $template_id; ?>" />
            </a>
        </div>
        <div class="template_info">
            <?php if (defined('CALCULATE_DISCOUNT') && CALCULATE_DISCOUNT == 1): ?>
                <div class="price_tag discount">
                    <span class="old-price"><?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice()) ?></span>
                    <span>
                        <?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice() * ((DISCOUNT < 0.7) ? 0.7 : DISCOUNT )); ?>
                    </span>
                </div>
            <?php else: ?>
                <div class="price_tag">
                    <?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice()) ?>
                </div>
            <?php endif; ?>
			<?php 
			
			if($template->categories[0] == true){
			
				$url_category = "/category/" . $template->categories[0]->getAlias();
				$category = $template->categories[0]->getVisibleName(); 
			?>
            <dl>
   				<dt>Category: </dt>
				<dd><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></dd>
            </dl>
            <?php } else echo '<dt>Category: </dt>'?>
            <dl>
                <dt>CMS Type:</dt>
                <dd><a href="<?php echo $template->type->getUrl()?>"><?php echo $template->type->getVisibleName() ?></a></dd>
            </dl>
		
            <?php $id = $template->getId(); ?>
            <div class="btn-box">
				<?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
				<a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank" class="btn3">Demo</a>
				<a href="<?php echo $template->getUrl()?>" class="btn">Details</a>
				<?php }else{?>
				<a href="<?php echo $template->getUrl()?>" class="btn" style="margin-top:20px">Details</a><?php } ?>
            </div>
	    </div>
    </div>
<?php } else { ?>
    <div data-equal-group="5" id="template_<?php echo $template->getId()?>" class="col-lg-3 col-md-4 col-sm-6 template">
        <div class="template_thumbnail_new template_thumbnail">
            <a href="<?php echo $template->getUrl()?>" <?php echo $mouseover?> onmouseout="hidetrail()">
                <img src="<?php echo $url_image; ?>" id="<?php echo "tpl_$template_id"; ?>" alt="Template #<?php echo $template_id; ?>" />
            </a>
        </div>
        <div class="template_info">
            <?php if (defined('CALCULATE_DISCOUNT') && CALCULATE_DISCOUNT == 1): ?>
                <div class="price_tag discount">
                    <span class="old-price"><?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice()) ?></span>
                    <span>
                        <?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice() * ((DISCOUNT < 0.7) ? 0.7 : DISCOUNT )); ?>
                    </span>
                </div>
            <?php else: ?>
                <div class="price_tag">
                    <?php echo $template->getCurrencySymbol();?><?php echo util::template_price ($template->getRegularPrice()) ?>
                </div>
            <?php endif; ?>
            <?php
            
            if($template->categories[0] == true){
            
            
                $url_category = "/category/" . $template->categories[0]->getAlias();
                $category = $template->categories[0]->getVisibleName();
            ?>  
            <dl>
                <dt>Category: </dt>
                <dd><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></dd>
            </dl>
            <?php } else echo '<dt>Category: </dt>'?>
            
            <dl>
                <dt>CMS Type:</dt>
                <dd><a href="<?php echo $template->type->getUrl()?>"><?php echo $template->type->getVisibleName() ?></a></dd>
            </dl>
						
            <?php $id = $template->getId(); ?>
            <div class="btn-box">
			
            <?php if($template->type->getId() != 32 && $template->type->getId() != 77 && $template->type->getId() != 48 && $template->type->getId() != 49 && $template->type->getId() != 112 && $template->type->getId() != 101 && $template->type->getId() != 110 && $template->type->getId() != 104 && $template->type->getId() != 96 && $template->type->getId() != 57 && $template->type->getId() != 12 && $template->type->getId() != 106 && $template->type->getId() != 105 && $template->type->getId() != 97 && $template->type->getId() != 11 && $template->type->getId() != 116 && $template->type->getId() != 108 && $template->type->getId() != 100 && $template->type->getId() != 88 && $template->type->getId() != 107 && $template->type->getId() != 94 && $template->type->getId() != 7 && $template->type->getId() != 5 && $template->type->getId() != 74){ ?>
              <a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank" class="btn3">Demo</a>
              <a href="<?php echo $template->getUrl()?>" class="btn">Details</a>
            <?php }else{ ?>
			 
             <a href="<?php echo $template->getUrl()?>" class="btn" style="margin-top:20px">Details</a><?php } ?>
            </div>
        </div>
    </div>
<?php }}?>