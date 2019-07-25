<?php
    /*
    * 
    */
  class Property_API2
  {
    protected static $api_user = AFF;
    protected static $api_password = WEBAPIPASSWORD;
    protected static $api_url = 'http://api2.templatemonster.com:80/v2/';
    /*
  	* static
  	* params: string, array
  	* return: string
  	*/
    protected static function build_url( $method, array $url_data )
  	{
  		$method = 'templates.item.json';
  		$url_data = array_merge(
  			$url_data,
  			array(
  				'user' => self::$api_user,
  				'token' => self::$api_password
  			)
  		);
  		$yield = self::$api_url . $method . '?' . http_build_query( $url_data );
  		return $yield;
    }
  	/*
  	* perform_request
  	* static
  	* params: string, array
  	* return: string
  	*/
  	protected static function perform_request( $method, array $url_data )
  	{
  		$ch = curl_init();
  		$options = array(
  			CURLOPT_URL => self::build_url( $method, $url_data ),
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
  	/*
    * get template info
  	* static
  	* params: template_id
  	* return: decoded string
  	*/
  	protected static function get_template_info( $template_id )
  	{
  		$item_data = array(
  			'item_id' => $template_id
  		);
		  $yield = json_decode( self::perform_request( $method, $item_data ) );
  		return $yield;
  	}
    /*
    * static
  	* params: template_id
  	* return: array of objects (properties)
    */
    protected static function get_template_properties( $template_id )
    {
      $obj = self::get_template_info( $template_id );
      $yield = get_object_vars( $obj->{'result'}[0]->{'properties'} );
      return $yield;
    }
    /*
    * static
  	* params: property
    * return: string
    */
    protected static function list_properties ( $property )
    {
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
    /*
    * static
  	* params: string
    * return: sanitized string
    */
    protected static function sanitize_output( $z )
    {
      /* sanitize html output */
      $z = html_entity_decode( $z, ENT_QUOTES | ENT_IGNORE, "UTF-8" );
      $yield = htmlspecialchars_decode( $z );
      return $yield;
    }
    /*
    * static
  	* params: string, string (single property name)
    * return: string
    */
    public static function get_template_single_property( $template_id, $single_property_name )
    {
      $object_array = self::get_template_properties( $template_id );
      foreach ( $object_array as $key => $object )
      {
        foreach ( $object as $value => $property_name )
        {
          if ( $property_name === $single_property_name )
          {
            $yield = self::list_properties( $object->propertyValues );
            
			if ( $single_property_name == 'image-description' )
			{
				$yield = '<img src="'. $yield .'">';
			}
			else if ( $single_property_name == 'image-key-features' )
			{
				$feat_image = explode(", ", $yield);
				$yield = null;
				for ($i=0; $i<=count($feat_image); $i++){
					$yield = $yield . '<img src="'. $feat_image[$i] .'">';
				}
			}
			else
			{
				switch ($yield)
            {
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
                $yield = '<u><b>' . $single_property_name . '</b></u>' . ': ' . $yield;
                break;
            }
			if (strpos($yield, 'TemplateMonster') !== false || strpos($yield, 'shopify') !== false) {
				$yield = '';
				}
			$property_style_id = strtolower( $single_property_name );
            $property_style_id = str_replace( ' ', '-', $property_style_id );
            $property_style_id = 'property-' . $property_style_id;
            //$yield = '<div class="col-lg-12 col-md-12 col-sm-12""" id="' . $property_style_id . '">' . $yield . '</div>' . PHP_EOL;
			$yield = $yield . PHP_EOL . '<br>';
			}
          }
        }
      }
      $yield = self::sanitize_output( $yield );
      return $yield;
    }
  }
?>