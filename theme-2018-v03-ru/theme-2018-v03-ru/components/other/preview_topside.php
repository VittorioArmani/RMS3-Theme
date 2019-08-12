<?php
$id = $template->getId();
$url_type = "/" . $template->type->getAlias() . "-type";
if($template->categories[0] == true){
    $url_category = "/category/" . $template->categories[0]->getAlias();
    $category = $template->categories[0]->getVisibleName();
}
else
{
    $url_category = "";
    $category = "";
}

$type = explode(" ", $template->type->getHtmlTitle());
if (!defined('DISCOUNT'))
define('DISCOUNT',1);
?>
<?php // $components->default->property(); ?>
<section class="well3">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo S_SITE_URL ?>">Главная</a></li>
			<li><a href="<?php echo trim(S_SITE_URL, "/") . $url_type . "/"; ?>"><?php echo $template->type->getVisibleName(); ?></a></li>
            <!-- <li><a href="<?php // echo trim(S_SITE_URL, "/") . $url_type . "/"; ?>"><?php // echo $type[0] . " templates" ?></a></li>-->
            <li><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></li>
			<!--<li><?php //echo substr(strstr(Property_API2::get_template_single_property( $template->getId(), 'Name of the template', 'Name of the template' ), ": "), 2); ?></li>-->
			<li><?php echo "Шаблон #";echo $template->getId(); ?></li>
        </ul>
        <!--<h2><?php //echo $type[0] . " template" ?></h2>-->
        <!--<h2><?php echo str_replace('<br>', $type[0]. " ", substr(strstr(Property_API2::get_template_single_property( $template->getId(), 'Name of the template', 'Name of the template' ), ": "), 2)); ?></h2>-->
		
		<?php
echo '<h2>';	
$url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
$resp = file_get_contents($url, FALSE);
$resp = json_decode($resp);
echo $resp[0]->{'templateFullTitle'};
echo '</h2>';
		?>
		
		
        <!--<dl class="template_number">
            <dt>Template ID:</dt>
            <dd><?php //echo $template->getId() ?></dd>
        </dl>-->
        <div class="row">
            <div class="col-sm-8 center">
                <?php $components->default->template_page(array('template' => $template, 'page_name' => urldecode($page_name))); ?>
            </div>
            <div class="col-sm-4">
                <?php
                if (WEBSTUDIO == 'true') { ?>
                    <div class="buy_template_new">
						 <?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
                         <a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" class="btn2" target="_blank">Демо</a>
						 <?php } ?>
						 <?php $components->script->text_block(array('text' => $page->getGlobalText('TEMPLATE_ADVANTAGES'))); ?>    
						 
                        <!--  <a id="template_buy_<?php // echo $template->getId() ?>" class="btn3 fancybox order" href="#request-form-wrapper" target="_blank" rel="nofollow" data-id="//www.templatehelp.com/preset/cart.php?act=add&templ=<?php // echo $template->getId() ?>&pr_code=<?php // echo PR_CODE ?>">Order Website</a> -->
						
                        <a id="template_buy_<?php echo $template->getId() ?>" class="btn3 fancybox order" href="#request-form-wrapper" target="_blank" rel="nofollow" data-id="https://www.templatehelp.com/preset/pr_preview.php?i=<?php echo $template->getId() ?>&pr_code=<?php echo PR_CODE ?>">Заказать сайт</a>

                        <?php if( !empty( Property_API2::get_template_single_property( $template->getId(), 'Short description', 'Template Description' ) ) || !empty(Property_API2::get_template_single_property( $template->getId(), 'Features' )) ){ ?>
                            <div id="templateInfo" class="buy_template">
                        
                            <?php echo '<h5 class="custom-description"><b>Краткое описание:</b></h5>';
                                $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
                                $resp = file_get_contents($url, FALSE);
                                $resp = json_decode($resp);
                                echo $resp[0]->{'templatePreviewFBTitle'}; 
                            ?><br><br>
                            
                            <?php echo '<h5 class="custom-description"><b>Характеристики:</b></h5>';
                                $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
                                $resp = file_get_contents($url, FALSE);
                                $resp = json_decode($resp);
                                echo $resp[0]->{'anchorFeature'}; 
                            ?><br><br>

                            <?php // echo Property_API2::get_template_single_property( $template->getId(), 'Short description', ''); ?>
                            <?php // echo Property_API2::get_template_single_property( $template->getId(), 'Features' ); ?>

                            </div>                             
                        <?php } ?>                     
                    </div>
                <?php } else { ?>
                    <div class="buy_template">
                        <ul class="features-list2 mobile-block">
                            <li>
                                <div class="icon mdi mdi-phone-in-talk"></div>
                                <h4>Техническая<br/> Поддержка 24/7</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-travel"></div>
                                <h4>Готовые решения<br/> для бизнеса</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-membership"></div>
                                <h4>Премиальное<br/> качество</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-thumb-up"></div>
                                <h4>1 200 000+<br/> довольных <br class="hide"/>клиентов</h4>
                            </li>
                        </ul>
						
						<table id="table-mobile" class="table" style="border:none; text-align:left;">
                            <tr>        
                                <td style="border-top:none">Шаблон #</td>
                                <td style="border-top:none"><?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td>Тип:</td>
                        		<td><b><u>
                        		<!--<a href="<?php //echo $template->package->getUrl()?>"><?php // echo $template->package->getVisibleName() ?></a>-->
                        		<a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                        		</u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Описание:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td>Автор:</td>
                                <td><b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td>Загрузки:</td>
                                <td><?php echo $template->getDownloadsCount() ?></td>
                            </tr>
                            <!--<tr>
                                <td class="dont-display-useless-info">Доступные исходники:</td>
                                <td class="dont-display-useless-info"><?php 
                        		if ($template->getSourcesString() == true)
                        		{echo $template->getSourcesString();} 
                        		else
                        		echo '<style>td.dont-display-useless-info { display:none;}</style>';
                        		?></td>
                            </tr>
                            <tr>
                                <td class="dont-display-useless-info">Необходимый софт:</td>
                        		<td class="dont-display-useless-info"><?php 
                        		if ($template->getSoftwaresString() == true)
                        		{echo $template->getSoftwaresString();} 
                        		else
                        		echo '<style>td.dont-display-useless-info { display:none;}</style>';
                        		?></td>        
                            </tr>-->
                            <?php 
                            	if ($template->getKeywords() == true){ ?>
                            <tr>
                        		<td>Ключевые слова:</td>
                                <td><?php echo $template->getKeywords(); ?></td>
                            </tr>
                            <?php }?>


                                </table>						
						
						
                        <?php if (defined('CALCULATE_DISCOUNT') && CALCULATE_DISCOUNT == 1): ?>
                            <div class="price_tag discount" id="template_price_<?php echo $template->getId() ?>">
                                <span class="old-price">
                                    <?php
                                    echo $template->getCurrencySymbol ();
                                    // echo util::template_price ($template->getRegularPrice());
                                    echo floor((util::template_price ($template->getRegularPrice()))/DISCOUNT);
                                    ?>
                                </span>
                                <span>
                                    <?php
                                    echo $template->getCurrencySymbol ();
                                    // echo util::template_price ($template->getRegularPrice() * ((DISCOUNT < 0.7) ? 0.7 : DISCOUNT ));
                                    echo $template->getRegularPrice();
                                    ?>
                                </span>
                            </div>
                        <?php else: ?>
                            <div class="price_tag" id="template_price_<?php echo $template->getId() ?>">
                                <?php
                                echo $template->getCurrencySymbol ();
                                echo util::template_price ($template->getRegularPrice());
                                ?>
                            </div>
                        <?php endif; ?>

            <?php if($template->type->getId() != 32 && $template->type->getId() != 77 && $template->type->getId() != 48 && $template->type->getId() != 49 && $template->type->getId() != 112 && $template->type->getId() != 101 && $template->type->getId() != 110 && $template->type->getId() != 104 && $template->type->getId() != 96 && $template->type->getId() != 57 && $template->type->getId() != 12 && $template->type->getId() != 106 && $template->type->getId() != 105 && $template->type->getId() != 97 && $template->type->getId() != 11 && $template->type->getId() != 116 && $template->type->getId() != 108 && $template->type->getId() != 100 && $template->type->getId() != 88 && $template->type->getId() != 107 && $template->type->getId() != 94 && $template->type->getId() != 7 && $template->type->getId() != 5 && $template->type->getId() != 74){ ?>
                         <a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" class="btn2" target="_blank">Live Demo</a>       
            <?php } ?>
                         
                         <a id="template_buy_<?php echo $template->getId() ?>" class="btn3" href="<?php echo str_replace('http', 'https', htmlentities($template->getBuyUrl())) ?>" target="_blank" rel="nofollow">Купить</a>
                        <div id="templateInfo" style="margin-top:20px">
                            <table id="table-desk" class="table" style="border:none; text-align:left">
                            <tr>        
                                <td style="border-top:none">Шаблон #</td>
                                <td style="border-top:none"><?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td>Тип:</td>
                        		<td><b><u>
                        		<!--<a href="<?php //echo $template->package->getUrl()?>"><?php // echo $template->package->getVisibleName() ?></a>-->
                        		<a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                        		</u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Описание:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td>Автор:</td>
                                <td><b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td>Загрузки:</td>
                                <td><?php echo $template->getDownloadsCount() ?></td>
                            </tr>
                            <!--<tr>
                                <td class="dont-display-useless-info">Доступные исходники:</td>
                                <td class="dont-display-useless-info"><?php 
                        		if ($template->getSourcesString() == true)
                        		{echo $template->getSourcesString();} 
                        		else
                        		echo '<style>td.dont-display-useless-info { display:none;}</style>';
                        		?></td>
                            </tr>
                            <tr>
                                <td class="dont-display-useless-info">Необходимый софт:</td>
                        		<td class="dont-display-useless-info"><?php 
                        		if ($template->getSoftwaresString() == true)
                        		{echo $template->getSoftwaresString();} 
                        		else
                        		echo '<style>td.dont-display-useless-info { display:none;}</style>';
                        		?></td>        
                            </tr>-->
                            <?php 
                            	if ($template->getKeywords() == true){ ?>
                            <tr>
                        		<td>Ключевые слова:</td>
                                <td><?php echo $template->getKeywords(); ?></td>
                            </tr>
                            <?php }?>

<!-- Property function starts-->
<?php
/*$url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
$resp = file_get_contents($url, FALSE);

$resp = json_decode($resp);
$yield = get_object_vars( $resp[0]->{'properties'} );

function checkproperty($key, $object){
	foreach ( $object as $value => $property_name )
        {
          if ($property_name == true){
			return true;  
		  }
		            
        }
}
      
	  foreach ( $yield as $key => $object )
      {
		if (checkproperty($key, $object) == true){ 
		echo '<strong>' . $key . '</strong>' . ' : ';
        foreach ( $object as $value => $property_name )
        {
          echo $property_name . ', ';
		            
        }
		echo '<br>';
		}
      }*/
?>
<!-- Property function ends -->

                                </table>
                        </div>                        
                    </div>
                    <ul class="payment_methods">
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img04.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img03.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img02.jpg"; ?>" alt=""></li>                 
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img05.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img08.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img09.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img12.jpg"; ?>" alt=""></li>                        
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img11.jpg"; ?>" alt=""></li>
                        <li><img src="<?php echo FRONTEND_DIR . "/images/page-4_img10.jpg"; ?>" alt=""></li>                        
                    </ul>
                    <!--<ul class="features-list2">
                        <li>
                            <div class="icon mdi mdi-phone-in-talk"></div>
                            <h4>Free 24/7<br/> Support Team</h4>
                        </li>
                        <li>
                            <div class="icon mdi mdi-wallet-travel"></div>
                            <h4>Ready Solution<br/> For Business</h4>
                        </li>
                        <li>
                            <div class="icon mdi mdi-wallet-membership"></div>
                            <h4>Premium<br/> Quality</h4>
                        </li>
                        <li>
                            <div class="icon mdi mdi-thumb-up"></div>
                            <h4>1 200 000+<br/> Satisfied <br class="hide"/>Customers</h4>
                        </li>
                    </ul>-->
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- <div class="hr-line"></div> -->