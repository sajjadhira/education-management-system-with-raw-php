<?php
/**
 * @name			Education Managemnet System
 * @category		Framework
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @Author URL		https://phpans.com
 
**/
if (!file_exists(__DIR__ . "/config.php"))
{
header ("Location: ".__DIR__ ."/installer.php");
exit;
}

header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$process = isset( $_POST['process'] ) ? (int) $_POST['process'] : -1;
if ( !defined('ROOT_DIR') )
define('ROOT_DIR', dirname(__FILE__) . '/');
define('CONFIG_FILE','config.php');
require_once(__DIR__ . "/config.php");
define('PROJECT_NAME','Iskul');
define('PROJECT_AUTHOR','phpans');
require_once( ROOT_DIR . "functions/static.class.php");
require_once( ROOT_DIR . "functions/dynamic.class.php");
require_once( ROOT_DIR . "functions/basic.functions.php");

global $config;
$db = new mysqli($config['dbhost'], $config['dbuser'],$config['dbpass'],$config['dbname']);
if ($db->connect_error) {
ob_clean();
$title= 'Database connection error';
$description = 'Database connection error. Please check database configaration again.';

    die ('
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>'.$title.'</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }

        p {
            margin: 0 auto;
            width: 280px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }

    </style>
</head>
<body>
    <h1>'.$title.'</h1>
    <p>'.$description.'</p>
</body>
</html>	
	');
}
if (theme::installed())
{
ob_clean();
$title= 'Theme alredy installed';
$description = 'You have requested to install ' . PROJECT_NAME . '. But ' . PROJECT_NAME . ' already installed!';
die ('
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>'.$title.'</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }

        p {
            margin: 0 auto;
            width: 280px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }

    </style>
</head>
<body>
    <h1>'.$title.'</h1>
    <p>'.$description.'</p>
</body>
</html>
');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php _e(PROJECT_NAME) ?> Install</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta http-equiv="content-language" content="en" />
    <link href="./themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./themes/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="./themes/css/styles.css" rel="stylesheet">
    <link href="./themes/animate.css/animate.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./images/icon.png">
</head>
<body>	<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/><?php _e(PROJECT_NAME) ?> Install</h3>
			 	</div>
			  	<div class="panel-body">
			

 
<?php


switch ($process)
{
case 1:
	$sitename = trim( unslash( $_POST[ 'sitename' ] ) );
	$motto = trim( unslash( $_POST[ 'motto' ] ) );
	$username = trim( unslash( $_POST[ 'username' ] ) );
	$email = trim( unslash( $_POST[ 'email' ] ) );
	$password = trim( unslash( $_POST[ 'password' ] ) );
	$admin_name = trim( unslash( $_POST[ 'name' ] ) );
	$error = '';
	$message ='';
	if (empty($sitename))
	{
	$error = 0;
	$message = '<div class="error">Sitename should not empty.</div>';
	}
	if (empty($motto))
	{
	$error = 0;
	$message.= '<div class="error">Site motto should not empty.</div>';
	}
	if (empty($username))
	{
	$error = 0;
	$message.= '<div class="error">You must set an admin username.</div>';
	}
	if (empty($email))
	{
	$error = 0;
	$message.= '<div class="error">You must set an admin email.</div>';
	}
	if (empty($password))
	{
	$error = 0;
	$message.= '<div class="error">You must set an admin password.</div>';
	}
	if (empty($admin_name))
	{
	$admin_name = NULL;
	}
	if (!$error)
	{
	theme::install($sitename,$motto,$username,$password,$email,$admin_name);
	$message.= '<div class="alert alert-success text-center">';
$message.= '<span class="glyphicon glyphicon-ok-circle"></span> Theme has been successfully installed!';
$message.= '</div>';
	}

break;
}

if (isset($message))
{
echo $message;
}
?>
	

<form method="post" role="form" class="animated fadeIn">
                    <fieldset>
					
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Site Name" name="sitename" type="text" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Site Title" name="motto" type="text" value="" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Username" name="username" type="text" value="" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Email" name="email" type="email" value="" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Admin Name" name="name" type="text" value="" required>
			    		</div>
						<input type="hidden" name="process" value="1">
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Install">
			    	</fieldset>
			      	</form>

<div class="row text-center">
			&copy; <?php _e(date('Y').' '.PROJECT_AUTHOR) ?>
			</div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery -->
    <script src="./themes/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="./themes/build/js/custom.js"></script>
	<script src="./themes/editor/js/content.js"></script>
	<script src="./themes/js/contents.js"></script></body></html>
