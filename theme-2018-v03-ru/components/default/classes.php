<?php
/**
 * @var $page Theme_page
 */
/**
 * Small realtime storage for config vars to pass through the theme
 */
class Moto_Config
{
    static protected $__data = array();
    /**
     * Get data from config
     * @param string $name Config key
     * @param mixed $default Value to return if key does not exist
     * @return mixed
     */
    static function get($name, $default = null)
    {
        if (isset(self::$__data[$name]))
            return self::$__data[$name];
        return $default;
    }
    /**
     * Get data from subkey
     * @param string $name Config key
     * @param string $key Config subkey
     * @param mixed $default Value to return if key does not exist
     * @return mixed
     */
    static function getSub($name, $key = '', $default = null)
    {
        if (isset(self::$__data[$name][$key]))
            return self::$__data[$name][$key];
        return $default;
    }
    /**
     * Store a value to config
     * @param string $name Config key
     * @param mixed $value Value to store
     * @return mixed
     */
    static function set($name, $value)
    {
        self::$__data[$name] = $value;
        return $value;
    }
    /**
     * Store a value to sub subkey
     * @param string $name Config key
     * @param string $key Config subkey
     * @param mixed $value Value to store
     * @return mixed
     */
    static function setSub($name, $key, $value)
    {
        self::$__data[$name][$key] = $value;
    }
    function getArrayItems($itemString)
    {
        if (isset($itemString) && $itemString != '')
        {
            return explode(' ', str_replace('  ', ' ', str_replace(array(',',';','.'), ' ', $itemString)));
        }
        return array();
    }
}
// We need Zend_Cache so include it
set_include_path(get_include_path() . PATH_SEPARATOR . CURRENT_THEME_DIR . '/includes/');
include 'Zend/Cache.php';
/**
 * Class to provide singleton access to Zend_Cache instance
 */
class Moto_Cache
{
    private static $cache;
    /**
     * Get cache instance
     * @return Zend_Cache_Core
     */
    public static function cache($subDir = '')
    {
        if (!isset(self::$cache) || !(self::$cache instanceof Zend_Cache))
        {
            $frontendOptions = array(
                //'lifetime' => 86400, // 1 day
                'lifetime' => 14400, // 4 hours
                'automatic_serialization' => true
            );
            $backendOptions = array(
                'cache_dir' => CURRENT_THEME_DIR . '/cache/' . $subDir
            );
            self::$cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        }
        return self::$cache;
    }
    /**
     * Clear cache
     */
    public static function clear()
    {
        self::cache()->clean(Zend_Cache::CLEANING_MODE_ALL);
    }
}
class Moto_TM_API
{
    protected static $login = 'rutm';
    protected static $password = 'e00f70092dfc42e53f2bcbfb34dfe1aa';
    protected static $baseUrl = 'http://api.templatemonster.com/webapi/';
    /**
     * Get template information in XML format
     * @static
     * @param $tid
     * @return string
     */
    public static function templateXml($tid)
    {
        return self::execute('template_xml.php', array('template_number' => $tid));
    }
    /**
     * @static
     * @param string $method
     * @param array $params
     * @return string|bool
     */
    protected static function execute($method, array $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, self::buildApiUrl($method, $params));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = curl_exec($ch);
        if (!$result)
        {
            error_log(curl_error($ch));
            $result = false;
        }
        curl_close($ch);
        return $result;
    }
    /**
     * Get API URL for desired request
     * @static
     * @param $method
     * @param array $params
     * @return string
     */
    protected static function buildApiUrl($method, array $params)
    {
        $params = array_merge($params, array(
            'login' => self::$login,
            'webapipassword' => self::$password
        ));
        return self::$baseUrl . $method . '?' . http_build_query($params);
    }
}
class Moto_Tools
{
    protected static $_assetsCache = array(
        'css' => array(),
        'js' => array(),
    );
    protected static $_assetsOptions = array(
        'basePath' => 'http://img.templatemonster.ru/ru/themes/rutm/',
        'baseDir' => CURRENT_THEME_DIR,
    );
    static function setAssetsBasePath($path)
    {
        self::$_assetsOptions['basePath'] = rtrim($path, '/') . '/';
    }
    //@TODO : if url start with / skip add basePath
    static function getAssetsCss($url)
    {
        $url = ltrim($url, '/');
        if (!isset(self::$_assetsCache['css'][$url]))
        {
            self::$_assetsCache['css'][$url] = true;
            $url = self::$_assetsOptions['basePath'] . $url;
            return '<link rel="stylesheet" type="text/css" href="' . $url . '"/>' . "\n";
        }
    }
    static function getAssetsJavaScript($url)
    {
        $url = ltrim($url, '/');
        if (!isset(self::$_assetsCache['js'][$url]))
        {
            self::$_assetsCache['js'][$url] = true;
            $url = self::$_assetsOptions['basePath'] . $url;
            return '<script src="' . $url . '" type="text/javascript"></script>' . "\n";
        }
    }
    static function getAssetsImageUrl($url)
    {
        $url = ltrim($url, '/');
        $url = self::$_assetsOptions['basePath'] . $url;
        return $url;
    }
    protected  static function _getRevision($filepath){
        $file = CURRENT_THEME_DIR . '/' . $filepath;
        return (is_file($file)) ? filemtime(($file)) : '';
    }
    static function getAssetsCssWithRevision($url)
    {
        $url = ltrim($url, '/');
        if (!isset(self::$_assetsCache['css'][$url]))
        {
            $rev = self::_getRevision($url);
            self::$_assetsCache['css'][$url] = true;
            $url = self::$_assetsOptions['basePath'] . $url;
            return '<link rel="stylesheet" type="text/css" href="' . $url . '?' . $rev . '"/>' . "\n";
        }
    }
    static function getAssetsJavaScriptWithRevision($url)
    {
        $url = ltrim($url, '/');
        if (!isset(self::$_assetsCache['js'][$url]))
        {
            $rev = self::_getRevision($url);
            self::$_assetsCache['js'][$url] = true;
            $url = self::$_assetsOptions['basePath'] . $url;
            return '<script src="' . $url . '?' . $rev . '" type="text/javascript"></script>' . "\n";
        }
    }
    protected static $_template_options = array(
        array('live_preview','//live_preview_url'),
        array('features','/templates/template/properties/property/propertyName[. ="Features"]/parent::*/propertyValues/propertyValue')
    );
    public static function isXML($xml)
    {
        $xml = trim($xml);
        if ($xml == '')
            return false;
        libxml_use_internal_errors(true);
        $doc = simplexml_load_string($xml);
        $errors = libxml_get_errors();
        if (empty($errors))
        {
            return true;
        }
        $error = $errors[0];
        if ($error->level < 3)
        {
            return true;
        }
        $explodedxml = explode("r", $xml);
        $badxml = $explodedxml[($error->line) - 1];
        $message = $error->message . ' at line ' . $error->line . '. Bad XML: ' . htmlentities($badxml);
        return $message;
    }
    /**Get all template info, mentioned in $_template_options
     * @static
     * @param $tid
     * @return array|false|mixed
     */
    public static function getTemplateInfo($tid)
    {
        $tid = (string)$tid;
        $template_info = Moto_Cache::cache('webapi/')->load($tid);
        if ($template_info === false)
        {
            $data = Moto_TM_API::templateXml($tid);
            $isXml = self::isXML($data);
            $template_info = array();
            if ($isXml === true)
            {
                $xml = new SimpleXMLElement($data);
                for ($i=0; $i<count(self::$_template_options);$i++){
                    $xmlData = $xml->xpath(self::$_template_options[$i][1]);
                    for ($k=0; $k< count($xmlData); $k++){
                        $xmlData[$k] = (string)$xmlData[$k];
                    }
                    $template_info[self::$_template_options[$i][0]] = $xmlData;
                }
                Moto_Cache::cache('webapi/')->save($template_info, $tid);
            }
        }
        return $template_info;
    }
    /**Get all features of the template
     * @static
     * @param $tid
     * @return mixed (array)
     */
    public static function getTemplateFeatures($tid)
    {
        $template_info = self::getTemplateInfo($tid);
        return ( isset($template_info['features']) ? $template_info['features'] : array() );
    }
    /**Get preview URL for the template
     * @static
     * @param $tid
     * @return string
     */
    public static function getTemplatePreviewUrl($tid)
    {
        $template_info = self::getTemplateInfo($tid);
        if (!isset($template_info['live_preview']) || !isset($template_info['live_preview'][0]))
            return '';
        $previewUrl = $template_info['live_preview'][0];
        if ( preg_match('#html$#', $previewUrl, $match) ){
            return $previewUrl;
        }
        else{
            // do not add slash to facebook url
            if (strpos($previewUrl, "facebook.com") > 0)
                return $previewUrl;
            return $previewUrl. '/';
        }
    }
    /** Check if template is responsive
     * @static
     * @param $tid
     * @return bool
     */
    public static function isTemplateResponsive($tid)
    {
        $features = self::getTemplateFeatures($tid);
        $result = false;
        for ($i = 0; $i < count($features); $i++)
        {
            if ($features[$i] == "Responsive")
            {
                $result = true;
                break;
            }
        }
        return $result;
    }
    public static function ifTemplateHasNoDemo($template){
        $typeId = $template->getType()->getId();
        $packages = null;
        $hasNoDemo = false;
        if (!defined('TEMPLATES_WITHOUT_DEMO'))
            define('TEMPLATES_WITHOUT_DEMO', '');
        if (defined('PACKAGES_WITHOUT_DEMO') && PACKAGES_WITHOUT_DEMO != '')
        {
            $packages = explode(' ', str_replace('  ', ' ', str_replace(array(',',';','.'), ' ', trim(PACKAGES_WITHOUT_DEMO))));
        }
        $types = explode(' ', str_replace('  ', ' ', str_replace(array(',',';','.'), ' ', TEMPLATES_WITHOUT_DEMO)));
        if (is_array($types))
        {
            $hasNoDemo = in_array($typeId, $types);
        }
        if (!$hasNoDemo && is_array($packages))
        {
            $hasNoDemo = in_array($template->getPackage()->getId(), $packages);
        }
        return $hasNoDemo;
    }
    /**
     * @static
     * @param Theme_page $page
     * @param Theme_Template $template
     */
    public static function loadDescriptions($page, $template)
    {
        $query = '
            SELECT *
            FROM `' . Database::instance()->table_prefix() . 'templatedescriptions`
            WHERE id = ' . $template->getId();
        $result = Database::instance()->query($query)->as_array(false);
        if (!empty($result))
        {
            Moto_Config::set('title', str_replace(array('&quot;','&#39;'), array('"',"'"), $result[0]['title']));
            Moto_Config::set('description', str_replace(array('&quot;','&#39;'), array('"',"'"), $result[0]['description']));
            Moto_Config::set('image_alt', str_replace(array('&quot;','&#39;'), array('"',"'"), $result[0]['image_alt']));
        }
    }
    /**
     * Detect if we are on 404 page
     * @static
     * @param Theme_Page $page
     * @return bool
     */
    public static function is404($page)
    {
        return $page->getIdentityName() == '404';
    }
    public static function replaceHost($url)
    {
        return str_replace('images.templatemonster.com/screenshots', 'scr.templatemonster.com', $url);
    }
    /**
     * Detect if template is Moto CMS
     * @static
     * @param $template Theme_Template|Theme_Restrictor
     * @return bool
     */
    public static function isMoto($template)
    {
        if ($template instanceof Theme_Template || $template instanceof Theme_Restrictor)
        {
            $id = $template->getType()->getId();
        }
        else
        {
            return false;
        }
        return in_array($id, array(36, 54, 63, 68)) || ($id == 19 && $template->getId() > 32000);
    }
    /**
     * Detect if template is Moto CMS HTML
     * @static
     * @param $template Theme_Template|Theme_Restrictor
     * @return bool
     */
    public static function isMotoHtml($template)
    {
        $result = false;
        $id = 0;
        if ($template instanceof Theme_Template || $template instanceof Theme_Restrictor)
        {
            $id = $template->getType()->getId();
        }
        $result = in_array($id, array(63, 65, 68));
        //19 is DFG type [DFG is 1. old template; 2. moto flash; 3. moto html]
        if (!$result && $id == 19)
        {
            $id = $template->getPackage()->getId();
            $result = in_array($id, array(255, 263));
        }
        return $result;
    }
    public static function isMotoFacebook($template)
    {
        if ($template instanceof Theme_Template || $template instanceof Theme_Restrictor)
        {
            $id = $template->getType()->getId();
        }
        else
        {
            return false;
        }
        return in_array($id, array(54, 65));
    }
    /**
     * Detect if template is mobile to display specific preview
     * @static
     * @param $template Theme_Template|Theme_Restrictor
     * @return bool
     */
    public static function isMobile($template)
    {
        if ($template instanceof Theme_Template || $template instanceof Theme_Restrictor)
        {
            return in_array($template->getType()->getId(), array(42));
        }
        else
        {
            return false;
        }
    }
    static protected $_options = array(
        'bannerPrefixUrl' => 'http://393252296.r.cdn77.net/',
    );
    public static function setOption($name, $value)
    {
        self::$_options[$name] = $value;
    }
    public static function optimizeBanner($banner)
    {
        if (!empty(self::$_options['bannerPrefixUrl']))
            $banner = str_replace('<img src="/ru/banners/', '<img src="' . self::$_options['bannerPrefixUrl'] . '/ru/banners/', $banner);
        return $banner;
    }
    public static function pattern2url($pattern, $alias, $trail = true)
    {
        $macroses = array('%PAGE-NUMBER%', '%TYPE%', '%CATEGORY%', '%PACKAGE%');
        $values = array('', $alias, $alias, $alias);
        return ($trail ? '/' : '') . str_replace($macroses, $values, $pattern);
    }
}
if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], '.fmt'))
{
    if (!defined('STATIC_FRONTEND_DIR'))
    {
        define('STATIC_FRONTEND_DIR', '/ru/themes/rutm');
    }
    Moto_Tools::setOption('bannerPrefixUrl', '');
}
if (!defined('STATIC_FRONTEND_DIR'))
{
    define('STATIC_FRONTEND_DIR', 'http://393252296.r.cdn77.net/ru/themes/rutm');
}
if (!defined('STATIC_FRONTEND_DIR'))
{
    define('STATIC_FRONTEND_DIR', 'http://img.templatemonster.ru/ru/themes/rutm');
}
Moto_Tools::setAssetsBasePath(STATIC_FRONTEND_DIR);
if (!defined('CURRENT_PROMO_STATUS'))
{
    define('CURRENT_PROMO_STATUS', 0);
}
/**
 * Load template descriptions from XML
 */
if (isset($template))
{
    Moto_Tools::loadDescriptions($page, $template);
}
Moto_Config::set('pricesPlusInstall', array(
        27 => array(99, 59), //Magento
        36 => array(79, 49), // #DFG Flash
        19 => array(79, 49), //#MotoCMS Flash
        24 => array(54, 49), //Joomla Templates
        17 => array(54, 49), //WordPress Themes
        26 => array(54, 49), //Drupal Templates
        40 => array(54, 49), //VirtueMart Templates
        43 => array(54, 49), //PrestaShop Themes
        14 => array(54, 49), //osCommerce Templates
        61 => array(65, 49), //OpenCart Templates
        55 => array(45, 29), //Facebook Templates
        52 => array(45, 29), //Facebook Flash Templates
        54 => array(50, 39), //Facebook Flash CMS Templates
        16 => array(54, 49), //ZenCart Templates
        63 => array(79, 49), //MotoCMS Html
        68 => array(79, 49), //MotoCMS Html
        64 => array(54, 49), //Jigoshop Themes
    )
);
Moto_Config::set('pricesPlusAdmin', array(
        //1 => array(453, 399),
        1 => array(453, 299),
        //9 => array(556, 499),
        //9 => array(453, 399),
        9 => array(453, 299),
    )
);
$file = CURRENT_THEME_DIR . '/includes/Moto/rutemplates/rutemplates-insert-templates.php';
if (file_exists($file))
{
    include_once $file;
}