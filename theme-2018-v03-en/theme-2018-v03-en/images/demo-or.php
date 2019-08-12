<?php
$components->default->classes();
$template_id = 0;
if (preg_match('#/([0-9]+)\.html#', $_SERVER['REQUEST_URI'], $match)) {
    $template_id = (int)$match[1];
    if ($template_id > 1) {
        $isReturn = true;
    }
}
if (isset($isReturn) && !$isReturn)
    exit;
$isResponsive = Moto_Tools::isTemplateResponsive($template_id);
// Find template
$template = NULL;
$_template = ORM::factory('template', $template_id);
if ($_template->isExist()) {
    $macrophage = new Theme_Macrophage ();
    $template = new Theme_Template ();
    $template->setMacrophage($macrophage);
    $template->setRecord($_template);
    $template->selectSubsection(NULL);
    $template = $template->restrict();
} else {
    Moto_Config::set('showFooterBanner', false);
    Moto_Config::set('override_do_exit', false);
    ob_start();
    $components->rutm->error();
    $content = ob_get_clean();
    Moto_Config::set('content', $content);
    return;
}
$title = $page->getHtmlTitle();
$title = str_replace('TEMPLATE-ID', $template_id, $title);
if ($template->getType()->getId() == 68) {
    $previewUrl = '//templates.cms-guide.com/' . $template->getId() . '/';
} else {
    $previewUrl = Moto_Tools::getTemplatePreviewUrl($template->getId());
}
if ($template->getType()->getId() == 9 && $previewUrl == '') {
    if ($previewUrl == '') {
        $tpage = $template->getSelectedSubsection()->getScreenshots();
        foreach ($tpage as $scr) {
            if ($scr->isHead() && (substr($scr->getUrl(), strrpos($scr->getUrl(), "."), strlen($scr->getUrl())) == '.html')) {
                $previewUrl = $scr->getUrl();
                $iframeFlashParams = true;
                $iframeWidth = $scr->getWidth();
                $iframeHeight = $scr->getHeight();
            }
        }
    }
}

//shopify

if ($template->getType()->getId() == 76){
    $previewUrl = substr($previewUrl, 0, -1);;
}else {
    $previewUrl = $previewUrl;}

// redirect to facebook
    if (strpos($previewUrl, "facebook.com") > 0) {
        header("Location:" . $previewUrl, true, 302);
        exit;
    }
    $type = $template->getPackage()->getVisibleName();
    if (mb_strlen($type) > 16) {
        $type = mb_substr($type, 0, 14) . '...';
    }
    if (!defined('CALCULATE_DISCOUNT'))
        define('CALCULATE_DISCOUNT', 'false');
    if (!defined('REGULAR_DISCOUNT'))
        define('REGULAR_DISCOUNT', 1);
    $price_discount = '';
    if (CALCULATE_DISCOUNT == 'true') {
        $price = ceil($template->getOriginalPrice() * REGULAR_DISCOUNT);
        if ($price != $template->getOriginalPrice()) {
            $price_discount = ' <span class="old-price price-value">$' . $template->getOriginalPrice() . '</span>';
            $discount = true;
        }
    } else {
        $price = $template->getRegularPrice();
    }
    
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title ?></title>
    <?php $components->default->metas(array('metas' => $page->getMetas())); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8;"/>
    <link rel="canonical" href="<?php echo S_SITE_URL . 'demo/' . $template->getId() . '.html'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR?>/css/jquery.fancybox.css" />
    <link rel="icon" type="image/png" href="<?php echo FRONTEND_DIR?>/images/favicon.png"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo FRONTEND_DIR?>/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo FRONTEND_DIR?>/js/jquery.validate.js"></script>
    <script type="text/javascript" src="<?php echo FRONTEND_DIR?>/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo FRONTEND_DIR?>/js/demo-main.js"></script>
    <script charset="utf-8">
        //TODO: some strange value
        var min_height = 600;
        $(function () {
            resizeFrame();
        });
        function resizeFrame() {
            if (<?php echo (($previewUrl != '')*1)?> == 0
        )
            return false;
            var main_iframe = $('#preview');
            var height = $(window).height() - $('#preview-bar:visible').outerHeight();
            /* if ($.browser.opera)
                height += 5; */
            if (height < min_height)
                height = min_height;
            $('#preview').height(height);
            $('#iframelive').height(height);
            if ($(window).width() < 1400)
                $('#min-hide-this').hide();
            else
                $('#min-hide-this').show();
        }
        $(window).resize(function () {
            resizeFrame();
        }).load(function () {
            resizeFrame();
        });
        $(document).ready(function(){
            $('#close').click(function(e){
                e.preventDefault();
                $('#preview-bar').hide();
            });
        })
    </script>
    <script type="text/javascript">
        window.su = '<?php echo S_SITE_URL ?>';
    </script>
    <?php if(WEBSTUDIO == 'true') { ?>
    <script type="text/javascript">
        window.we = '<?php echo WEBSTUDIO_EMAIL ?>';
    </script>
    <?php } ?>
    
    <script type="text/javascript" src="<?php echo FRONTEND_DIR?>/js/responsive-switch.min.js"></script>
    
    <script>
        
        / Set responsive device
        jQuery('#frame_controls .device_item').click(function(){
            jQuery(this).siblings().removeClass('device_current');
            jQuery(this).addClass('device_current');
            var className = jQuery(this).data('device');
            jQuery('#iframelive').attr('class', className);
            return false;
        });
        
    </script>
    
</head>
<body id="fullscreen-preview">
    <div id="preview-bar">
        <ul id="bar-inner">
            <li class="tm-logo block">
                <a href="<?php echo S_SITE_URL ?>">
                    <img src="<?php echo FRONTEND_DIR ?>/images/logo.png" alt="">
                </a>
            </li>
            
            <li>Hi!
                <!--responsivator-->
            <div style="background-color:white" id="frame_controls"><a href="#" class="icon-desktop device_item device_desktop device_current" data-width="100%" data-device="desktop"></a><a href="#" class="icon-tablet device_item device_tablet_landscape" data-width="960" data-device="tab_land"></a><a href="#" class="icon-tablet device_item device_tablet_portrait" data-width="480" data-device="tab_port"></a><a href="#" class="icon-mobile device_item device_mobile" data-width="320" data-device="mobile"></a>
		</div>
		<!--/responsivator-->
            </li>
            
            
            
         
            <li class="block inner info">
                <?php echo $type ?> #<?php echo $template->getId(); ?>
            </li>
            <?php if(WEBSTUDIO == 'true') { ?>
            <li class="block inner">
                <a href="#request-form-wrapper" class="buy fancybox order" data-id="<?php echo S_SITE_URL . "search/page1.html?keyword=" . $template->getId(); ?>">Order Website</a>
            </li>
            <?php } else { ?>
            <li class="block inner">
            <?php if (defined('CALCULATE_DISCOUNT') && CALCULATE_DISCOUNT == 1): ?>
                <span class="old-price">
                    <?php
                    echo $template->getCurrencySymbol ();
                    echo util::template_price ($template->getRegularPrice());
                    ?>
                </span>
                <span>
                    <?php
                    echo $template->getCurrencySymbol();
                    echo util::template_price ($template->getRegularPrice() * ((DISCOUNT < 0.7) ? 0.7 : DISCOUNT ));
                    ?>
                </span>
            <?php else: ?>
                <span>
                    <?php
                    echo $template->getCurrencySymbol ();
                    echo util::template_price ($template->getRegularPrice());
                    ?>
                <span>
            <?php endif; ?>
            </li>
            <li class="block inner"><a href="<?php echo htmlentities($template->getBuyUrl())?>" class="btn">Buy Template</a></li>
            <?php } ?>
            <a href="#" id="close">Close</a>
        </ul>
    </div>
   
   
    <div id="iframelive" class="no-responsive">
        <div id="hide_wrap" class="hide_wrap">
            <?php if ($previewUrl != '') {
                if (stristr($previewUrl, '.jpg')) {
                    $previewUrl = substr($previewUrl, 0, -1);
                } ?>
                <iframe id="preview" frameborder="0" src="<?php echo substr($previewUrl, stripos($previewUrl, '//')); ?>" data-src="<?php echo $previewUrl; ?>"
                        <?php if (isset($iframeFlashParams) && $iframeFlashParams){ ?>width="<?php echo $iframeWidth ?>"
                        height="<?php echo $iframeHeight ?>" <?php } ?>></iframe>
            <?php
            } else { ?>
                <div class="technical-problems">
                    <p>Technical operations</p>
                    <p class="problems-message">Live demo of this template will be available within 5-6 hours.</p>
                    <p>
                        <a href="<?php echo($template->type->getUrl()); ?>">Go back to the template gallery</a>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php if(WEBSTUDIO == 'true') { ?>
    <div class="popup" id="request-form-wrapper" style="display:none">
        <div class="popup_cnt">
            <div class="headline">
                Fill out the form<br>
                to make an order
            </div>
<!--            <span class="btn-close"></span>-->
            <form id="request-form">
                <fieldset>
                    <label>Your Name:</label>
                    <input type="text" name="name" class="input-name">
                    <label>E-mail:</label>
                    <input type="text" name="email" class="input-email">
                    <label>Your Phone:</label>
                    <input type="text" name="phone" class="input-phone">
                    <input type="submit" value="Send" class="btn2 send-button">
                    <div id="loader-wrapper" class="loader-wrapper" style="display:none">
                        <div id="loader"></div>
                    </div>
                </fieldset>
                <p class="form-answer" style="display:none"></p>
            </form>
        </div>
    </div>
<?php } ?>
</body>
</html>
<?php if (Moto_Tools::isMoto($template) && !Moto_Tools::isMotoHtml($template)) { ?>
    <script type="text/javascript">
    </script>
    <script type="text/javascript" src="<?php echo STATIC_FRONTEND_DIR ?>/js/easyxdm/easyXDM.min.js"></script>
    <script type="text/javascript">
        if (<?php echo (($previewUrl != '')*1)?> == 1) {
            $('#preview-wrapper').html('');
            $(window).resize(function () {
                $('#preview-wrapper').css({'height': $(window).height() - $('#preview-bar').outerHeight() + 'px'});
            });
            var transport = new easyXDM.Socket({
                remote: "<?php echo $previewUrl; ?>",
                swf: "<?php echo FRONTEND_DIR; ?>/js/easyxdm/easyxdm.swf",
                container: "preview-wrapper",
                props: {
                    width: '100%',
                    height: 600
                },
                onMessage: function (message, origin) {
                    if (message < 600) message = 600;
                    $('#preview-wrapper').find("iframe").css({'height': message + 'px'});
                    $('#preview-wrapper').css({'height': $(window).height() - $('#preview-bar').outerHeight() + 'px'});
                    if (message > 700) {
                        $('#preview-wrapper').css({'overflow-y': 'scroll'});
                    }
                    if (message < $('#preview-wrapper').height()) {
                        $('#preview-wrapper').find("iframe").css({'height': $('#preview-wrapper').height() - 5 + 'px'});
                    }
                }
            });
        }
    </script>
<?php } ?>