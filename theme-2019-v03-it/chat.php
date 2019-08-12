<?php
  /* Currently available $chatLocale: en, de, es, fr, it, ru */
  $chatLocale = 'it';
  $SECRET_KEY = 'lak_asdg345';
  /* Chat connection parameters: */
  $affid = $_POST['affId'];
  $preset = $_POST['presetCode'];
  $chatParams['templateId'] = $_POST['templateId'];
  $chatParams['producttype'] = $_POST['productType'];
  $chatParams['email'] = $_POST['email'];
  $chatParams['nick'] = $_POST['nick'];
  $chatParams['project'] = 'mts';
  $chatParams['question'] = $_POST['question'];
  $chatParams['room'] = 'aff';
  /* test */
  /* $chatParams['referer'] = isSet($_GET['referer'])? $_SERVER['SERVER_NAME'].$_GET['referer'] : $_SERVER['HTTP_REFERER']; */
  /* md5 checksum depends on keys sequence */
  ksort($chatParams);
  $chatParams['key'] = md5(implode("", $chatParams).$SECRET_KEY);
  $chatUrl = str_replace('{$chatParams}', http_build_query($chatParams), 'http://chat.template-help.com/'.$chatLocale.'/'.$preset.'/?{$chatParams}');
  header('Location: ' .$chatUrl);
?>