<?php
/**
 * @name			DevsBangla Education
 * @category		Framework
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/education/
**/

require_once( ROOT_DIR . "libs/MySQLi.php");
require_once( ROOT_DIR . "libs/Objects.php");

class db
{

/**
 * @Construct Database Connection
 * @Connect Database
 * @Load Objects From dbObject
**/
public function __construct()
{
global $config;

$db = new Mysqlidb($config['dbhost'],$config['dbuser'],$config['dbpass'],$config['dbname']);
$db->setPrefix ($config['table_prefix']);
dbObject::autoload("models");
}


	
}

class theme
{
private static function schema()
{
global $config;

$prefix = $config['table_prefix'];
$charset_collate = 'ENGINE=MyISAM DEFAULT CHARSET=utf8';
$schema_table= Array(

  'settings'	=>	"CREATE TABLE $prefix"."settings (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(191) NOT NULL default '',
  value longtext NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (name)
  ) $charset_collate;"
,

  'session'	=>	"CREATE TABLE $prefix"."session (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(100) NOT NULL default '0',
  code varchar(255) NOT NULL default '',
  expire int(100) NOT NULL default '0',
  PRIMARY KEY (id),
  UNIQUE KEY uid (uid)
  ) $charset_collate;"
,
  'users'	=>	"CREATE TABLE $prefix"."users (
  id int(15) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  privilege char(1) NOT NULL DEFAULT '0',
  registered varchar(255) NOT NULL default '0000-00-00 00:00:00',
  birthday varchar(255) NOT NULL default '0000-00-00',
  gender varchar(6) NOT NULL default 'Male',
  class int(255) NOT NULL DEFAULT '0',
  section varchar(255) NOT NULL DEFAULT '',
  status char(2) NOT NULL DEFAULT '0',
  phonenumber varchar(255) NOT NULL,
  avatar varchar(255) NOT NULL DEFAULT 'images/nophoto.jpg',
  address1 varchar(255) NOT NULL,
  address2 varchar(255) NOT NULL,
  profession varchar(255) NOT NULL DEFAULT '',
  country varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  district varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
) $charset_collate;"
,

  'users_role'	=>	"CREATE TABLE $prefix"."users_role (
  id int(15) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  role int(255) NOT NULL DEFAULT '0',
  time varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY title (title)
) $charset_collate;"
,
  'notice'	=>	"CREATE TABLE $prefix"."notice (
  id int(15) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  uid int(255) NOT NULL DEFAULT '0',
  description text,
  slug varchar(255) NOT NULL DEFAULT '',
  image varchar(255) NOT NULL DEFAULT '',
  file varchar(255) NOT NULL DEFAULT '',
  keywords varchar(255) NOT NULL DEFAULT '',
  time varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'attendence'	=>	"CREATE TABLE $prefix"."attendence (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(255) NOT NULL DEFAULT '0',
  byid int(255) NOT NULL DEFAULT '0',
  role int(255) NOT NULL DEFAULT '0',
  status int(255) NOT NULL DEFAULT '0',
  date varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
, 
 'online_admission'	=>	"CREATE TABLE $prefix"."online_admission (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL DEFAULT '',
  username varchar(255) NOT NULL DEFAULT '',
  email varchar(255) NOT NULL DEFAULT '',
  password varchar(255) NOT NULL DEFAULT '',
  avatar varchar(255) NOT NULL DEFAULT '',
  class varchar(255) NOT NULL DEFAULT '',
  section varchar(255) NOT NULL DEFAULT '',
  gender varchar(255) NOT NULL DEFAULT '',
  address varchar(255) NOT NULL DEFAULT '',
  phonenumber varchar(255) NOT NULL DEFAULT '',
  transactionid varchar(255) NOT NULL DEFAULT '',
  parent int(255) NOT NULL DEFAULT '0',
  father varchar(255) NOT NULL DEFAULT '',
  mother varchar(255) NOT NULL DEFAULT '',
  status int(255) NOT NULL DEFAULT '0',
  approveby int(255) NOT NULL DEFAULT '0',
  birthday varchar(255) NOT NULL default '0000-00-00',
  datetime varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
, 
  'class'	=>	"CREATE TABLE $prefix"."class (
  id int(15) NOT NULL AUTO_INCREMENT,
  class int(255) NOT NULL DEFAULT '0',
  name varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY class (class)
) $charset_collate;"
, 
 'gallery'	=>	"CREATE TABLE $prefix"."gallery (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(255) NOT NULL DEFAULT '0',
  image varchar(255) NOT NULL,
  datetime varchar(255) NOT NULL default '0000-00-00 00:00:00',
  text text,
  PRIMARY KEY (id)
) $charset_collate;"
,

  'section'	=>	"CREATE TABLE $prefix"."section (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  title varchar(255) NOT NULL,
  class int(255) NOT NULL DEFAULT '0',
  teacher int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'subject'	=>	"CREATE TABLE $prefix"."subject (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  class int(255) NOT NULL DEFAULT '0',
  teacher int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'student'	=>	"CREATE TABLE $prefix"."student (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(255) NOT NULL DEFAULT '0',
  classroll int(255) NOT NULL DEFAULT '0',
  class int(255) NOT NULL DEFAULT '0',
  guideteacher int(255) NOT NULL DEFAULT '0',
  section int(255) NOT NULL DEFAULT '0',
  parent int(255) NOT NULL DEFAULT '0',
  session varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'class_routine'	=>	"CREATE TABLE $prefix"."class_routine (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  class int(255) NOT NULL DEFAULT '0',
  section int(255) NOT NULL DEFAULT '0',
  day varchar(255) NOT NULL DEFAULT '',
  hourstart varchar(255) NOT NULL DEFAULT '0',
  hourend varchar(255) NOT NULL DEFAULT '0',
  minutestart varchar(255) NOT NULL DEFAULT '0',
  minuteend varchar(255) NOT NULL DEFAULT '0',
  teacher int(255) NOT NULL DEFAULT '0',
  subject int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"

,
  'log'	=>	"CREATE TABLE $prefix"."log (
  id int(15) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  log text NOT NULL,
  time varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'exam_type'	=>	"CREATE TABLE $prefix"."exam_type (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  session varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) $charset_collate;"
,
  'exam_routine'	=>	"CREATE TABLE $prefix"."exam_routine (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  class int(255) NOT NULL DEFAULT '0',
  section int(255) NOT NULL DEFAULT '0',
  day varchar(255) NOT NULL DEFAULT '',
  hourstart int(255) NOT NULL DEFAULT '0',
  hourend int(255) NOT NULL DEFAULT '0',
  minutestart int(255) NOT NULL DEFAULT '0',
  minuteend int(255) NOT NULL DEFAULT '0',
  teacher int(255) NOT NULL DEFAULT '0',
  subject int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"
,
  'exam'	=>	"CREATE TABLE $prefix"."exam (
  id int(15) NOT NULL AUTO_INCREMENT,
  student int(255) NOT NULL DEFAULT '0',
  class int(255) NOT NULL DEFAULT '0',
  examtype int(255) NOT NULL DEFAULT '0',
  subject varchar(255) NOT NULL DEFAULT '',
  datetime varchar(255) NOT NULL default '0000-00-00 00:00:00',
  mark int(255) NOT NULL DEFAULT '0',
  passmark int(255) NOT NULL DEFAULT '40',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) $charset_collate;"

,
  'exam_grade'	=>	"CREATE TABLE $prefix"."exam_grade (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL DEFAULT '',
  numberfrom int(255) NOT NULL DEFAULT '0',
  numberto int(255) NOT NULL DEFAULT '0',
  grade float NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) $charset_collate;"
,
  'payment_type'	=>	"CREATE TABLE $prefix"."payment_type (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL DEFAULT '',
  role int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) $charset_collate;"
,

  'payment_fee'	=>	"CREATE TABLE $prefix"."payment_fee (
  id int(15) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL DEFAULT '',
  fee int(255) NOT NULL DEFAULT '0',
  type int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY name (name)
) $charset_collate;"
,
  'payment'	=>	"CREATE TABLE $prefix"."payment (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(255) NOT NULL DEFAULT '0',
  type int(255) NOT NULL DEFAULT '0',
  fee int(255) NOT NULL DEFAULT '0',
  paid int(255) NOT NULL DEFAULT '0',
  status int(255) NOT NULL DEFAULT '0',
  role int(255) NOT NULL DEFAULT '0',
  date varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY type (type)
) $charset_collate;"
,
  'sms_settings'	=>	"CREATE TABLE $prefix"."sms_settings (
  id int(15) NOT NULL AUTO_INCREMENT,
  type varchar(255) NOT NULL DEFAULT '',
  username varchar(255) NOT NULL DEFAULT '',
  password varchar(255) NOT NULL DEFAULT '',
  api varchar(255) NOT NULL DEFAULT '',
  sid varchar(255) NOT NULL DEFAULT '',
  auth varchar(255) NOT NULL DEFAULT '',
  number varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY type (type)
) $charset_collate;"
,
  'sms'	=>	"CREATE TABLE $prefix"."sms (
  id int(15) NOT NULL AUTO_INCREMENT,
  uid int(255) NOT NULL DEFAULT '0',
  toid int(255) NOT NULL DEFAULT '0',
  type int(255) NOT NULL DEFAULT '0',
  text text,
  status int(255) NOT NULL DEFAULT '0',
  date varchar(255) NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (id),
  UNIQUE KEY type (type)
) $charset_collate;"


);
return $schema_table;
}
private static function schema_insert($sitename,$sitetitle,$admin,$password,$email,$name)
{
global $config;
$db = new mysqli($config['dbhost'], $config['dbuser'],$config['dbpass'],$config['dbname']);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
/**
 * @Schema Insert
 * @Schema For Tables
**/
$schema = self::schema();
$success = 1;
foreach($schema as $key => $val) {
// echo 'Creating table <b>' . $key .'</b>...<br/>';
$drop_if_exists = 'DROP TABLE IF EXISTS '.$config['table_prefix'].$key;
$db->query($drop_if_exists);
if ($db->query($schema[$key]) === TRUE) {
// echo 'Table <b>'.$key.'</b> created successfully<br/>';
$success=1;

 } else {
 echo 'Error creating table <b>'.$key.'</b> ERROR: ' . $db->error .'<br/>';
 $success=0;
}
$success += $success;
}

/**
 * @Insert Site Settings
 * @Settings Value
 * @Createing Site Admin Also
**/
	$options = Array(
	'siteurl' => $config['host_protocol'].$_SERVER['HTTP_HOST'],
	'sitename' => $sitename,
	'sitetitle' => $sitetitle,
	'favicon' => '',
	'logo' => '',
	'licence' => $config['licence'],
	'installed' => date('Y-m-d H:i:s'),
	'address' => '',
	'phonenumber' => '',
	'email' => '',
	'paypal_email' => '',
	'currency' => '',
	'sms_service' => '0',
	'email_service' => '1',
  'attendence_alert' => '0',
  'site-preloader' => true,
	'online_admission' => true,
	'student_absent_message' => 'Hello, your student {$studentname} absent in school {$today} From, {$sitename}',
	'session' => ''
	);

foreach($options as $key => $val) {
// echo 'Option name <b>' . $key .'</b> ';
// echo 'Option value <b>' . $options[$key] .'</b>...<br/>';
$insert = $key.','.$options[$key];
$db->query("INSERT INTO ".$config['table_prefix']."settings (name,value) VALUES ('".$key."','".$options[$key]."')");
}	

$role = Array(
	'student' => 0,
	'parent' => 1,
	'staff' => 2,
	'teacher' => 3,
	'headteacher' => 4,
	'admin' => 5
	);

foreach($role as $key => $val) {
$insert = $key.','.$role[$key];
// echo $insert . '<br/>';
$db->query("INSERT INTO ".$config['table_prefix']."users_role (title,role) VALUES ('".$key."','".$role[$key]."')");
}

/**
 * @Make An Admin
 * @Insert Primary User
**/
$pass_encrept_options = [
    'cost' => 11,
    'salt' => random_bytes (22),
];
$db->query("INSERT INTO ".$config['table_prefix']."users (username,password,email,name,privilege,registered) VALUES ('".$admin."','".password_hash($password,PASSWORD_BCRYPT,$pass_encrept_options)."','".$email."','".$name."','".$role['admin']."',NOW()) ");

$db->close(); 
}
public static function install($sitename,$sitetitle,$admin,$password,$email,$name)
{
self::schema_insert($sitename,$sitetitle,$admin,$password,$email,$name);
}
public static function installed()
{
global $config;
$db = new mysqli($config['dbhost'], $config['dbuser'],$config['dbpass'],$config['dbname']);
$installed='';
$sql = "SHOW TABLES FROM ".$config['dbname'];
$result = $db->query($sql);
while ($row = $result->fetch_row()) {
    $installed.=$row[0];
}
if ($installed)
{
return true;
}
else
{
return false;
}
}

}
/**
 * @User Informations
 * @User Get User Data
**/
if (class_exists('modules')){ 
class user extends db
{
/**
 * @User Registration	
 * @Insert To Database
**/
public static function signup($data)
{
$db = MysqliDb::getInstance();
$query = $db->insert ('users', $data);
if ($query)
	return true;
else
    return false;
}	
/**
 * @Find Admin
**/	
public static function admin($id)
{
$db = MysqliDb::getInstance();
$db->where ('id', $id);
$db->where ('privilege', 1);
$result = $db->has ('users');
if ($result)
return true;
else
return false;
}	
/**
 * @Find User
**/	
public static function has($id)
{
$db = MysqliDb::getInstance();
$found = $db->where ('id', $id)->orWhere ('username', $id)->orWhere ('email', $id)->has ('users');
if ($found)
return true;
else
return false;
}
/**
 * @Validate A User
**/
public static function validuser($username,$password)
{
$db = MysqliDb::getInstance();
$found = $db->where('username', $username)->orWhere('email', $username)->has('users');
if (!$found){return false;}

$result_user = $db->where ('username', $username)->orWhere ('email', $username)->ObjectBuilder()->getOne("users");
if (password_verify($password,$result_user->password))
{return true;}
else
{return false;}
}
/**
 * @Login User
**/
public static function login($username,$password)
{
$db = MysqliDb::getInstance();
if (self::validuser($username,$password))
{

$db->where ('username', $username);
$db->orWhere ('email', $username);
$found = $db->has ('users');
$result_user = $db->where ('username', $username)->orWhere ('email', $username)->ObjectBuilder()->getOne("users");
$userid = $result_user->id;
$db->where('uid', $userid);
$db->delete('session');
$logout= setcookie('session_logincode',null,time()-1,'/');
$session_time = time()+(30*26*3600);
$session_code = '535510n.'.password_hash($session_time,PASSWORD_DEFAULT);
$session_data = Array ("uid" => $userid,
               "expire" => $session_time,
               "code" => $session_code
);
$true = $db->insert ('session', $session_data);
$true.= setcookie("session_logincode",$session_code,$session_time,'/');
return true;
}
else
{
return false;
}
}
/**
 * @Get Login Cookie
**/
public static function ___loggedcookie()
{
if (isset($_COOKIE['session_logincode']))
{
$code = $_COOKIE['session_logincode'];
return $code;
}
else
{
return false;
}
}
/**
  * @Logout user
**/
public static function logout()
{
$db = MysqliDb::getInstance();
$db->where('code', self::___loggedcookie());
$logout = $db->delete('session');
$logout.= setcookie('session_logincode',null,time()-1,'/');
if($logout)
{
return true;
}
else
{
return false;
}
}
/**
 * @Find logged or not
**/
public static function logged()
{
$db = MysqliDb::getInstance();
if(!$db->where ('code',self::___loggedcookie())->has ('session')){return false;}
$session = $db->where ('code',self::___loggedcookie())->ObjectBuilder()->getOne("session");
$uid = $session->uid;
return $session;
if($logged&&$uid)
{
return $uid;
}
else
{
return false;
}
}
/**
 * @Get User Info From Userid
**/
public static function info($id)
{
$db = MysqliDb::getInstance();
$found = $db->where ('id', $id)->orWhere ('username', $id)->orWhere ('email', $id)->has ('users');
if(!$found){return false;}
$result_user = $db->where ('id', $id)->orWhere ('username', $id)->orWhere ('email', $id)->ObjectBuilder()->getOne("users");
return $result_user;
}
/**
 * @Get User Info From Session
**/
public static function inses()
{
$db = MysqliDb::getInstance();
$db->where ('code',self::___loggedcookie());
$logged= $db->has ('session');if(!$logged){return false;}
$session = $db->ObjectBuilder()->getOne("session");
$uid = $session->uid;
$found = $db->where ('id', $uid)->has ('users');
if(!$found){return 404;}
$result_user = $db->where ('id', $uid)->ObjectBuilder()->getOne("users");
return $result_user;
}
/**
 * @Get User Info From Session
**/
public static function admininses()
{
$db = MysqliDb::getInstance();
$db->where ('code',self::___loggedcookie());
$logged= $db->has ('session');if(!$logged){return false;}
$session = $db->ObjectBuilder()->getOne("session");
$uid = $session->uid;
if (self::admin($uid)){return true;}else{return false;}
}

/**
 * @Get User Attendences
**/
public static function attendence($uid,$date)
{
$db = MysqliDb::getInstance();
$found = $db->where ('uid', $uid)->where ('date', $date)->has ('attendence');
if(!$found){return false;}
$result_user = $db->where ('uid', $uid)->where ('date', $date)->ObjectBuilder()->getOne("attendence");
return $result_user;
}
}
}
?>