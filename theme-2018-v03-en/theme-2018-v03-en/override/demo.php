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

//shopify redirect fix + all other demos
if ($template->getType()->getId() == 76 || 1==1){
	
if (strpos($previewUrl, '.html') == false) {	
$previewUrl = substr($previewUrl, 0, -1);
}
	
	$symbol = strpos($previewUrl, '?')? '&' : '?';
	header("Location:" . $previewUrl . $symbol . 'i=' . $template_id . '&pr_code=' . PR_CODE, true, 302);
}else {
    $previewUrl = $previewUrl;}
	
//magento redirect when demo is on http
if ($template->getType()->getId() == 27 && strpos($previewUrl, 'https:') == false){
    $previewUrl = substr($previewUrl, 0, -1);
	$symbol = strpos($previewUrl, '?')? '&' : '?';
	header("Location:" . $previewUrl . $symbol . 'i=' . $template_id . '&pr_code=' . PR_CODE, true, 302);
}else {
    $previewUrl = $previewUrl;}
	
//https-vs-http redirect
if(strpos(S_SITE_URL, 'https://') !== false && strpos($previewUrl, 'http://') !== false){
$symbol = strpos($previewUrl, '?')? '&' : '?';
header("Location:" . $previewUrl . $symbol . 'i=' . $template_id . '&pr_code=' . PR_CODE, true, 302); 
}

// redirect to facebook
    if (strpos($previewUrl, "facebook.com") > 0) {
        header("Location:" . $previewUrl, true, 302);
        exit;
    }
    //$type = $template->getPackage()->getVisibleName();
    $type = $template->type->getVisibleName();
	if (mb_strlen($type) > 25) {
        $type = mb_substr($type, 0, 22) . '...';
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
    <meta http-equiv="X-UA-Compatible" content="IE=11; IE=10; IE=9; IE=8;"/>
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
	<link rel="stylesheet" type="text/css" href="<?php echo FRONTEND_DIR ?>/css/fontello-embedded.css"/>
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
    
    
    <script>
    $(function () {
    
    $('#frame_controls .device_item').click(function(){
            $(this).siblings().removeClass('device_current');
            $(this).addClass('device_current');
            var className = $(this).data('device');
            $('#showframe').attr('class', className);
            return false;
        });
        
    });
    </script>
    <style>
    /* Frame with demo-----  */

/* Desktop */
#showframe {
	width: 100%;
	margin: 0 auto;	
	/*
	position: relative;
	z-index: 1;
	*/
}
	#showframe .hide_wrap {
		overflow: hidden;
	}
	#showframe iframe {
		width: 100%;
		height: 100%;
		display:block;
		vertical-align: top;
	}

/* Tablet landscape */
#showframe.tab_land {
	margin-top: 30px;
	/*width: 1224px;*/
	width: 1200px;
	padding: 38px 103px 37px 85px;
	background: url(../images/tab_landscape.png) 0 0 no-repeat;
}
	#showframe.tab_land .hide_wrap {
		width: 1024px;
				height: 640px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.tab_land .hide_wrap iframe {
		width: 1041px !important;
		height: 640px !important;
	}

/* Tablet portrait */
#showframe.tab_port {
	margin-top: 30px;
	/*width: 480px;*/
	width: 540px;
	padding: 65px 27px 78px 28px;
	background: url(../images/tab_portrait.png) 0 0 no-repeat;
}
	#showframe.tab_port .hide_wrap {
		width: 480px;
		height: 640px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.tab_port .hide_wrap iframe {
		width: 497px !important;
		height: 640px !important;
	}

/* Tablet mobile */
#showframe.mobile {
	margin-top: 30px;
	/*width: 320px;*/
	width: 360px;
	padding: 92px 19px 102px 19px;
	background: url(../images/mobile.png) 0 0 no-repeat;
}
	#showframe.mobile .hide_wrap {
		width: 320px;
		height: 520px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.mobile .hide_wrap iframe {
		width: 337px !important;
		height: 520px !important;
	}
#frame_controls .device_tablet_landscape:before{
    transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);

}

/* Mobile landscape */
#showframe.mobile_land {
	margin-top: 30px;
	/*width: 1024px;*/
	width: 800px;
	padding: 15px 103px 37px 90px;
	background: url(../images/mobile_landscape.png) 0 0 no-repeat;
}
	#showframe.mobile_land .hide_wrap {
		width: 1024px;
				height: 640px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.mobile_land .hide_wrap iframe {
		width: 520px !important;
		height: 320px !important;
	}
	#frame_controls .device_mobile_landscape:before{
    transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);

}

/*Device Styles start*/
#frame_controls {
	display: inline-block;
	vertical-align: top;
	height:100%;
	/*
	margin-left:10em;
	*/
}
	#frame_controls .device_item {
		display: inline-block;
		vertical-align: top;
		/*font-size: 1.5em;*/
		height: 54px;
		/*line-height: 54px;*/
		text-align:center;
		
		width: 54px;
		margin-left:2px;
		/*background-color: #233448;*/
		
		/*padding: 0 12px;*/
		color: #546171;
	}
	#frame_controls .device_item:hover {
		color: #fff;
		/*
		background-color: #15e27f;
		*/
	}
	#frame_controls .device_current {
		color: #fff;	/* #15e27f; */
		/*
		background-color: #15e27f;
		*/
	}
/*Device Styles End*/
	.pricer{
		max-width:100px!important;
		min-width:100px!important;	
		}
		
    </style>
    <style>
	/*Advanced Styles*/
a {
	text-decoration: none;
	-webkit-transition: color .3s ease, background-color .3s ease;
	    -ms-transition: color .3s ease, background-color .3s ease;
	        transition: color .3s ease, background-color .3s ease;
}
body, a, a:visited, a:active {
	color: #fff;
}
a:active {
	outline: none;
}

[class*="icon-"]:before {
	margin:0;
	padding:0;
	line-height:inherit;
	vertical-align:baseline;
}


#header {
	background-color: #0a1d33;
	height: 54px;
	text-align: center;
	position: relative;
	z-index: 2;
}
#header:after {
	content:' ';
	display:block;
	width: 100%;
	height:0;
	clear:both;
}

#header .left_col {
	float: left;
	height: 54px;
}

	#logo {
		display: inline-block;
		vertical-align: top;
		text-align:center;
		/*margin-right: 1px;*/
	}
		#logo img {
			vertical-align: top;
			width: auto;
			height: 54px;
			max-height:100%;
		}

	#socials {
		display: inline-block;
		vertical-align: top;
		height:100%;
	}
		#socials .social_item {
			display: inline-block;
			vertical-align: top;
			font-size: 16px;
			width: 54px;
			height: 54px;
			line-height: 54px;
			text-align:center;
			/*
			margin-left:2px;
			background-color: #233448;
			*/
			border-right: 1px solid #2f3f51;
		}
	

	#theme_selector {
		display: inline-block;
		vertical-align: top;
		color: #dedfe0;
		position:relative;
		/*
		background-color: #233448;
		margin-left: 2px;
		*/
		border-right: 1px solid #2f3f51;
		text-align: left;
	}
		#theme_selector .current_theme {
			display: block;
			width: 390px;
			height: 54px;
			line-height: 54px;
			overflow:hidden;
			padding: 0 3em 0 2em;
			color: #dedfe0;
			-webkit-box-sizing: border-box;
				-ms-box-sizing: border-box;
					box-sizing: border-box;
		}
		#theme_selector .current_theme:hover {
			color: #fff;
		}
		#theme_selector .current_theme:after {
			content: '\e825';
			font-family: 'fontello';
			display:inline-block;
			vertical-align:top;
			line-height: 56px;
			font-size: 1.25em;
			position:absolute;
			z-index:1;
			right: 1.5em;
			top: 0;
			-webkit-transition: -webkit-transform 0.5s ease;
			-ms-transition: -ms-transform 0.5s ease;
			transition: transform 0.5s ease;
		}
		#theme_selector .current_theme:hover:after {
			color: #fff;
		}
		#theme_selector .theme_selector_opened:after {
			-webkit-transform: rotate(180deg);
			-ms-transform: rotate(180deg);
			transform: rotate(180deg);
		}
			#theme_selector .current_theme_name {
				width: 100%;
				overflow: hidden;
			}
		#theme_selector .related_themes {
			display: none;
			width: 390px;
			padding: 2em;
			-webkit-box-sizing: border-box;
				-ms-box-sizing: border-box;
					box-sizing: border-box;
			position: absolute;
			left: 0;
			top: 54px;
			background-color: #0a1d33;
		}
			#theme_selector .themes_list {
				list-style: none;
				padding: 0;
				margin: 0;
			}
			#theme_selector .themes_list li {
				position: relative;
				padding-left: 2em;
			}
			#theme_selector .themes_list li:before {
				content: " ";
				display: block;
				position: absolute;
				top: 11px;
				left: 0;
				width: 1em;
				height: 2px;
				background-color: #15e27f;
			}
			#theme_selector .themes_list li a {
				display:block;
				color: #dedfe0;
			}
			#theme_selector .themes_list li.active a,
			#theme_selector .themes_list li a:hover {
				color: #15e27f;
			}
			#theme_selector .themes_list li + li {
				margin-top: 0.5em;
			}
			#theme_selector .placeholder {
				width: 100%;
				margin-top: 1em;
			}
			#theme_selector .placeholder img {
				width: 100%;
				max-width:100%;
				height: auto;
				vertical-align: top;
			}

#frame_controls {
	display: inline-block;
	vertical-align: top;
	height:100%;
	/*
	margin-left:10em;
	*/
}
	#frame_controls .device_item {
		display: inline-block;
		vertical-align: top;
		font-size: 1.5em;
		height: 54px;
		line-height: 54px;
		text-align:center;
		/*
		width: 54px;
		margin-left:2px;
		background-color: #233448;
		*/
		padding: 0 12px;
		color: #546171;
	}
	#frame_controls .device_item:hover {
		color: #fff;
		/*
		background-color: #15e27f;
		*/
	}
	#frame_controls .device_current {
		color: #fff;	/* #15e27f; */
		/*
		background-color: #15e27f;
		*/
	}
	#frame_controls .device_tablet_landscape:before {
		-webkit-transform:rotate(-90deg);
			-ms-transform:rotate(-90deg);
				transform:rotate(-90deg);
	}


#header .right_col {
	float: right;
	display:inline-block;
	vertical-align: top;
	height: 54px;
}
	#header .right_col > a {
		display: inline-block;
		vertical-align:top;
		height: 54px;
		line-height:54px;
		text-align:center;
		padding: 0 3.4em;
		font-size: 10px;
		font-weight:bold;
		text-transform: uppercase;
		letter-spacing:1px;
		/*
		margin-left: 2px;
		background-color: #233448;
		*/
		border-left: 1px solid #2f3f51;
	}
	#header .right_col > a:hover {
		background-color: #ff1f00;
	}
	#header .right_col > a:before {
		margin-right: 0.5em;
		vertical-align: top;
		font-size:1.25em;
	}
	#header .right_col > a.docs {
		padding: 0 3.6em;
	}
	#header .right_col > a.purchase {
		color: #fff;
		background-color: #15e27f;
		padding: 0 4em;
		border-left: none;
	}
	#header .right_col > a.purchase:hover,
	#header .right_col > a.docs:hover {
		color: #0a1d33;
		background-color: #f7f7f7;
	}
	#header .right_col > a.closeframe {
		padding:0 !important;
		letter-spacing:0 !important;
		width: 54px;
		visibility: hidden;
	}
	#header .right_col > a.closeframe:hover {
		color: #15e27f;
		background-color: #0a1d33;
	}
	#header .right_col > a.closeframe:before {
		margin-right: 0;
	}


.openframe,
.basket {
	display: block;
	width: 54px;
	height: 54px;
	line-height:54px;
	background-color: #0a1d33;
	text-align:center;
	font-size: 14px;
	font-weight:bold;
	text-transform: uppercase;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 3;
	-webkit-transition: color 0.3s ease, background-color 0.3s ease;
	-ms-transition: color 0.3s ease, background-color 0.3s ease;
	transition: color 0.3s ease, background-color 0.3s ease;
}
.basket {
	background-color:#15e27f;
	z-index: 1; 
	font-size: 18px;
}
.basket:hover {
	color: #0a1d33;
	background-color: #f7f7f7;	
}
.openframe:before {
	content: '\e815';
	font-family: 'fontello';
	display: inline-block;
	width: 1em;
	height: 1em;
	line-height: 1em;
	-webkit-transform: rotate(-90deg);
	-ms-transform: rotate(-90deg);
	transform: rotate(-90deg);
	-webkit-transition: -webkit-transform 0.5s ease;
	-ms-transition: -ms-transform 0.5s ease;
	transition: transform 0.5s ease;
}
body.header_off .openframe:before {
	/*
	content: '\e829';
	*/
	-webkit-transform: rotate(90deg);
	-ms-transform: rotate(90deg);
	transform: rotate(90deg);
}
.openframe:hover {
	color: #15e27f;
	background-color: #0a1d33;
}


/* Frame with demo
-----------------------------  */

/* Desktop */
#showframe {
	width: 100%;
	margin: 0 auto;	
	/*
	position: relative;
	z-index: 1;
	*/
}
	#showframe .hide_wrap {
		overflow: hidden;
	}
	#showframe iframe {
		width: 100%;
		height: 100%;
		display:block;
		vertical-align: top;
	}

/* Tablet landscape */
#showframe.tab_land {
	margin-top: 30px;
	width: 1224px;
	padding: 38px 103px 37px 85px;
	background: url(../images/tab_landscape.png) 0 0 no-repeat;
}
	#showframe.tab_land .hide_wrap {
		width: 1024px;
		height: 640px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.tab_land .hide_wrap iframe {
		width: 1041px !important;
		height: 640px !important;
	}

/* Tablet portrait */
#showframe.tab_port {
	margin-top: 30px;
	width: 540px;
	padding: 65px 27px 78px 28px;
	background: url(../images/tab_portrait.png) 0 0 no-repeat;
}
	#showframe.tab_port .hide_wrap {
		width: 480px;
		height: 640px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.tab_port .hide_wrap iframe {
		width: 497px !important;
		height: 640px !important;
	}

/* Tablet mobile */
#showframe.mobile {
	margin-top: 30px;
	width: 360px;
	padding: 92px 19px 102px 19px;
	background: url(../images/mobile.png) 0 0 no-repeat;
}
	#showframe.mobile .hide_wrap {
		width: 320px;
		height: 520px;
		-webkit-border-radius: 3px;
			-ms-border-radius: 3px;
				border-radius: 3px;
	}
	#showframe.mobile .hide_wrap iframe {
		width: 337px !important;
		height: 520px !important;
	}




@media (max-width: 1529px) {
	body {
		font-size:13px;
		line-height:20px;
	}
	#header,
	#header .left_col,
	#header .right_col,
	#logo img {
		height:42px;
	}
	#socials .social_item {
		font-size: 14px;
		width: 42px;
		height: 42px;
		line-height: 42px;
	}
	#theme_selector .current_theme {
		width: 300px;
		height: 42px;
		line-height: 42px;
		padding: 0 2em 0 1.5em;
	}
	#theme_selector .current_theme:after {
		line-height: 42px;
		right: 1em;
	}
	#theme_selector .related_themes {
		width: 300px;
		padding: 1.5em;
		top: 42px;
	}
	#frame_controls .device_item {
		height: 42px;
		line-height: 42px;
		padding: 0 10px;
	}
	#header .right_col > a {
		height: 42px;
		line-height:42px;
		padding: 0 2em !important;
	}
	#header .right_col > a.closeframe {
		width: 42px;
	}
	.openframe,
	.basket {
		width: 42px;
		height: 42px;
		line-height:42px;
		font-size: 12px;
	}
}
@media (max-width: 1199px) {
	#frame_controls {
		display:none;
	}
}
@media (max-width: 1023px) {
	#header .right_col > a.docs {
		display: none;
	}
}
@media (max-width: 959px) {
	#header .right_col > a.customization {
		display: none;
	}
}
@media (max-width: 767px) {
	#socials {
		display: none;
	}
	#theme_selector .current_theme {
		width: 270px;
		padding: 0 1.5em 0 1em;
	}
	#theme_selector .current_theme:after {
		right: 0.5em;
	}
	#theme_selector .related_themes {
		width: 270px;
		padding: 1em;
	}
	#header .right_col > a {
		font-size: 10px;
	}
}
@media (max-width: 639px) {
	#theme_selector .current_theme {
		display: none;
	}
}
@media (max-width: 479px) {
	body {
		font-size:12px;
		line-height:18px;
	}
	#header,
	#header .left_col,
	#header .right_col,
	#logo img {
		height:36px;
	}
	#socials .social_item {
		font-size: 14px;
		width: 36px;
		height: 36px;
		line-height: 36px;
	}
	#header .right_col > a {
		height: 36px;
		line-height:36px;
		font-size: 10px;
	}
	#header .right_col > a.purchase {
		letter-spacing:0;
	}
	#header .right_col > a.closeframe {
		width: 36px;
	}
	.openframe,
	.basket {
		width: 36px;
		height: 36px;
		line-height:36px;
	}
}
	</style>
    
    
    
</head>
<body id="fullscreen-preview">    
    <div id="preview-bar">
        <ul id="bar-inner">
            <li class="tm-logo block">
                <a href="<?php echo S_SITE_URL ?>">
                    <img src="<?php echo FRONTEND_DIR ?>/images/Logo_white.png" alt="">
                </a>
            </li>
            <li class="block inner info">
                <?php echo $type ?> #<?php echo $template->getId(); ?>
            </li>
            <!--responsivator HTML-->
            <li class="block inner info" id="frame_controls">
                <a href="#" class="icon-desktop device_item device_desktop device_current" data-width="100%" data-device="desktop"></a>
                <!--<a href="#" class="icon-tablet device_item device_tablet_landscape" data-width="960" data-device="tab_land"></a>-->
                <a href="#" class="icon-tablet device_item device_tablet_portrait" data-width="480" data-device="tab_port"></a>
                <a href="#" class="icon-mobile device_item device_mobile" data-width="320" data-device="mobile"></a>
                <!--<a href="#" class="icon-mobile device_item device_mobile_landscape" data-width="320" data-device="mobile_land"></a>-->
			</li>
            
            <?php if(WEBSTUDIO == 'true') { ?>
            <li class="block inner">
                <!-- a class="btn2 fancybox order" href="#request-form-wrapper" data-id="//www.templatehelp.com/preset/cart.php?act=add&templ=<?php // echo $template->getId() ?>&pr_code=<?php // echo PR_CODE ?>">Order Website</a> -->
                <a class="btn2 fancybox order" href="#request-form-wrapper" data-id="https://www.templatehelp.com/preset/pr_preview.php?i=<?php echo $template->getId() ?>&pr_code=<?php echo PR_CODE ?>">Order Website</a>
            </li>
            <?php } else { ?>
            <li class="block inner"><a href="<?php echo str_replace('http', 'https', htmlentities($template->getBuyUrl()))?>" class="btn2">
            	Buy Now 
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
            </a></li>
            <?php } ?>
            <a href="#" id="close">Close</a>
        </ul>
    </div>
    <!--<div id="iframelive" class="no-responsive">-->
    <div id="showframe">
        
        <div id="preview-wrapper" class="hide_wrap">
        
            <?php if ($previewUrl != '') {
                if (stristr($previewUrl, '.jpg')) {
                    $previewUrl = substr($previewUrl, 0, -1);
					$symbol = strpos($previewUrl, '?')? '&' : '?';
                } ?>
                <iframe id="preview" frameborder="0" src="<?php echo (substr($previewUrl, stripos($previewUrl, '//')) . $symbol . '?i=' . $template_id . '&pr_code=' . PR_CODE); ?>" data-src="<?php echo $previewUrl; ?>"
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