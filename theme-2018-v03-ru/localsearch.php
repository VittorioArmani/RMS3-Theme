<?php
ob_start();

$keyword = htmlspecialchars($_GET["keyword"]);
$keyword = strip_tags($keyword);
$keyword = urlencode($keyword);

$type = htmlspecialchars($_GET["type"]);
$category = htmlspecialchars($_GET["category"]);

if (!isset($section)) { $section="buscarplantillas"; };

$busqueda = $keyword;
$question = $keyword;

$translator_base_url = 'https://www.googleapis.com/language/translate/v2?key=your_API_key_here&source=ru&target=en';

$keyword = str_replace("plantillas","",$keyword);
$keyword = str_replace("plantilla","",$keyword);
$keyword = str_replace(" de ","",$keyword);
$keyword = str_replace(" ","%20",$keyword);

  @set_time_limit(180);
  if(function_exists('curl_init')) {
    $ch = curl_init();
    $resource = $translator_base_url . '&q=' . $keyword;
    curl_setopt($ch, CURLOPT_URL, $resource);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $GetPage = curl_exec($ch);
    curl_close($ch);
    $patron = '{"translatedText": "([A-Za-z0-9-]+)"}';
    preg_match ($patron, $GetPage, $matches);
    $traduccion = $matches[1];
    $traduccion = str_replace(",","",$traduccion);
    Header ("Location: /ru/search/?busqueda=$busqueda&type=$type&category=$category&price1=$price1&price2=$price2&number=$number&keyword=$traduccion");
        ob_end_flush();
    ob_clean();
    exit();
  } else {
    Header ("Location: /ru/search/?busqueda=$busqueda&type=$type&category=$category&price1=$price1&price2=$price2&number=$number&keyword=$traduccion");
        ob_end_flush();
    ob_clean();
    exit();
  }
?>