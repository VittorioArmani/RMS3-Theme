<?php
/**
 * @var $template Theme_Template
 */
$id = $template->getId();
$idCategory = $template->getType()->getId();
$folder = floor($id / 100);
$url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-big.jpg";
$components->default->classes();
if ($template->getType()->getId() == 5 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-vl.jpg";
}
if ($template->getType()->getId() == 7 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-vci.jpg";
}
if ($template->getType()->getId() == 3 || $template->getType()->getId() == 9 || $template->getType()->getId() == 33 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-b.jpg";
}
if ($template->getType()->getId() == 11 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-ls.jpg";
}
if ($template->getType()->getId() == 12 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-is.jpg";
}
if ($template->getType()->getId() == 13 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-bswi.jpg";
}
if ($template->getType()->getId() == 30 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-b-music.jpg";
}
if ($template->getType()->getId() == 32 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-b-master.jpg";
}
if ($template->getType()->getId() == 38 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-b-silver.jpg";
}
if ($template->getType()->getId() == 49 || $template->getType()->getId() == 50 || $template->getType()->getId() == 57 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-ae-s.jpg";
}
if ($template->getType()->getId() == 52 || $template->getType()->getId() == 55 ) {
    $url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-facebook-b.jpg";
}
$var = (empty($_SERVER['HTTPS']) ? 'http:' : 'https:') . $url_image;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $var);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$output = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($status != 200 ) {
    $var1 = Moto_Tools::getTemplatePreviewUrl($template->getId());
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $var1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $output1 = curl_exec($ch);
    $status1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}
?>
<div class="template-screenshots">
    <?php
    /* display live demo link only if required */
    $previewUrl = Moto_Tools::getTemplatePreviewUrl($template->getId());
    if ( isset($previewUrl) && strlen($previewUrl) != 0 ) { ?>
        <!-- display live demo -->
        <div id="slider" class="owl-carousel">
            <div class="item"><a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank"><img id="url234" src="<?php
                if ($status == 200) {
                    echo $url_image;
                } else {
                    if ($status1 == 200) {
                    echo $template->main_preview;
                }}
            ?>"/></a></div>
            <?php foreach ($tpage as $num => $scr): ?>
                <?php if (!$scr->isHead()): ?>
                    <?php if (substr($scr->getUrl(), strrpos($scr->getUrl(), "."), strlen($scr->getUrl())) == '.html'): ?>
                        <?php
                        if (preg_match('#screenshots/\d+/(\d+).*#', $scr->getUrl(), $matches)) {
                            $id = $matches[1];
                        } else {
                            //$id = 0;
                        }
                        $preview = true;
                        if (strpos($scr->getUrl(), 'fl-cms')) {
                            $url = '//templates.cms-guide.com/' . $id . '/admin/';
                            $preview = false;
                        } elseif (strpos($scr->getUrl(), 'tw-adm')) {
                            $url = '//' . $id . '.templates.site2you.com/e-admin.v3/login.php?txtUserId=demo&txtPassword=demo';
                            $preview = false;
                        } else {
                            $url = '/ru/demo/' . $id . '.html';//getTemplatePreviewUrl($id);
                        }
                        $name = $preview ? 'preview' : 'panel';
                        ?>
                    <?php else: ?>
                        <div class="item"><a href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" target="_blank">
                            <img id="url<?php echo $num ?>" src="<?php echo $scr->getUrl() ?>" <?php echo $scr->getWidth() > 0 ? 'width="' . $scr->getWidth() . '"' : '' ?> <?php echo $scr->getHeight() > 0 ? 'height="' . $scr->getHeight() . '"' : '' ?> />
                            <img id="url<?php echo $num ?>" src="<?php echo $template->main_preview ?>" <?php echo $scr->getWidth() > 0 ? 'width="' . $scr->getWidth() . '"' : '' ?> <?php echo $scr->getHeight() > 0 ? 'height="' . $scr->getHeight() . '"' : '' ?> />
                        </a></div>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <a href="<?php echo S_SITE_URL ?>/demo/<?php echo $id ?>.html" class="btn2 view-demo" target="_blank">View Demo</a>
    <?php } else { ?>
        <!-- hide live demo -->
        <div id="slider" class="owl-carousel">
            <div class="item"><img id="url234" src="<?php
                if ($status == 200) {
                    echo $url_image;
                } else {
                    if ($status1 == 200) {
                    echo $template->main_preview;
                }}
            ?>" alt=""></div>
            <?php foreach ($tpage as $num => $scr): ?>
                <?php if (!$scr->isHead()): ?>
                    <?php if (substr($scr->getUrl(), strrpos($scr->getUrl(), "."), strlen($scr->getUrl())) == '.html'): ?>
                        <?php
                        if (preg_match('#screenshots/\d+/(\d+).*#', $scr->getUrl(), $matches)) {
                            $id = $matches[1];
                        } else {
                            //$id = 0;
                        }
                        $preview = true;
                        if (strpos($scr->getUrl(), 'fl-cms')) {
                            $url = '//templates.cms-guide.com/' . $id . '/admin/';
                            $preview = false;
                        } elseif (strpos($scr->getUrl(), 'tw-adm')) {
                            $url = '//' . $id . '.templates.site2you.com/e-admin.v3/login.php?txtUserId=demo&txtPassword=demo';
                            $preview = false;
                        } else {
                            $url = '/ru/demo/' . $id . '.html';//getTemplatePreviewUrl($id);
                        }
                        $name = $preview ? 'preview' : 'panel';
                        ?>
                    <?php else: ?>
                        <div class="item">
                            <img id="url<?php echo $num ?>" src="<?php echo $scr->getUrl() ?>" <?php echo $scr->getWidth() > 0 ? 'width="' . $scr->getWidth() . '"' : '' ?> <?php echo $scr->getHeight() > 0 ? 'height="' . $scr->getHeight() . '"' : '' ?> />
                            <img id="url<?php echo $num ?>" src="<?php echo $template->main_preview ?>" <?php echo $scr->getWidth() > 0 ? 'width="' . $scr->getWidth() . '"' : '' ?> <?php echo $scr->getHeight() > 0 ? 'height="' . $scr->getHeight() . '"' : '' ?> />
                        </div>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php } ?>
</div>
<div id="properties">
  <style>
    #properties div {
      color:black;
      font-size: 14px;
      border: 0px solid #bf130a;
      float:left;
      text-align:left;
      margin-bottom:10px;
    }
    #properties ul {
      padding: 0 0 0 10px;
    }
  </style>
  <p style="font-size:20px; text-align:left; color:black; margin-top:20px; padding-left:15px">Caratteristiche:</p>
  <?php /*
  $components->default->property();
  echo Property_API2::get_template_single_property( $template->getId(), 'Short description', 'Template Description' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Features' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Additional Features' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Topic' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Coding' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Categories View' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Functionality' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Animation' );
  echo Property_API2::get_template_single_property( $template->getId(), 'productFamily', 'Product Family' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Layout' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Media' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Web Forms' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Language support' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Gallery Script' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Currencies' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Notice' );
  echo Property_API2::get_template_single_property( $template->getId(), 'template-hosting-requirements', 'Hosting Requirements' );
  echo Property_API2::get_template_single_property( $template->getId(), 'image-description', 'image-description' );
  */?>
</div>


<style>
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}
/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}
/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}
/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}
/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
	text-align:left!important;
}
div.tab{
margin-top:20px;
}
</style>
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'London')">Informazioni sull'articolo</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Caratteristiche</button>
</div>

<div id="London" class="tabcontent" style="display:block">
	
	<?php 
	//$components->default->property();
	echo Property_API2::get_template_single_property( $template->getId(), 'image-key-features', 'image-key-features' );
	?>
	
	
</div>

<div id="Paris" class="tabcontent">
<?php
  echo Property_API2::get_template_single_property( $template->getId(), 'Short description', 'Template Description' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Features' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Additional Features' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Topic' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Coding' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Categories View' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Functionality' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Animation' );
  echo Property_API2::get_template_single_property( $template->getId(), 'productFamily', 'Product Family' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Layout' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Media' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Web Forms' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Language support' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Gallery Script' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Currencies' );
  echo Property_API2::get_template_single_property( $template->getId(), 'Notice' );
  echo Property_API2::get_template_single_property( $template->getId(), 'template-hosting-requirements', 'Hosting Requirements' );
  //echo Property_API2::get_template_single_property( $template->getId(), 'image-description', 'image-description' );
  ?>
</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
