<?php
/**
 * @var $template Theme_Template
 */
$id = $template->getId();
$idCategory = $template->getType()->getId();
$folder = floor($id / 100);
$url_image = "//scr.templatemonster.com/" . $folder . "00/" . $id . "-b.jpg";
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
<div id="properties">
  <style>
    #properties div {
      color:black;
      font-size: 14px;
      float:left;
      text-align:left;
      margin-bottom:10px;
    }
    #properties ul {
      padding: 0 0 0 10px;
    }
  </style>

</div>

<style>
/* Style the tab */
.tab {
    overflow: hidden;
        background-color: #f1f1f1;
  text-align: left;
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
    text-align:left!important;
}
div.tab{
margin-top:20px;
}
#open-features{
margin-top: 30px;
color:#329DFF;
cursor:pointer;
}
#table-mobile{
  display:none;
  margin-bottom:30px;
}
#table-desk{
  margin-top:40px;
}
@media only screen and (max-width:500px) {
.features-list{
display:none;
}
  #table-desk{
  display:none;
  }
  #table-mobile{
  display:block;  
}
}
.single-property{
  margin-top:20px;
}
</style>
<div class="tab">
   <div class="img_box">
   <?php
     $previewUrl = Moto_Tools::getTemplatePreviewUrl($template->getId());
   function url_exists($url) {
    if(@file_get_contents($url,0,NULL,0,1))
      {return 1;}
    else
      { return 0;}
  }
    $url_image_http = 'http:' . $url_image;
    $url_image_help = 'https://scr.template-help.com/' . $folder . '00/' . $id . '-original.jpg';
    $url_image_tmimgcdn = 'https://s.tmimgcdn.com/scr/' . $folder . '00/' . $id . '-original.png';
    if(url_exists($url_image_help)){
      echo '<img id="url234" class="big_product_img" src="' . $url_image_help . '"alt="' . $template->type->getVisibleName() . '">';
      //echo '<p style="text-align:center; margin-top:30px;"><a id="open-features" data-id="'. $template->getId() .'" ><b style="color:#2686CD">Подробнее</b><br></a></p>'; ?>
      <!-- Property function starts-->
<div  style="padding:20px">
<?php
  $url = 'https://api.templatemonster.com/products/v2/products/en?language=en&ids=' . $id . '&expand=properties';
  $resp = file_get_contents($url, FALSE);

  $resp = json_decode($resp);
  $yield = get_object_vars( $resp[0]->{'properties'} );
  /*key features start*/
  // $feat_image1 = explode(", ", $yield['imageKeyFeatures']);
  // $feat_image1 = explode(", ", $yield['image']);  
  // $feat_image2 = explode(", ", $yield['previewScreensOrVideoURLs']);
if(count($feat_image1) > 1){
  for ($i=0; $i<=count($feat_image1); $i++){
  echo '<img src="'. $feat_image1[$i] .'">';
  }
}
else if($yield['htmlKeyFeatures'] == true){
  echo $yield['htmlKeyFeatures'];
}
else{
  for ($i=0; $i<=count($feat_image2); $i++){
  echo '<img src="'. $feat_image2[$i] .'">';
  }
}
echo '<br><br>';
/*key features end*/
echo '<h5 class="custom-description"><b>Short description:</b></h5>';
  $url = 'https://api.templatemonster.com/products/v2/products/en?language=en&ids=' . $id . '&expand=properties';
  $resp = file_get_contents($url, FALSE);
  $resp = json_decode($resp);
echo $resp[0]->{'templatePreviewFBTitle'}; 

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
        $tr_key = 'Functionality';
        break;
    case 'features':
        $tr_key = 'Features';
        break;
    case 'media':
        $tr_key = 'Media';
        break;    
    case 'webForms':
        $tr_key = 'Web Forms';
        break;
    case 'additionalFeatures':
        $tr_key = 'Additional Features';
        break;  
  case 'templateSoftwareRequired':
        $tr_key = 'Template Software Required';
        break;
  case 'templateSources':
        $tr_key = 'Template Sources';
        break;
  case 'topic':
        $tr_key = 'Topic';
        break;
  case 'templateHostingRequirements':
        $tr_key = 'Template Hosting Requirements';
        break;
  case 'animation':
        $tr_key = 'Animation';
        break;    
  case 'popularity':
        $tr_key = 'Popularity';
        break;
  case 'dateRange':
        $tr_key = 'Date Range';
        break;  
  case 'color':
        $tr_key = 'Color';
        break;
  case 'demoNoIndex':
        $tr_key = 'Demo No Index';
        break;
  case 'trustedElements':
        $tr_key = 'Trusted Elements';
        break;
  case 'styles':
        $tr_key = 'Styles';
        break;
  case 'coding':
        $tr_key = 'Coding';
        break;
  case 'categoriesView':
        $tr_key = 'Categories View';
        break;
  case 'currencies':
        $tr_key = 'Currencies';
        break;
  case 'jqueryScripts':
        $tr_key = 'JQuery Scripts';
        break;
  case 'magentoExtensions':
        $tr_key = 'Magento Extensions';
        break;
  case 'languageSupport':
        $tr_key = 'Language Support';
        break;
  case 'galleryScript':
        $tr_key = 'Gallery Script';
        break;
  case 'additionalInfo':
        $tr_key = 'Additional Info';
        break;
  case 'wordpressCompatibility':
        $tr_key = 'WordPress Compatibility';
        break;
    default:
        $tr_key = $key;
}
   // echo '<strong>' . $tr_key . ': </strong>';
   //     foreach ( $object as $value => $property_name )
   //     {
   //       echo $property_name . ', ';            
   //     }
   // echo '<br><br>';
    }
      }
?>
<!-- Property function ends -->

</div>      
    <?php } 
    elseif($url_image == true && !empty($url_image) && url_exists($url_image_tmimgcdn)){ ?>
      <img id="url234" class="big_product_img" src="<?php echo $url_image_tmimgcdn; ?>" alt="">
      <!--<p style="text-align:center; margin-top:30px;"><a id="open-features" data-id="<?php // echo $template->getId(); ?>" ><b style="color:#2686CD">VIEW DETAILS</b><br></a></p>-->
      <!-- Property function starts-->
<div  style="padding:20px">
      <?php
$url = 'https://api.templatemonster.com/products/v2/products/en?language=en&ids=' . $id . '&expand=properties';
$resp = file_get_contents($url, FALSE);

$resp = json_decode($resp);
$yield = get_object_vars( $resp[0]->{'properties'} );

/*key features start*/
$feat_image1 = explode(", ", $yield['imageKeyFeatures']);
$feat_image2 = explode(", ", $yield['previewScreensOrVideoURLs']);

if(count($feat_image1) > 1){
  for ($i=0; $i<=count($feat_image1); $i++){
  echo '<img src="'. $feat_image1[$i] .'">';
  }
}
else if($yield['htmlKeyFeatures'] == true){
  echo $yield['htmlKeyFeatures'];
}
else{
  for ($i=0; $i<=count($feat_image2); $i++){
  echo '<img src="'. $feat_image2[$i] .'">';
  }
}
echo '<br><br>';
/*key features end*/

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
        $tr_key = 'Functionality';
        break;
    case 'features':
        $tr_key = 'Features';
        break;
    case 'media':
        $tr_key = 'Media';
        break;    
    case 'webForms':
        $tr_key = 'Web Forms';
        break;
    case 'additionalFeatures':
        $tr_key = 'Additional Features';
        break;  
  case 'templateSoftwareRequired':
        $tr_key = 'Template Software Required';
        break;
  case 'templateSources':
        $tr_key = 'Template Sources';
        break;
  case 'topic':
        $tr_key = 'Topic';
        break;
  case 'templateHostingRequirements':
        $tr_key = 'Template Hosting Requirements';
        break;
  case 'animation':
        $tr_key = 'Animation';
        break;    
  case 'popularity':
        $tr_key = 'Popularity';
        break;
  case 'dateRange':
        $tr_key = 'Date Range';
        break;  
  case 'color':
        $tr_key = 'Color';
        break;
  case 'demoNoIndex':
        $tr_key = 'Demo No Index';
        break;
  case 'trustedElements':
        $tr_key = 'Trusted Elements';
        break;
  case 'styles':
        $tr_key = 'Styles';
        break;
  case 'coding':
        $tr_key = 'Coding';
        break;
  case 'categoriesView':
        $tr_key = 'Categories View';
        break;
  case 'currencies':
        $tr_key = 'Currencies';
        break;
  case 'jqueryScripts':
        $tr_key = 'JQuery Scripts';
        break;
  case 'magentoExtensions':
        $tr_key = 'Magento Extensions';
        break;
  case 'languageSupport':
        $tr_key = 'Language Support';
        break;
  case 'galleryScript':
        $tr_key = 'Gallery Script';
        break;
  case 'additionalInfo':
        $tr_key = 'Additional Info';
        break;
  case 'wordpressCompatibility':
        $tr_key = 'WordPress Compatibility';
        break;
    default:
        $tr_key = $key;
}
  //  echo '<strong>' . $tr_key . ': </strong>';
  //      foreach ( $object as $value => $property_name )
  //      {
  //        echo $property_name . ', ';      
  //      }
  //  echo '<br><br>';
    }
      }
?></div>
<!-- Property function ends -->
     <?php }
    elseif($url_image == true && !empty($url_image) && url_exists($url_image_http)){ ?>
      <img id="url234" class="big_product_img" src="<?php echo $url_image_http; ?>" alt="<?php echo $template->type->getVisibleName();?>">
      <!--<p style="text-align:center; margin-top:30px;"><a id="open-features" data-id="<?php // echo $template->getId(); ?>" ><b style="color:#2686CD">Подробнее</b><br></a></p>-->
      
      <!-- Property function starts-->
<div  style="padding:20px">
      <?php
$url = 'https://api.templatemonster.com/products/v2/products/en?language=en&ids=' . $id . '&expand=properties';
$resp = file_get_contents($url, FALSE);

$resp = json_decode($resp);
$yield = get_object_vars( $resp[0]->{'properties'} );

/*key features start*/
$feat_image1 = explode(", ", $yield['imageKeyFeatures']);
$feat_image2 = explode(", ", $yield['previewScreensOrVideoURLs']);

if(count($feat_image1) > 1){
  for ($i=0; $i<=count($feat_image1); $i++){
  echo '<img src="'. $feat_image1[$i] .'">';
  }
}
else if($yield['htmlKeyFeatures'] == true){
  echo $yield['htmlKeyFeatures'];
}
else{
  for ($i=0; $i<=count($feat_image2); $i++){
  echo '<img src="'. $feat_image2[$i] .'">';
  }
}
echo '<br><br>';
/*key features end*/

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
        $tr_key = 'Functionality';
        break;
    case 'features':
        $tr_key = 'Features';
        break;
    case 'media':
        $tr_key = 'Media';
        break;    
    case 'webForms':
        $tr_key = 'Web Forms';
        break;
    case 'additionalFeatures':
        $tr_key = 'Additional Features';
        break;  
  case 'templateSoftwareRequired':
        $tr_key = 'Template Software Required';
        break;
  case 'templateSources':
        $tr_key = 'Template Sources';
        break;
  case 'topic':
        $tr_key = 'Topic';
        break;
  case 'templateHostingRequirements':
        $tr_key = 'Template Hosting Requirements';
        break;
  case 'animation':
        $tr_key = 'Animation';
        break;    
  case 'popularity':
        $tr_key = 'Popularity';
        break;
  case 'dateRange':
        $tr_key = 'Date Range';
        break;  
  case 'color':
        $tr_key = 'Color';
        break;
  case 'demoNoIndex':
        $tr_key = 'Demo No Index';
        break;
  case 'trustedElements':
        $tr_key = 'Trusted Elements';
        break;
  case 'styles':
        $tr_key = 'Styles';
        break;
  case 'coding':
        $tr_key = 'Coding';
        break;
  case 'categoriesView':
        $tr_key = 'Categories View';
        break;
  case 'currencies':
        $tr_key = 'Currencies';
        break;
  case 'jqueryScripts':
        $tr_key = 'JQuery Scripts';
        break;
  case 'magentoExtensions':
        $tr_key = 'Magento Extensions';
        break;
  case 'languageSupport':
        $tr_key = 'Language Support';
        break;
  case 'galleryScript':
        $tr_key = 'Gallery Script';
        break;
  case 'additionalInfo':
        $tr_key = 'Additional Info';
        break;
  case 'wordpressCompatibility':
        $tr_key = 'WordPress Compatibility';
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
<!-- Property function ends -->     
    <?php }
    else {
       echo Property_API2::get_template_single_property( $template->getId(), 'image-key-features', 'image-key-features' );
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
       #echo Property_API2::get_template_single_property( $template->getId(), 'template-hosting-requirements', 'Hosting Requirements' );
       echo Property_API2::get_template_single_property( $template->getId(), 'image-description', 'image-description' );
    }?>
    <div id="viewdetails" style="display:none; padding:35px"></div>
  </div>
</div>
<?php if($template->type->getId() != 32 && $template->type->getId() != 77){ ?>
<a id="demo-page" style="max-width:300px; margin-top:30px" href="<?php echo S_SITE_URL ?>demo/<?php echo $id ?>.html" class="btn3" target="_blank">Demo</a>
<?php } ?>