<?php
/**
 * @name			Education Managemnet System
 * @category		E-Commerce
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @Author URL		https://phpans.com
 
**/

if (class_exists('modules')){ 
class main {

/**
 * @Magic Quotes Replacement
**/
public function __construct()
{
global $config;
if (!get_magic_quotes_gpc()) 
{
foreach ($_GET as $key => $value) {$_GET[$key] = addslashes(self::__queryreplace(strip_tags(htmlspecialchars($value)))); }
// foreach ($_POST as $key => $value) {$_POST[$key] = addslashes(self::__queryreplace(strip_tags(htmlspecialchars($value)))); }
// foreach ($_REQUEST as $key => $value) {$_REQUEST[$key] = addslashes(self::__queryreplace(strip_tags(htmlspecialchars($value)))); }
foreach ($_SERVER as $key => $value) {$_SERVER[$key] = addslashes(self::__queryreplace(strip_tags(htmlspecialchars($value)))); }
foreach ($_COOKIE as $key => $value) {$_COOKIE[$key] = addslashes(self::__queryreplace(strip_tags(htmlspecialchars($value)))); }
}
if ($config['compress']){modules::__compress();}
if(isset($_GET)){foreach($_GET as $key=>$value){$_GET[$key]=self::__filterhack($value);}}
//if(isset($_POST)){foreach($_POST as $key=>$value){$_POST[$key]=__filterhack($value);}}
if(isset($_SESSION)){foreach($_SESSION as $key=>$value){$_SESSION[$key]=self::__filterhack($value);}}
// if(isset($_COOKIE)){foreach($_COOKIE as $key=>$value){$_COOKIE[$key]=self::__filterhack($value);}} // If you enable this cookie may be not work prperly
if(isset($_SERVER)){foreach($_SERVER as $key=>$value){$_SERVER[$key]=self::__filterhack($value);}} 
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}
@session_start();
// @error_reporting(0); 
// @ini_set('error_log',NULL); 
// @ini_set('log_errors',0); 
@ini_set('max_execution_time',0); 
@ini_set('arg_separator.output','&amp;');
// @ini_set('display_errors','0');
@set_time_limit(0); 
@date_default_timezone_set('UTC');
}
/**
 * @Script Initialization
 * @Script Mode
 * @Execution ENVIRONMENT
**/
public static function inj()
{
$badchars = array("$","\"","--+","\\","<",">","'","^","#","%",",","~","!","|","@","&","*","(",")",";","TRUNCATE","EXEC(","SYSTEM(","CAST","DECLARE","CHAR","DROP", "SELECT","PHPINFO()","UNION","W4C","W2C","SCHEMA","CMD","SCP","BENCHMARK","PRINT","PRINTF","SCANF", "/ETC/PASSWD","PASSWD","HTPASSWD","FOO/BAR");
$count = count($badchars);
return $count;

}	
/**
 * @Function API Status
**/
public static function astatus()
{
return modules::modbra();
}
/**
 * @Bad Query Replacement
**/
public static function __queryreplace($str) { 
        $search=array("\\","\0","\n","\r","\x1a",'"',"$"); 
                $replace=array("\\","\\0","\\n","\\r","\Z",'\"',"$"); 
                return str_replace($search,$replace,$str); 
   }
   

public static function __filterhack($txt){
$txt = preg_replace(array('/[^a-zA-Z0-9\ \-\_\/\*\(\)\[\]\?\.\,\:\&\@\!\=\+]/'),array('', '', ''),$txt);                      
return $txt;
}

function content_type($type)
{
header("Content-type: ".$type."; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
}
 
}

}

class modules
{
public static function modalp()
{
return range('a','z');
}
/**
 * @Check For Latest Version
 * @Up To Date
**/
public static function version_check()
{
$version = 'http://localhost/ecom/version.txt';
$VERSION_CHECK = file_get_contents($version);
if(version_compare(PROJECT_VERSION,$VERSION_CHECK,'<'))
{
return 'UPDATE NOW TO '.$VERSION_CHECK;
}
else
{
return 'UP TO DATE';
}
}
public static function licence($key)
{
if (isset($key))
{
$licence = $key;
}
else
{
$licence = LICENCE_KEY;
}
$validURL = 'https://sajjad.info/facebook.php?action=auth_api&api='.$licence;
$content = file_get_contents($validURL);
if ($content==$licence)
{
return $content;
}
else
{
return $content;
}
}
public static function modsym()
{
return '&:/._+=@!,*^$-$#';
}
public static function modpro($env)
{
$efsi = self::modalp();
$zlis = self::modalp();
switch ($env)
{
case 's':
{
$_proto = $efsi[7].$zlis[19];
$interface = Array (
'intf'		=>	'E-Commerce',
'type'		=>	'Premium',
'program'	=>	'OOP',
'price'		=>	null
);
$_proto.=$efsi[19];
$zine = $interface['type'];
$repf = $interface['program'];
$_proto.=$zlis[15];
$price = $interface['price'];
$_proto.=$price.$efsi[18];
}
break;
default:
{
$_proto = $zlis[7];
$monetize = Array(
'adsense'	=>	null,
'personal'	=>	'true',
'amazon'	=> null,
'other'		=> null
);
$_proto.= $efsi[19];
$adsense = $monetize['adsense'];
$_proto.= $adsense.$zlis[19];
$_persla = $monetize['personal'];
$amazon = $monetize['amazon'];
$proto.= $amazon.$efsi[15];
}
}
return $_proto;
}
/**
 * @Compress
 * @Encoding
 * @gzcompress
**/
public static function __compress()
{
$EnableGZipEncoding = true;
function acceptsGZip()
{
$accept = str_replace(" ","",strtolower($_SERVER['HTTP_ACCEPT_ENCODING']));
$accept = explode(",",$accept);
return in_array("gzip",$accept);
}
function playWithHtml($OutputHtml)
{
return preg_replace("/\s+/"," ",$OutputHtml);
}
function obOutputHandler($OutputHtml)
{
global $EnableGZipEncoding;
$OutputHtml = playWithHtml($OutputHtml);
if(!acceptsGZip() || headers_sent() || !$EnableGZipEncoding) return $OutputHtml;
header("Content-Encoding: gzip");
return gzencode($OutputHtml);
}
ob_start("obOutputHandler");
}
public static function modcss()
{
$lpat = self::modsym();
$navigator = Array(
'slider'	=>	'product_slider',
'menu'		=>	'responsive',
'iframe'	=>	null,
'dyna_css'	=> true,
'dyna_xml'	=> null,
'sitemap'	=> 'sitemap.xml',
'unrescss'	=> null
);
$et6i = self::modsym();
$_css = $lpat[1];
$slider=  $navigator['slider'];
$menu= $navigator['menu'];
$_css.=$navigator['iframe'].$et6i[2];
$dynamic_css = $navigator['dyna_css'];
$unresponsive_css=$navigator['unrescss'];
$_css.=$unresponsive_css.$lpat[2];
return $_css;
}
/**
 * @Project Ratingss
 * @Configured
**/
public static function modext()
{
$pcls = self::modsym();
$rate = Array(
'site_ratings'	=>	'high',
'spam_site'		=>	null,
'design_UI'		=>	'excellent',
'error_code'	=>	null,
'performance'	=>	'best',
'ratings'		=> 10,
'bad_rating'	=> null
);
$t8id = self::modalp();
$_ext = $pcls[3];
$current_rate = $rate['site_ratings'];
$total_ratings = $current_rate.$rate['ratings'];
$spammy = $rate['spam_site'];
$_ext.=$rate['error_code'].$t8id[2].$spammy;
$site_ui = $rate['design_UI'].$rate['performance'];
$_ext.=$rate['bad_rating'].$t8id[14];
$cxrate = $rate['spam_site'].$rate['ratings'];
$_ext.=$rate['error_code'].$t8id[12];
return $_ext;
}
/**
 * @Project Privilege
 * @Configured
**/
public static function moddom()
{
$od6s = self::modalp();
$access = Array(
'admin'			=>	'true',
'user'			=>	null,
'seller'		=>	'register',
'buyer'			=>	null,
'subscriber'	=>	true,
'scammer'		=>	null,
'visitor'		=> 	true,
'spammers'		=> 	null
);
$_dom = $access['user'].$od6s[4];
$access_value = $access['seller'].$access['subscriber'];
$_dom.=$access['scammer'].$od6s[2];
$frequent=$access_value.$access['visitor'];
$_dom.=$od6s[14].$access['spammers'].$od6s[12];
return $_dom;
}
public static function moddir()
{
$olw8 = self::modsym();
$aq23 = self::modalp();
$_dir = $olw8[2];
return $_dir;
}
public static function modbra()
{

$_brand= self::modpro('s').self::modcss();
$_brand.= self::moddom().self::modext();
echo $_brand;
}
}
class ImageUploader{
private $type = array("jpg","jpeg","gif","png"),$info = '',$error='';
	public function __construct($file,$dir,$newfile,$height=500,$width=500){
	$this->file = $file;
	$this->dir = $dir;
	$this->newfile = $newfile;
	$this->width = $width;
	$this->height = $height;
	}
	public function upload(){
	    $ext = explode(".",$this->file['name']);
	    $ext = strtolower(end($ext));
	
		if(file_exists($this->dir.$this->file['name'])){
			$this->error .= "<div class='text-center'><b>Filename alredy exist!</b></div>";
			return false;
		}
		if (!in_array($ext,$this->type)){
			$this->error .= "<div class='text-center'><b>File Format not supported</b></div>";
			    return false;
		}
		
		// Get image size
		list($imwidth,$imheight) = getimagesize($this->file['tmp_name']);
		
		$hx = (100 / ($imwidth / $this->width)) * .01;
		$hx = round ($imheight * $hx);
 
		if ($hx < $this->height) {
			$this->height = (100 / ($imwidth / $this->width)) * .01;
			$this->height = round ($imheight * $this->height);
		} else {
			$this->width = (100 / ($imheight / $this->height)) * .01;
			$this->width = round ($imwidth * $this->width);
		}
		
		// Create a new true color image
		$image  = imagecreatetruecolor($this->width, $this->height);
		// Create a new iamge from file
		if($ext == "jpg" || $ext == "jpeg") {
			$im = imagecreatefromjpeg ($this->file['tmp_name']);
		} else if($ext == "gif") {
            $im = imagecreatefromgif ($this->file['tmp_name']);
		} else if($ext == "png") {
            $im = imagecreatefrompng ($this->file['tmp_name']);
		}
		
		// Copy and resize part of an image with resampling
		if(imagecopyresampled($image, $im, 0, 0, 0, 0, $this->width, $this->height, $imwidth, $imheight)){
				$this->info .= "<div class='text-center'><b>Picture added successfully!</b></div>";
			}
		
		// Output image
		if($ext == "jpg" || $ext == "jpeg") {
			imagejpeg($image, $this->dir.$this->newfile, 100);
		} else if($ext == "gif") {
			imagegif ($image, $this->dir.$this->newfile);
		} else if($ext == "png") {
			imagepng ($image, $this->dir.$this->newfile, 0);
		}
		
		// Destroy an image
		imagedestroy($im);
		return $im;
		
	}
	
	public function getInfo(){
		return $this->info;
	}
	
	public function getError(){
				if(empty($this->error))
		{$this->error = "<div class='text-center'><b>Unknown error! Your request cannot complete now!</b></div>";}
		return $this->error;
	}
	
}
class Captcha
{
public static function valid($code)
{
if($_SESSION['captchacode']==$code){return true;}else {return false;}
}
public static function code()
{
return $_SESSION['captchacode'];
}
public static function destroy()
{
unset($_SESSION['captchacode']);
}
}

?>