<?php
/**
 * @name			Education Managemnet System
 * @category		Framework
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @link			https://phpans.com
**/

/**
 * @Default Defines
**/
define('DATABASE_NAME', 'iskul');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_HOST', 'localhost');
define('DATABASE_CHARSET', 'utf8mb4');
define('DATABASE_COLLATE', '');
define('LICENCE_KEY', 'skhey74dh73d');
define('PROJECT_VERSION', '1.0.0');
$table_prefix  = 'iskul_';
if ( !defined('ROOT_DIR') )
	define('ROOT_DIR', dirname(__FILE__) . '/');

/**
 * @Protocol
**/
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$host_protocol = 'https://';
	} else {
		$host_protocol = 'http://';
	}
	
/**
 * @Configaration
**/
$config = Array(
'dbhost'	=>	DATABASE_HOST,
'dbname'	=>	DATABASE_NAME,
'dbuser'	=>	DATABASE_USER,
'dbpass'	=>	DATABASE_PASSWORD,
'table_prefix'	=>	$table_prefix,
'host_protocol'	=>	$host_protocol,
'compress'	=>	false,
'licence'	=>	LICENCE_KEY,
'sitelink'	=>	$host_protocol.$_SERVER['HTTP_HOST'].'/iskul/'
);
