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
            <li><a href="<?php echo S_SITE_URL ?>">Home page</a></li>
            <li><a href="<?php echo trim(S_SITE_URL, "/") . $url_type . "/"; ?>"><?php echo $template->type->getVisibleName(); ?></a></li>
            <?php if($template->type->getId() != 7 && $template->type->getId() != 32 && $template->type->getId() != 77 && $template->type->getId() != 100){?>
            <li><a href="<?php echo trim(S_SITE_URL, "/") . $url_category . "/"; ?>"><?php echo $category; ?></a></li><?php }?>
            <li class="TemplateMin"><?php echo "Шаблон #";echo $template->getId(); ?></li>
        </ul>
        <?php
            echo '<h2>';    
            $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
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
                        <?php if($template->type->getId() != 32 && $template->type->getId() != 77 && $template->type->getId() != 48 && $template->type->getId() != 49 && $template->type->getId() != 112 && $template->type->getId() != 101 && $template->type->getId() != 110 && $template->type->getId() != 104 && $template->type->getId() != 96 && $template->type->getId() != 57 && $template->type->getId() != 12 && $template->type->getId() != 106 && $template->type->getId() != 105 && $template->type->getId() != 97 && $template->type->getId() != 11 && $template->type->getId() != 116 && $template->type->getId() != 108 && $template->type->getId() != 100 && $template->type->getId() != 88 && $template->type->getId() != 107 && $template->type->getId() != 94 && $template->type->getId() != 7 && $template->type->getId() != 5 && $template->type->getId() != 74 && $template->type->getId() != 40){ ?>
                        <a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" class="btn2" target="_blank">Demo</a>
                        <?php } ?>
                        <?php $components->script->text_block(array('text' => $page->getGlobalText('TEMPLATE_ADVANTAGES'))); ?>    
                        <a id="template_buy_<?php echo $template->getId() ?>" class="btn3 fancybox order" href="#request-form-wrapper" target="_blank" rel="nofollow" data-id="https://www.templatehelp.com/preset/pr_preview.php?i=<?php echo $template->getId() ?>&pr_code=<?php echo PR_CODE ?>">Order website</a>
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
                                <h4>Free 24/7<br/> Support Team</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-travel"></div>
                                <h4>Ready Solutions<br/> For Business</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-wallet-membership"></div>
                                <h4>Premium<br/> Quality</h4>
                            </li>
                            <li>
                                <div class="icon mdi mdi-thumb-up"></div>
                                <h4>1 200 000+<br/> <br class="hide"/>Satisfied Customers</h4>
                            </li>
                        </ul>
                        
                        <table id="table-mobile" class="table" style="border:none; text-align:left;">
                            <tr>        
                                <td class="TemplateMin" style="border-top:none">"Шаблон #"
                                <?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td>Тип:</td>
                                <td><b><u>
                                <a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                                </u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Description:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td class="TemplateMin">Author:</td>
                                <td><b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td class="TemplateMin">Downloads:</td>
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
                                <td class="TemplateMin">Keywords:
                                <?php echo $template->getKeywords(); ?></td>
                            </tr>
                            <?php }?>                          
                          </table>                        
                        <?php if (defined('CALCULATE_DISCOUNT') && CALCULATE_DISCOUNT == 1): ?>
                            <div class="price_tag discount" id="template_price_<?php echo $template->getId() ?>">
                    <span class="old-price"><?php  echo $template->getCurrencySymbol();?><?php // echo util::template_price ($template->getRegularPrice()) ?><?php echo floor((util::template_price ($template->getRegularPrice()))/DISCOUNT); ?></span>
                    <span>
                        <?php echo $template->getCurrencySymbol();?><?php // echo util::template_price ($template->getRegularPrice() * ((DISCOUNT < 0.7) ? 0.7 : DISCOUNT )); ?><?php echo util::template_price ($template->getRegularPrice()); ?>
                    </span>
                    <style type="text/css">
                    .price_tag>.old-price {
    text-decoration: line-through!important;
    color: red!important;
}
.discount {
    margin-top: 0px!important;
}
</style>
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
                         
                         <a id="template_buy_<?php echo $template->getId() ?>" class="btn3" href="<?php echo str_replace('http', 'https', htmlentities($template->getBuyUrl())) ?>" target="_blank" rel="nofollow">Buy</a>
                        <div id="templateInfo" style="margin-top:20px">
                            <table id="table-desk" class="table" style="border:none; text-align:left">
                            <tr>        
                                <td class="TemplateMin" style="border-top:none"><span class="TemplateMin">Шаблон #</span>
                                <?php echo $template->getId() ?></td>
                            </tr>
                            <tr>        
                                <td class="TemplateMin"><span class="TemplateMin">Тип:</span>
                                <b><u>
                                <a href="<?php echo $template->type->getUrl(); ?>"><?php echo $template->type->getVisibleName(); ?></a>
                                </u></b></td>
                            </tr>
                            <tr> 
                                <?php if($template->getDescription()!='') { ?>
                                <td>Description:</td>
                                <td><?php echo $template->getDescription()?></td>
                                <?php } ?>
                            </tr> 
                            <tr> 
                                <td class="TemplateMin"><span class="TemplateMin">Автор:</span>
                                <b><u><a href="<?php echo $template->author->getUrl()?>"><?php echo $template->author->getVisibleName() ?></a></u></b></td>
                            </tr> 
                            <tr>
                                <td class="TemplateMin"><span class="TemplateMin">Загрузки:</span>
                                <?php echo $template->getDownloadsCount() ?></td>
                            </tr>
                            
                            <!-- START | sent_date & inserted_date -->
                            <!--<tr>
                                <td class="TemplateMin"><span class="TemplateMin">Update Date:</span>
                             <?php  
                                $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
                                $resp = file_get_contents($url, FALSE);
                                $resp = json_decode($resp);
                                  echo $resp[0]->{'sent_date'};
                            ?>
                            </tr>
                            <tr>-->
                            
                            <!-- <td class="TemplateMin"><span class="TemplateMin">Inserted Date:</span>
                             <?php  
                                $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
                                $resp = file_get_contents($url, FALSE);
                                $resp = json_decode($resp);
                                  echo $resp[0]->{'inserted_date'};
                            ?>
                            </tr> -->
                            <!-- END | sent_date & inserted_date -->

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
                                <td><span class="TemplateMin">Ключевые слова:</span><span class="SKeywords">
                                <?php echo $template->getKeywords(); ?></td></span>
                            </tr>
                            <?php }?>
                          </table>
                        </div>
                        <div class="futurami">
                          <?php
                            // echo Property_API2::get_template_single_property( $template->getId(), 'Features' ); echo "<br>";
                            // echo Property_API2::get_template_single_property( $template->getId(), 'Additional Features' ); echo "<br>";
                            // echo Property_API2::get_template_single_property( $template->getId(), 'Topic' ); echo "<br>";
                            // echo Property_API2::get_template_single_property( $template->getId(), 'Language support' ); echo "<br>";
                            // echo Property_API2::get_template_single_property( $template->getId(), 'template-hosting-requirements', 'Hosting Requirements' );
                          ?>
                            <style type="text/css">
                                span.SKeywords {
                                    font-size: 15px!important;
                                    color: #8C8C8C !important;
                                    font-weight: 300 !important;
                                }
                                h2 {
                                    margin-top: 30px!important;
                                }
                                b {
                                    font-weight: 500;
                                    font-size: 15px!important;
                                }
                                .btn, .btn2 {
                                    color: white!important;
                                    font-weight: 400!important;
                                }
                                .btn3 {
                                    color: white!important;
                                    font-weight: 400!important;
                                }
                                .toTop {
                                    color: white!important;
                                }
                                .futurami {
                                    text-align: left;
                                    padding: 8px !important;
                                    line-height: 1.42857143 !important;
                                    vertical-align: top !important;
                                    color: #8C8C8C !important;
                                    font-size: 15px !important;
                                    padding: 8px !important;
                                    line-height: 1.42857143 !important;
                                    vertical-align: top !important;
                                    margin-top: -18px!important;
                                }
                                span.TemplateMin {
                                    color: #333 !important;
                                    font-weight: 500 !important;
                                    font-size: 15px !important;
                                    font-family: Roboto, sans-serif !important;
                                }
                                a {
                                    color: #8C8C8C !important;
                                    font-weight: 300 !important;
                                }
                                td.TemplateMin {
                                    color: #8C8C8C !important;
                                    font-weight: 300 !important;
                                    font-size: 15px !important;
                                    font-family: Roboto, sans-serif !important;
                                }
                                .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                    border-top: none!important;
                                }
                                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                    border-top: none!important;
                                }
                                #table-desk tbody tr td:last-child {
                                    color: #8C8C8C;
                                }
                                .buy_template u {
                                    text-decoration: none;
                                }
                                b {
                                    text-transform: capitalize;
                                }
                                ul > li {
                                    color: #243238;
                                    padding-bottom: 0px;
                                    margin-bottom: 3px;
                                }
                            </style>
                        </div>
    <div class="futurami">
        <?php
        $url = 'https://api.templatemonster.com/products/v2/products/ru?language=ru&ids=' . $id . '&expand=properties';
        $resp = file_get_contents($url, FALSE);

        $resp = json_decode($resp);
        $yield = get_object_vars( $resp[0]->{'properties'} );

        /*key features start*/
        // $feat_image1 = explode(", ", $yield['imageKeyFeatures']);
        // $feat_image2 = explode(", ", $yield['previewScreensOrVideoURLs']);

        if(count($feat_image1) > 1){
            for ($i=0; $i<=count($feat_image1); $i++){
            // echo '<img src="'. $feat_image1[$i] .'">';
            }
        }
        else if($yield['htmlKeyFeatures'] == true){
            // echo $yield['htmlKeyFeatures'];
        }
        else{
            for ($i=0; $i<=count($feat_image2); $i++){
            // echo '<img src="'. $feat_image2[$i] .'">';
            }
        }

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
                
                switch ($key) {
            case 'functionality':
                $tr_key = 'Функционал';
                break;
            case 'features':
                $tr_key = 'Функции';
                break;
            case 'media':
                $tr_key = 'Медия';
                break;      
            case 'webForms':
                $tr_key = 'Веб Формы';
                break;
            case 'additionalFeatures':
                $tr_key = 'Дополнительные функции';
                break;  
            case 'templateSoftwareRequired':
                $tr_key = 'Необходимое програмное обеспечение';
                break;
            case 'templateSources':
                $tr_key = 'Файлы';
                break;
            case 'topic':
                $tr_key = 'Темы';
                break;
            case 'templateHostingRequirements':
                $tr_key = 'Требования по хостингу';
                break;
            case 'animation':
                $tr_key = 'Анимация';
                break;      
            case 'popularity':
                $tr_key = 'Популярность';
                break;
            case 'dateRange':
                $tr_key = 'Дата';
                break;  
            case 'color':
                $tr_key = 'Цвет';
                break;
            case 'demoNoIndex':
                $tr_key = 'Локали';
                break;
            case 'trustedElements':
                $tr_key = 'Поддержка';
                break;
            case 'styles':
                $tr_key = 'Стили';
                break;
            case 'coding':
                $tr_key = 'Код';
                break;
            case 'categoriesView':
                $tr_key = 'Вид Категории';
                break;
            case 'currencies':
                $tr_key = 'Валюты';
                break;
            case 'jqueryScripts':
                $tr_key = 'Скрипты JQuery';
                break;
            case 'magentoExtensions':
                $tr_key = 'Расширения Magento';
                break;
            case 'languageSupport':
                $tr_key = 'Поддержка языков';
                break;
            case 'galleryScript':
                $tr_key = 'Скрипт галереи';
                break;
            case 'additionalInfo':
                $tr_key = 'Дополнительная информация';
                break;
            case 'wordpressCompatibility':
                $tr_key = 'Версия WordPress';
                break;
                
            default:
                $tr_key = $key;
        }
                echo '<strong>' . $tr_key . ': </strong>';
                foreach ( $object as $value => $property_name )
                {
                  echo $property_name . ', ';        
                }
                echo '<br><br>';
                }
              }
        ?>
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