<?php
ob_start();

// Clean input

$keyword = htmlspecialchars($_GET["keyword"]);
$keyword = strip_tags($keyword);
$keyword = urlencode($keyword);

$type = htmlspecialchars($_GET["type"]);
$category = htmlspecialchars($_GET["category"]);

// Save question, and the date to the FAQ log file for your FAQ search

if (!isset($section)) { $section="buscarplantillas"; };

$busqueda = $keyword;
$question = $keyword;


/* $date = date("d/m/Y");
$time = date("H:i");
$questionanddate = $question .";".$date.";".$time."\n";
$filename = $section.'.txt';
// Let's make sure the file exists and is writable first.

if (is_writable($filename)) {

   // In our example we're opening $filename in append mode.
   // The file pointer is at the bottom of the file hence
   // that's where $somecontent will go when we fwrite() it.

   if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
   }

   // Write $questionanddate to our opened file.

   if (fwrite($handle, $questionanddate) === FALSE) {
       echo "Cannot write to file ($filename)";
       exit;
   }

// You might uncomment line below when first setting up to check code


// echo "Success, wrote ($questionanddate) to file ($filename)";

   fclose($handle);
} */
// translate and send query to search engine
//https://www.googleapis.com/language/translate/v2?key=AIzaSyB88znhag1MZ4_yYLzvgDbjClw0Ky0wzIc&source=es&target=en&q=hola%20mundo



$translator_base_url = 'https://www.googleapis.com/language/translate/v2?key=AIzaSyASbP8yAF9xuslzponyuG8suaRWvLMdPZ8&source=it&target=en';

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
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)"); // Increase IE Stats! Google dislikes non-browser user agents :(
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
    $GetPage = curl_exec($ch);
    curl_close($ch);
    $patron = '{"translatedText": "([A-Za-z0-9-]+)"}';
    preg_match ($patron, $GetPage, $matches);
    //echo $GetPage;
    //echo $matches[1];
    $traduccion = $matches[1];
    $traduccion = str_replace(",","",$traduccion);
    Header ("Location: /it-web-studio/search/?busqueda=$busqueda&type=$type&category=$category&price1=$price1&price2=$price2&number=$number&keyword=$traduccion");
        ob_end_flush();
    ob_clean();       //someone also mention the need to use this statement
    exit();
  } else {
    //echo "Temporary failure. Please try again later. Sorry for the inconvenience.";
    Header ("Location: /it-web-studio/search/?busqueda=$busqueda&type=$type&category=$category&price1=$price1&price2=$price2&number=$number&keyword=$traduccion");
        ob_end_flush();
    ob_clean();       //someone also mention the need to use this statement
    exit();
  }

?>
