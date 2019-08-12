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
<section class="well3">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo S_SITE_URL ?>">Pagina iniziale</a></li>
            <li><a href="<?php echo trim(S_SITE_URL, "/") . $url_type . "/"; ?>"><?php echo $template->type->getVisibleName(); ?></a></li>
            <li><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></li>
            <li><?php echo "Modello #";echo $template->getId(); ?></li>
        </ul>
       <!-- <h2><?php // echo str_replace('<br>', $type[0]. " ", substr(strstr(Property_API2::get_template_single_property( $template->getId(), 'Name of the template', 'Name of the template' ), ": "), 2)); ?></h2> -->
                <?php
                  echo '<h2>';	
                    $url = 'https://api.templatemonster.com/products/v2/products/it?language=it&ids=' . $id . '&expand=properties';
                     $resp = file_get_contents($url, FALSE);
                    $resp = json_decode($resp);
                  echo $resp[0]->{'templateFullTitle'};
                  echo '</h2>';
                ?>
        <div class="row">
            <div class="col-sm-8 center">
                <?php $components->default->template_page(array('template' => $template, 'page_name' => urldecode($page_name))); ?>
            </div>
            <div class="col-sm-4">
                <?php
                if (WEBSTUDIO == 'true') { ?>
                    <div class="buy_template_new">
						 <?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
                         <a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" class="btn2" target="_blank">Live Demo</a>
						 <?php } ?>
						 <?php $components->script->text_block(array('text' => $page->getGlobalText('TEMPLATE_ADVANTAGES'))); ?>                         
                        
						<!--  <a id="template_buy_<?php // echo $template->getId() ?>" class="btn3 fancybox order" href="#request-form-wrapper" target="_blank" rel="nofollow" data-id="//www.templatehelp.com/preset/cart.php?act=add&templ=<?php // echo $template->getId() ?>&pr_code=<?php // echo PR_CODE ?>">Order Website</a> -->
                        
						<a id="template_buy_<?php echo $template->getId() ?>" class="btn3 fancybox order" href="#request-form-wrapper" target="_blank" rel="nofollow" data-id="						https://www.templatehelp.com/preset/pr_preview.php?i=<?php echo $template->getId() ?>&pr_code=<?php echo PR_CODE ?>">Ordina Sito Web</a>                        
						<?php if( !empty( Property_API2::get_template_single_property( $template->getId(), 'Short description', 'Template Description' ) ) || !empty(Property_API2::get_template_single_property( $template->getId(), 'Features' )) ){ ?>
                            <div id="templateInfo" class="buy_template" >
                                 <?php echo Property_API2::get_template_single_property( $template->getId(), 'Short description', 'Template Description'); ?>
                                 <?php echo Property_API2::get_template_single_property( $template->getId(), 'Features' ); ?>
                            </div>                       
                        <?php } ?>                     
                    </div>
                <?php } else { ?>
                    <div class="buy_template">
                        <ul class="features-list2 mobile-block">
                            <li>
                                <div class="icon mdi mdi-phone-in-talk"></div>
                                <h4>Premium Assistenza<br/> Gratuita 24/7</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-travel"></div>
                                <h4>Attività Commerciale<br/> Soluzioni Pronte</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-membership"></div>
                                <h4>Qualità Premium<br/> Gagantita</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-thumb-up"></div>
                                <h4>1 200 000+<br/> Clienti <br class="hide"/>Soddisfatti</h4>
                            </li>
                        </ul>	
						<table id="table-mobile" class="table" style="border:none; text-align:left;">
                            <tr>        
                                <td style="border-top:none">Modello #</td>
                                <td style="border-top:none"><?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td>Tipo:</td>
                        		<td><b><u>
                        		<a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                        		</u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Descrizione:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td>Autore:</td>
                                <td><b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td>Download:</td>
                                <td><?php echo $template->getDownloadsCount() ?></td>
                            </tr>
                       <!-- <tr>
                              <td>Fonti disponibili:</td>
                              <td>
                              <?php 
                              //  if ($template->getSourcesString() == true)
                              //    {echo $template->getSourcesString();} 
                              //  else
                              //    echo "Info available in live chat";
                              ?>
                              </td>
                            </tr>
                            <tr> -->
                        <!--  <td>Software richiesto:</td>
                              <td>
                              <?php 
                              //  if ($template->getSoftwaresString() == true)
                              //    {echo $template->getSoftwaresString();} 
                              //  else
                              //    echo "Info available in live chat";
                              ?>
                              </td>        
                            </tr> -->
                            <?php 
                            	if ($template->getKeywords() == true){ ?>
                            <tr>
                        		<td>Parole chiave:</td>
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
                         
                         <a id="template_buy_<?php echo $template->getId() ?>" class="btn3" href="<?php echo str_replace('http', 'https', htmlentities($template->getBuyUrl())) ?>" target="_blank" rel="nofollow">Acquista</a>
                        <div id="templateInfo" style="margin-top:20px">
                            <table id="table-desk" class="table" style="border:none; text-align:left">
                            <tr>        
                                <td style="border-top:none">Modello #</td>
                                <td style="border-top:none"><?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td>Tipo:</td>
                        		<td><b><u>
                        		<a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                        		</u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Descrizione:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td>Autore:</td>
                                <td><b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td>Download:</td>
                                <td><?php echo $template->getDownloadsCount() ?></td>
                            </tr>
                       <!-- <tr>
                              <td>Fonti disponibili:</td>
                              <td>
                              <?php 
                              //  if ($template->getSourcesString() == true)
                              //    {echo $template->getSourcesString();} 
                              //  else
                              //    echo "Informazioni disponibili in live chat";
                              ?>
                              </td>
                            </tr> -->
                       <!-- <tr>
                              <td>Software richiesto:</td>
                              <td>
                              <?php 
                              //  if ($template->getSoftwaresString() == true)
                              //    {echo $template->getSoftwaresString();} 
                              //  else
                              //    echo "Informazioni disponibili in live chat";
                              ?>
                              </td>        
                            </tr> -->
                            <?php 
                            	if ($template->getKeywords() == true){ ?>
                            <tr>
                        		<td>Parole chiave:</td>
                                <td><?php echo $template->getKeywords(); ?></td>
                            </tr>
                            <?php }?>
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
                <?php } ?>
            </div>
        </div>
    </div>
</section>