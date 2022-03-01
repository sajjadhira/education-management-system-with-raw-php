<?php
/**
 * @name			DevsBangla Education
 * @category		Framework
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/e-commerce/
**/
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$process = isset( $_POST['process'] ) ? (int) $_POST['process'] : -1;
if ( !defined('ROOT_DIR') )
define('ROOT_DIR', dirname(__FILE__) . '/');
define('CONFIG_FILE','config.php');
define('CONFIG_SAMPLE','config-sample.php');
define('PROJECT_NAME','Iskul');
define('PROJECT_AUTHOR','DevsBangla');
require_once( ROOT_DIR . "functions/basic.functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php _e(PROJECT_NAME) ?> Installer Setup</title>
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
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/><?php _e(PROJECT_NAME) ?> Installer Setup</h3>
			 	</div>
			  	<div class="panel-body">
			

<?php

if (file_exists(ROOT_DIR . CONFIG_FILE))
{
ob_clean();
$title= CONFIG_FILE. ' already exists!';
$description = 'You have requested to create a ' . CONFIG_FILE . ' file. But the ' . CONFIG_FILE . '  file already exists on this server.';
@die ('
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

switch ($process)
{
case 1:
	$dbname = trim( unslash( $_POST[ 'database' ] ) );
	$dbuser = trim( unslash( $_POST[ 'username' ] ) );
	$dbpass = trim( unslash( $_POST[ 'password' ] ) );
	$dbhost = trim( unslash( $_POST[ 'host' ] ) );
	$prefix = trim( unslash( $_POST[ 'prefix' ] ) );
	$licence_key = trim( unslash( $_POST[ 'licence' ] ) );
	define('DATABASE_NAME', $dbname);
	define('DATABASE_USER', $dbuser);
	define('DATABASE_PASSWORD', $dbpass);
	define('DATABASE_HOST', $dbhost);
	define('LICENCE_KEY', $licence_key);

$db = new mysqli($dbhost, $dbuser,$dbpass,$dbname);
$title= 'Database Connection Error';
$description = 'Your is not permited to install ' . PROJECT_NAME . '. Please check database connection!';
if ($db->connect_error) {
ob_clean();
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
if ( file_exists( ROOT_DIR . CONFIG_SAMPLE ) )
	$config_file = file( ROOT_DIR . CONFIG_SAMPLE );

else
	die( 'Sorry, I need a '.CONFIG_SAMPLE.' file to work from. Please re-upload this file to your Theme installation.' );


	foreach ( $config_file as $line_num => $line ) {
		if ( '$table_prefix  =' == substr( $line, 0, 16 ) ) {
			$config_file[ $line_num ] = '$table_prefix  = \'' . addcslashes( $prefix, "\\'" ) . "';\r\n";
			continue;
		}
		
		if ( ! preg_match( '/^define\(\'([A-Z_]+)\',([ ]+)/', $line, $match ) )
			continue;

		$constant = $match[1];
		$padding  = $match[2];
	

		switch ( $constant ) {
			case 'DATABASE_NAME'     :
			case 'DATABASE_USER'     :
			case 'DATABASE_PASSWORD' :
			case 'DATABASE_HOST'     :
				$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . addcslashes( constant( $constant ), "\\'" ) . "');\r\n";
				break;
			case 'DATABASE_CHARSET'  :
					$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'utf8mb4');\r\n";
				break;
			case 'LICENCE_KEY'       :
				$config_file[ $line_num ] = "define('" . $constant . "'," . $padding . "'" . $licence_key . "');\r\n";
				break;
		}
	}
	unset( $line );

	

		$write = '';
		$handle = fopen(CONFIG_FILE, 'w' );
		foreach ( $config_file as $line ) {
		$write.=fwrite( $handle, $line );
		}
		fclose( $handle );
		chmod(CONFIG_FILE , 0666 );
	
	if ($write)
	{
	echo '<div class="alert alert-success text-center">';
	echo '<span class="glyphicon glyphicon-ok-circle"></span> '. CONFIG_FILE. ' file installed successfully! <br/> <a href="./install.php"><button class="btn btn-primary">Run Installer</button></a>';
	echo '</div>';
	}
break;
default:
{
?>

<form method="post" role="form" class="animated fadeIn">
                    <fieldset>
					
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Database Name" name="database" type="text" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Database Username" name="username" type="text" value="" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Database Password" name="password" type="password" value="">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Database Host" name="host" type="text" value="localhost" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Table Prefix" name="prefix" type="text" value="devsbangla_" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Licence Key" name="licence" type="text" value="" required>
			    		</div>
						<input type="hidden" name="process" value="1">
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Install Setup">
			    	</fieldset>
			      	</form>


<?php
}

}

?>
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
