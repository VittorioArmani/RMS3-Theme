<?php
$components->default->init(array('page' => $page));
?>
<!DOCTYPE html>
<html lang="it">
    <head>       
        <title><?php
        if ( WHERE_WE_NOW == 'preview' ) {
            $components->default->property();
            //echo str_replace("<br>","", substr(strstr(Property_API2::get_template_single_property( $template->getId(), 'Name of the template', 'Name of the template' ), ": "), 2));
            $url = 'https://api.templatemonster.com/products/v2/products/it?language=it&ids=' . $template->getId() . '&expand=properties';
$resp = file_get_contents($url, FALSE);
$resp = json_decode($resp);
echo $resp[0]->{'templateFullTitle'};
        }else{
        echo $page->getHtmlTitle();
        }  
        ?></title>
        
        <?php $components->default->metas(array('metas' => $page->getMetas())) ?>
        <?php
            /* home */
            if ( WHERE_WE_NOW == 'index' ) {
                $canonical_page_url = S_SITE_URL;
                $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
            }
            /* preview */
            if ( WHERE_WE_NOW == 'preview' ) {
                $site_url = S_SITE_URL;
                if (substr($site_url, -1) == "/" ) {
                    $site_url = rtrim ($site_url, "/");
                    $url_type = "/" . $template->type->getAlias() . "-type";
                }
                $canonical_page_url = $site_url . $url_type . '/' . $template->getId() . '.html';
                $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
            }
            /* catalog */
            if ( WHERE_WE_NOW == 'catalog' && isset($num_page) ) {
                $site_url = S_SITE_URL;
                if (substr($site_url, -1) == "/" ) {
                    $site_url = rtrim ($site_url, "/");
                }
                if ($catalog->getName() == 'category') {
            /* the one category page */
                    if ($num_page == 1 && $max_page == 1) {
                        $rel_prev_page_url = '';
                        $canonical_page_url = $site_url . substr(util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), 1),0,strripos(util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias()), "/", 1)) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the first category page */
                    if ($num_page == 1 && $num_page != $max_page) {
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '">'."\n";
                        $canonical_page_url = $site_url . substr(util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), 1),0,strripos(util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias()), "/", 1)) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the second category page */
                    if ($num_page == 2 && $num_page != $max_page) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page - 1) . '">'."\n";
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '">'."\n";
                        $canonical_page_url = $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page);
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the category page in catalog */
                    if ($num_page > 2 && $num_page != $max_page) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page - 1) . '">'."\n";
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '">'."\n";
                        $canonical_page_url = $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page);
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the last category page in catalog */
                    if ($num_page == $max_page && $max_page != 1) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page - 1) . '">'."\n";
                        $canonical_page_url = $site_url . util::category_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page);
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
                }
                if ($catalog->getName() == 'type') {
            /* the one type page */
                    if ($num_page == 1 && $max_page == 1) {
                        $rel_prev_page_url = '';
                        $canonical_page_url = $site_url . '/' . $catalog->getAlias() . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the first type page */
                    if ($num_page == 1 && $num_page != $max_page) {
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '/' . '" >'."\n";
                        $canonical_page_url = $site_url . substr(util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), 1),0,strripos(util::type2url($catalog->getUrlPattern(), $catalog->getAlias()), "/", 1)) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the second type page */
                    if ($num_page == 2 && $num_page != $max_page) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . substr(util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), 1),0,strripos(util::type2url($catalog->getUrlPattern(), $catalog->getAlias()), "/", 1)) . '/' . '">'."\n";
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '/' . '">'."\n";
                        $canonical_page_url = $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the type page in catalog */
                    if ($num_page > 2 && $num_page != $max_page) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page - 1) . '/' . '">'."\n";
                        $rel_next_page_url = '<link rel="next" href="' . $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page + 1) . '/' . '">'."\n";
                        $canonical_page_url = $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
            /* the last type page in catalog */
                    if ($num_page == $max_page && $max_page != 1) {
                        $rel_prev_page_url = '<link rel="prev" href="' . $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page - 1) . '/' . '">'."\n";
                        $canonical_page_url = $site_url . util::type_pages2url($catalog->getUrlPattern(), $catalog->getAlias(), $num_page) . '/';
                        $link_rel_canonical = '<link rel="canonical" href="' . $canonical_page_url . '">'."\n";
                    }
                }
            /* meta */
                if ($num_page > 1) {
                    echo '<meta name="robots" content="noindex">'."\n";
                }
            }
            if ( WHERE_WE_NOW == 'search' ) {
                echo '<meta name="robots" content="noindex, nofollow">'."\n";
                $canonical_page_url = S_SITE_URL . 'search/';
            }
            /* output */
            if ( isset($link_rel_canonical) ) {
                echo $link_rel_canonical;
            }
            if ( isset($rel_prev_page_url) ) {
                echo $rel_prev_page_url;
            }
            if ( isset($rel_next_page_url) ) {
                echo $rel_next_page_url;
            }
        ?>
        <link href='//fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/normalize.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/styles.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/preview.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/owl-carousel.css"/>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/preloader.css"/>-->
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/tm-livechat.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/rd-navbar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/swiper.min.css">
        <link rel="icon" type="image/png" href="<?php echo FRONTEND_DIR?>/images/favicon.png"/>
        <?php $components->script->plugins(); ?>
        <script type="text/javascript">
            window.su = '<?php echo S_SITE_URL ?>';
        </script>
        <?php if (WEBSTUDIO == 'true') { ?>
            <script type="text/javascript">
                window.we = '<?php echo WEBSTUDIO_EMAIL ?>';
            </script>
        <?php } ?>
        <script type="text/javascript" src="<?php echo FRONTEND_DIR ?>/js/main.js"></script>
        <?php if (WHERE_WE_NOW != "preview") { ?>
            <script type="text/javascript">
                var templatesArray = new Array();
            </script>
        <?php } else { ?>
            <script type="text/javascript" src="<?php echo FRONTEND_DIR ?>/js/inner_pages.js"></script>
        <?php } ?>
        <?php $components->script->text_block(array('text' => $page->getGlobalText('GLOBAL_HEAD_SCRIPT'))) ?>
        <?php $components->script->text_block(array('text' => $page->getText('HEAD_SCRIPT'))) ?>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->
		<!-- <script type="text/javascript" src="<?php // echo FRONTEND_DIR?>/js/carhartl-jquery-cookie/jquery.cookie.js"></script> 
	    <script type="text/javascript" src="<?php // echo FRONTEND_DIR?>/js/tm-livechat.min.js"></script> -->
     </head>

<?php if ( PRELOADER == 'true' ) { ?>
<?php 
$body_clases = '';

    if( WEBSTUDIO == 'true' ){

        $body_clases = 'webstudio-on';

        if(  PRELOADER == 'true' ){
            $body_clases = 'webstudio-on no-scroll-y';            
        }
    } elseif( PRELOADER == 'true' && WEBSTUDIO != 'true') {
        // $body_clases = 'webstudio-off'; 
        $body_clases = 'no-scroll-y webstudio-off';
    } else {
       $body_clases = 'webstudio-off'; 
    }

?>
<body class="<?php echo $body_clases; ?>">
<!-- Preloader -->
<section>
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
            </div>  
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
</section>

<?php } else { ?>

<body class="<?php if (WEBSTUDIO == 'true') { ?>webstudio-on<?php } else { ?>webstudio-off<?php } ?>">

<?php } ?>

<body class="<?php if (WEBSTUDIO == 'true') { ?>webstudio-on<?php } else { ?>webstudio-off<?php } ?>">

<?php if (ARROW != 'false'){?>
<a href="#" id="toTop" class="toTop fa fa-angle-up" style="display:block;opacity:0">Su</a>
<?php }?>
<div id="page">
    <header id="header">
         
        <!-- RD Navbar -->
        <section class="menu-top">           
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar">
                    <div class="container">
                        <div class="rd-navbar-inner">
                            <!-- RD Navbar Panel -->
                            <div class="rd-navbar-panel">
                                <div class="rd-navbar-panel-canvas"></div>
                                <!-- RD Navbar Toggle -->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                                </button>
                                <!-- END RD Navbar Toggle -->
                                 <!-- RD Navbar Collapse Toggle -->
                                <button class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse">
                                    <span></span>
                                </button>
                                <div class="rd-navbar-collapse">
                                    <?php $components->header->header_content(array('current' => isset($curr_type) ? $curr_type : '', 'current_page' => @$current_page)); ?>
                                </div>
                                <!-- END RD Navbar Collapse Toggle -->
                                <!-- RD Navbar Brand -->
                                <div class="rd-navbar-brand">
                                    <a href="<?php echo S_SITE_URL ?>" class="brand-name">
                                        <img src="<?php echo FRONTEND_DIR .'/images/Logo.png'?>" alt="" />
                                    </a>
                                </div>
                                <!-- END RD Navbar Brand -->
                            </div>
                            <!-- END RD Navbar Panel -->
                        </div>
                        <div class="rd-navbar-outer">
                            <div class="rd-navbar-inner">
                                <div class="rd-navbar-subpanel">
                                    <div class="rd-navbar-nav-wrap">
                                        <!-- RD Navbar Nav -->
                                        <ul class="rd-navbar-nav">
                                         	<li>
                                                <a href="<?php echo S_SITE_URL ?>frequently-asked-questions/">F.A.Q.</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo S_SITE_URL ?>terms-of-use/">Condizioni Generali di Utilizzo</a>
                                            </li> 
                                            <li>
                                                <a href="<?php echo S_SITE_URL ?>privacy-policy/">Informativa Sulla Privacy</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo S_SITE_URL ?>about-us/">Su di Noi</a>
                                            </li>        
                                        </ul>
                                        <!-- END RD Navbar Nav -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- END RD Navbar -->
            <!-- <div class="top_user_menu_container"><?php // $components->default->user_menu(array('current_page'=>@$current_page))?></div> -->
        </section>
        <!-- Search -->
        <section class="advance-search">
            <?php $components->header->header_content(array('current' => isset($curr_type) ? $curr_type : '', 'current_page' => @$current_page)); ?>
        </section>
        <!-- Swiper -->
        <?php if (SLIDER == 'true') { ?>
        <?php if ( WHERE_WE_NOW == 'index' ) { ?>            
            <section class="slider-block swiper-container">          
                <div class="swiper-wrapper">
                  <div class="swiper-slide" style="background-image:url(<?php echo FRONTEND_DIR .'/images/slider-bg-1.png'?>)">
                    <div class="container">
                        <div class="slider-img"><a href="<?php echo S_SITE_URL ?>wordpress-themes-type/55555.html"><img src="<?php echo FRONTEND_DIR .'/images/template-1.png'?>" alt="Slider 1" /></a></div>
                        <div class="slider-caption">
                            <div class="slider-poduct-name">
                                <div class="slider-poduct-title">Migliore Modello per WordPress <br>Tema Multifunzionale</div>
                                <?php if (WEBSTUDIO == 'true') { ?> <?php } else { ?>
                                <div class="slider-poduct-price">A soli<span class="slider-home_price">&nbsp;€69</span></font></div><?php } ?>
                            </div>
                            <div class="slider-poduct-buttons">
                                <a href="<?php echo S_SITE_URL ?>wordpress-themes-type/55555.html" class="btn">Vedi dettagli</a>
                                <a href="<?php echo S_SITE_URL ?>demo/55555.html" target="_blank" class="btn3">Live Demo</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url(<?php echo FRONTEND_DIR .'/images/slider-bg-1.png'?>)">
                    <div class="container">
                        <div class="slider-img"><a href="<?php echo S_SITE_URL ?>wordpress-themes-type/62222.html"> <img src="<?php echo FRONTEND_DIR .'/images/template-2.png'?>" alt="Slider 2" /> </a></div>
                        <div class="slider-caption">
                            <div class="slider-poduct-name">
                                <div class="slider-poduct-title">Monstroid2 - Multi Tema WordPress <br>Modello con Elementor Builder Integrato</div>
                                <?php if (WEBSTUDIO == 'true') { ?> <?php } else { ?>
                                    <div class="slider-poduct-price">A soli<span class="slider-home_price">&nbsp;€66</span></div><?php } ?>
                            </div>
                            <div class="slider-poduct-buttons">
                                <a href="<?php echo S_SITE_URL ?>wordpress-themes-type/62222.html" class="btn">Vedi dettagli</a>
                                <a href="<?php echo S_SITE_URL ?>demo/62222.html" target="_blank" class="btn3">Live Demo</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url(<?php echo FRONTEND_DIR .'/images/slider-bg-1.png'?>)">
                    <div class="container">
                        <div class="slider-img"><a href="<?php echo S_SITE_URL ?>website-templates-type/58888.html"> <img src="<?php echo FRONTEND_DIR .'/images/template-3.png'?>" alt="Slider 3" /> </a></div>
                        <div class="slider-caption">
                            <div class="slider-poduct-name">
                                <div class="slider-poduct-title">Intense Sito Web HTML <br>Modello Multifunzionale</div>
                                <?php if (WEBSTUDIO == 'true') { ?> <?php } else { ?>
                                    <div class="slider-poduct-price">A soli<span class="slider-home_price">&nbsp;€66</span></div><?php } ?>
                            </div>
                            <div class="slider-poduct-buttons">
                                <a href="<?php echo S_SITE_URL ?>website-templates-type/58888.html" class="btn">Vedi dettagli</a>
                                <a href="<?php echo S_SITE_URL ?>demo/58888.html" target="_blank" class="btn3">Live Demo</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url(<?php echo FRONTEND_DIR .'/images/slider-bg-1.png'?>)">
                    <div class="container">
                        <div class="slider-img"><a href="<?php echo S_SITE_URL ?>shopify-themes-type/63842.html"> <img src="<?php echo FRONTEND_DIR .'/images/template-4.png'?>" alt="Slider 4" /> </a></div>
                        <div class="slider-caption">
                            <div class="slider-poduct-name">
                                <div class="slider-poduct-title">Multifly - eCommerce Online Multiuso<br>  Tema Premium Responsive Shopify</div>
                                <?php if (WEBSTUDIO == 'true') { ?> <?php } else { ?>
                                    <div class="slider-poduct-price">A soli<span class="slider-home_price">&nbsp;€118</span></div><?php } ?>
                            </div>
                            <div class="slider-poduct-buttons">
                                <a href="<?php echo S_SITE_URL ?>shopify-themes-type/63842.html" class="btn">Vedi dettagli</a>
                                <a href="<?php echo S_SITE_URL ?>demo/63842.html" target="_blank" class="btn3">Live Demo</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide" style="background-image:url(<?php echo FRONTEND_DIR .'/images/slider-bg-1.png'?>)">
                    <div class="container">
                        <div class="slider-img"> <a href="<?php echo S_SITE_URL ?>woocommerce-themes-type/63000.html"> <img src="<?php echo FRONTEND_DIR .'/images/template-5.png'?>" alt="Slider 5" /> </a></div>
                        <div class="slider-caption">
                            <div class="slider-poduct-name">
                                <div class="slider-poduct-title">Woostroid - Tema WooCommerce <br> WordPress Multifunzionale</div>
                                <?php if (WEBSTUDIO == 'true') { ?> <?php } else { ?>
                                <div class="slider-poduct-price">A soli<span class="slider-home_price">&nbsp;€88</span></div><?php } ?>
                            </div>
                            <div class="slider-poduct-buttons">
                                <a href="<?php echo S_SITE_URL ?>woocommerce-themes-type/63000.html" class="btn">Vedi dettagli</a>
                                <a href="<?php echo S_SITE_URL ?>demo/63000.html" target="_blank" class="btn3">Live Demo</a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button-arrow">
                    <!-- Add Arrows -->                        
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </section> 
        <?php } ?>
        <?php } ?>
       
    </header>
    <main id="content">
        <?php echo $content; ?>
    </main>
	<?php if(BANNERS != 'false' && WHERE_WE_NOW != 'index' && WHERE_WE_NOW != 'catalog' && WHERE_WE_NOW != 'search'){?>
	<section class="banner-features">
        <div class="container">
            <ul class="features-list">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-1">
                                <div class="icon mdi mdi-comment-text-outline"></div>
                                <h5>Premium Assistenza<br> Gratuita 24/7</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-2">
                                <div class="icon mdi mdi-checkbox-marked-circle-outline"></div>
                                <h5>Attività Commerciale<br> Soluzioni Pronte</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-3">
                                <div class="icon mdi mdi-flag-outline"></div>
                                <h5>Qualità Premium<br>  Gagantita</h5>
                            </div>
                        </li>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <li data-equal-group="1">
                            <div class="poligon-4">
                                <div class="icon mdi mdi-account-multiple-outline"></div>
                                <h5>1 200 000+<br> Clienti Soddisfatti</h5>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </section><?php } ?>
	
    <div id="footer">
        <?php $components->footer->footer_content(array('page' => $page, 'current_page' => @$current_page)); ?>
    </div>
<?php

// $productType = '';
// $templateId = '';
    if (PRESALECHAT != 'false') {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    $.tm.livechat({
        actionUrl:'<?php echo FRONTEND_DIR?>/chat.php',
        affId:'<?php echo AFF ?>',
        presetCode:'<?php echo PR_CODE ?>', 
//        productType:'<?php echo $productType ?>',
//        templateId:'<?php echo $templateId ?>',
        title: 'Siamo Online', // title of dialog open button and dialog header
        startChatTitle: 'Avvia la Chat', // title of "Start Chat" button
        content: '<p id="p11"> - Ciao, ti aiuto a scegliere il modello perfetto.</p><p id="p22">Che tipo di sito web stai progettando esattamente?<p>', // dialog text
        mainColor: '#238ED2', // color for dialog header and "Start Chat" button
        secondaryColor: '#333333', // color of arrow, close button and "Start Chat" hover button
        bgColor: '#ffffff', // dialog background color
        textColor: '#333333', // dialog text color
        period: 3, // days
        minSteps: 999, // 
        openAfter: 2, // seconds
        dialogFloat: 'corner', // center/corner
        overlay: false, // yes/no
        blinkPeriod: 10, // seconds
        blinkFrequency: 200, // milliseconds
        blinkCount: 2, //
        init: function(e, data) {} // widget init event
    });
});
</script>
	<script>
	var cw = $('.template_thumbnail').width();
$('.template_thumbnail').css({'height':cw+'px'});
	</script>
<?php }  ?>
</div>
<?php if (WEBSTUDIO == 'true') { ?>
    <div class="popup" id="request-form-wrapper" style="display: none;">
        <div class="popup_cnt" >
            <div class="headline">
                Make an Order
            </div>
            <!-- <span class="btn-close"></span> -->
            <form id="request-form">
                <fieldset>
                    <input type="text" name="name" class="input-name" placeholder="Your Name">
                    <input type="text" name="email" class="input-email" placeholder="E-mail">
                    <input type="text" name="phone" class="input-phone" placeholder="Your Phone">
                    <input type="submit" value="Send" class="btn2 send-button">
                    <div class="confirm-block">
                        <input type="checkbox" name="form_checked" id="form_checked">
                        <span class="text-confirm">I have read and agree to the <a href="<?php echo S_SITE_URL ?>privacy-policy/" target="_blank">Privacy Policy</a></span>
                    </div>
                    <div id="loader-wrapper" class="loader-wrapper" style="display: none">
                        <div id="loader"></div>
                    </div>
                </fieldset>
                <p class="form-answer" style="display: none;"></p>
            </form>
        </div>
    </div>
    <style type="text/css">
        #request-form .confirm-block input#form_checked {
            display: inline-block;
            width: 20px;
            height: 20px;
            font-family: Material Icons;
            font-style: normal;
            font-weight: normal;
            line-height: 57px;
            font-size: 22px;
            color: #0BBA5C;
            margin-right: 6px;
            margin-top: 9px;
            border: 1px solid #8C8C8C;
        }

        #request-form .confirm-block .text-confirm {
            font-family: Roboto;
            font-style: normal;
            font-weight: 300;
            line-height: 40px;
            font-size: 14px;
            color: #8C8C8C;
        }

        #request-form .confirm-block {
            margin-top: 20px;
        }

        .popup_cnt {
            height: 435px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25);
        }

        .btn2.send-button {
            background: #1069AA;
        }

        .btn2.send-button:hover {
            background: #4eb3fd;
        }

        .popup form#request-form {
            padding: 40px 30px 50px;
        }

        .popup #request-form input[type=submit] {
            margin-top: 25px;
            pointer-events: none;
        }

        .popup #request-form input[type=text] {
            width: 100%;
            height: 42px;
            padding-left: 20px;
            padding-right: 20px;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #E5E5E5;
        }

        .popup #request-form label.notvalid {
            position: absolute;
            display: block;
            font-size: 12px;
            color: #2686CD;
            margin-top: -17px;
        }

        body .fancybox-close {
            top: -150px;
            right: -145px;
        }
        .popup .headline {
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            line-height: 22px;
            font-size: 17px;
            padding: 22px;
            background: linear-gradient(89.82deg, #4A66DE 9.79%, #458EEA 49.17%, #2E87CF 87.26%);
            text-align: center;
        }
        .popup p.form-answer {
            background: #fff;
            position: absolute;
            left: 0px;
            width: 100%;
            padding-bottom: 30px;
            font-weight: bold;
        }
        #request-form .confirm-block .text-confirm a:hover {
            color: #8C8C8C;
        }
        #request-form .confirm-block .text-confirm a {
            color: #2686CD;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('#form_checked').click(function() {
                if(jQuery(this).is(':checked')) {
                    jQuery("#request-form .send-button").css('pointer-events', 'visible');
                } else {
                    jQuery("#request-form .send-button").css('pointer-events', 'none');;
                }
            });
        });
    </script>
<?php } ?>
<?php $components->script->text_block(array('text' => $page->getGlobalText('GLOBAL_BOTTOM_SCRIPT'))) ?>
<?php /* $components->script->text_block(array('text' => $page->getText('BOTTOM_SCRIPT'))) */ ?>
<script>var FRONTEND_DIR = "<?php echo FRONTEND_DIR ?>"</script>
<script type="text/javascript" src="<?php echo FRONTEND_DIR ?>/js/script.js"></script>
</body>
</html>