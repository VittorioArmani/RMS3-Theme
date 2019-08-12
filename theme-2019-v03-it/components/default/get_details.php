<?php
if($_POST['id']){
    function build_url( $method, array $url_data ){
      $template_id = $_POST['id'];
      $api_user = 'wdl';
      $api_password = 'e28b258e1cf090c45e57956139e66856';
      $api_url = 'http://api2.templatemonster.com:80/v2/';
      $method = 'templates.item.json';
      $url_data = array_merge(
          $url_data,
          array(
              'user' => $api_user,
              'token' => $api_password,
              'item_id' => $template_id
          )
      );
      $yield = $api_url . $method . '?' . http_build_query( $url_data );
      return $yield;
  }
 function perform_request( $method, array $url_data) {
      $ch = curl_init();
      $options = array(
          CURLOPT_URL => build_url( $method, $url_data ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_CONNECTTIMEOUT => 10,
          CURLOPT_HEADER => false
      );
      curl_setopt_array( $ch, $options );
      $yield = curl_exec( $ch );
      curl_close( $ch );
      return $yield;
  }
  function get_template_info( $template_id ) {
      $item_data = array(
          'item_id' => $template_id
      );
        $yield = json_decode( perform_request( $method, $item_data ) );
      return $yield;
  }
  function get_template_properties( $template_id ){
    $obj = get_template_info( $template_id );
    $yield = get_object_vars( $obj->{'result'}[0]->{'properties'} );
    return $yield;
  }
  function list_properties ( $property ){
    $property_string = '';
    foreach ($property as $property_value)
    {
      $property_string = $property_string . $property_value . ', ';
    }
    /* trim last ', ' */
    $property_string = rtrim( $property_string, ', ');
    $yield = $property_string;
    return $yield;
  }
  function sanitize_output( $z ){
    /* sanitize html output */
    $z = html_entity_decode( $z, ENT_QUOTES | ENT_IGNORE, "UTF-8" );
    $yield = htmlspecialchars_decode( $z );
    return $yield;
  }
  function get_template_single_property( $template_id, $single_property_name ){
    $object_array = get_template_properties( $template_id );
    foreach ( $object_array as $key => $object ){
      foreach ( $object as $value => $property_name ){
        if ( $property_name === $single_property_name ){
          $yield = list_properties( $object->propertyValues );
          if ( $single_property_name == 'image-description' ){
              $yield = '<img src="'. $yield .'">';
          }
          else if ( $single_property_name == 'image-key-features' ){
              $feat_image = explode(", ", $yield);
              $yield = null;
              for ($i=0; $i<=count($feat_image); $i++){
                  $yield = $yield . '<img src="'. $feat_image[$i] .'">';
              }
          } else {
              switch ($yield){
            case null:
              $yield = '<!-- '. $property_name .' property not exists! -->';
              break;
            case '':
              $yield = '<!-- '. $property_name .' property not exists! -->';
              break;
            case 'None':
              $yield = '<!-- '. $property_name .' property is empty! -->';
              break;
            default:
              $yield = '<div class="single-property"><u><b>' . $single_property_name . '</b></u>' . ': ' . $yield . '</div>';
              break;
          }
		  	if (strpos($yield, 'TemplateMonster') !== false || strpos($yield, 'shopify') !== false) {
				$yield = '';
				}
          $property_style_id = strtolower( $single_property_name );
          $property_style_id = str_replace( ' ', '-', $property_style_id );
          $property_style_id = 'property-' . $property_style_id;
          //$yield = $yield . PHP_EOL . '<br>';
		  $yield = $yield . PHP_EOL;
          }
        }
      }
    }
    $yield = sanitize_output( $yield );
    return $yield;
  }
  $templ_data = array();
  //$properties = array('image-key-features', 'Short description', 'Features', 'Additional Features', 'Topic', 'Coding', 'Categories View', 'Functionality', 'Animation', 'productFamily', 'Layout', 'Media', 'Web Forms', 'Language support', 'Gallery Script', 'Currencies', 'Notice', 'template-hosting-requirements', 'image-description');
  $properties = array('image-key-features', 'Short description', 'Features', 'Additional Features', 'Functionality', 'Coding');
  foreach ($properties as $prop){
      $templ_data[] .= get_template_single_property( $id, $prop );
  }
  die(json_encode($templ_data));
}
?>