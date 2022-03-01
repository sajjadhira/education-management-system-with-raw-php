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
require_once(__DIR__ . "/config.php");
require_once( ROOT_DIR . "functions/static.class.php");
require_once( ROOT_DIR . "functions/dynamic.class.php");
require_once( ROOT_DIR . "functions/basic.functions.php");
global $config;
$main = new main;
$user = new user;
$db = MysqliDb::getInstance();
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

isset($_GET['action']) ? $action = validtext($_GET['action']) : $action = NULL;
switch($action)
{
case 'logout':
{
if (!user::logged())
{
header('Location: '.base_url());
exit;
}
$head = Array(
'title' => settings('sitename').' Logout'
);
head($head);
if ($user->logout())
{
// echo '<div class="alert alert-success text-center">';
// echo '<i class="fa fa-check-circle-o fa-5x" aria-hidden="true"></i><br/> You have successfully logged out.';
// echo '</div>';
	?>
						<div class="preload-active">
						<div class="preloader-active"></div>
						</div>
	<?php
echo '<meta http-equiv="refresh" content="3;url='.$config['sitelink'].'" />';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i><br/> There is an error, please contact with administrator!';
echo '</div>';
}
foot();
}	
break;
default:
{
if (user::logged())
{
header('Location: '.base_url().'dashboard/');
exit;
}

$head = Array(
'title' => settings('sitename').' Login'
);
head($head);
$login =false;
isset($_POST['username']) ? $username = $_POST['username'] : $username = NULL;
isset($_POST['password']) ? $password = $_POST['password'] : $password = NULL;
// $session_time = time()+(30*26*3600);
// $session_code = '535510n.'.password_hash($session_time,PASSWORD_DEFAULT);
// $session_data = Array ("uid" => 1,
               // "expire" => $session_time,
               // "code" => $session_code
// );
// $true = $db->insert ('session', $session_data);
// $true.= setcookie("session_logincode",$session_code,$session_time
// if (isset($_POST['username'])&&isset($_POST['password']))
						// {
// echo user::validuser($username,$password);
// $pass_encrept_options = [
    // 'cost' => 11,
    // 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
// ];
// echo password_hash('admin',PASSWORD_BCRYPT,$pass_encrept_options). '<br/>';
// echo password_verify($password,'$2y$11$6L2qr264EeLpUbNXxP14oe5HXnSmUtAo2PAhf0lWjlGHdNbnC9wMO');
// exit;
						// }
?>
					<?php
					if (isset($_POST['username'])&&isset($_POST['password']))
						{
						if(user::login($username,$password))
						{
						// echo '<div class="alert alert-success text-center">';
						// echo '<i class="fa fa-check-circle-o fa-5x" aria-hidden="true"></i><br/> You have successfully logged in.';
						// echo '</div>';
						$login=true;
						?>
						<div class="preload-active">
						<div class="preloader-active"></div>
						</div>
						<?php
						echo '<meta http-equiv="refresh" content="3;url='.base_url().'dashboard/" />';
						}
						else
						{
						echo '<div class="alert alert-danger text-center">';
						echo '<i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i><br/> Username/email or password didn\'t found!';
						echo '</div>';
						}
						}
					if ($login==false)
					{
					?>
	<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/>Iskul - Education Management System<br/>(In Progress)</h3>
			 	</div>
			  	<div class="panel-body animated fadeIn">
			    	<form method="post" role="form" id="LoginForm">
                    <fieldset>
					
			    	  	<div class="form-group">
			    		    <input class="form-control" id="loginusername" placeholder="Username/E-mail" name="username" type="text">
			    		    <div id="username_error"></div>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" id="loginpassword" placeholder="Password" name="password" type="password" value="">
			    			<div id="password_error"></div>
			    		</div>

			    		<input class="btn btn-lg btn-success btn-block" id="dashboardLogin" type="submit" value="Login">
			    	</fieldset>
			      	</form>
					
			<div class="row">
			<table class="table">
	  <thead>
      <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Copy</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>admin</td>
        <td>admin</td>
        <td><span class="didyoucopy" id="copydemoadminlogin"><i class="fa fa-clone"></i></span></td>
      </tr>
      
    </tbody>
  </table>
			</div>
			<div class="row text-center">
			&copy; Iskul - Education Management System
			</div>	
					
			    </div>
			</div>
		</div>
	</div>
</div>
						<?php
						}
						?>		

		<!-- end of Page content -->
<?php
foot();
}
}
?>