<?php
/**
 * @name			DevsBangla E-Commerce
 * @category		E-Commerce
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/e-commerce/
**/
if (!file_exists("../config.php"))
{
header ("Location: ../installer.php");
exit;
}
require_once("../config.php");
require_once( ROOT_DIR . "functions/static.class.php");
require_once( ROOT_DIR . "functions/dynamic.class.php");
require_once( ROOT_DIR . "functions/basic.functions.php");
global $config;
$main = new main;
$user = new user;
$db = MysqliDb::getInstance();
if (!user::admininses())
{
$error =Array(
'title'			=>	'Access Denied',
'description'	=>	'Sorry, You cannot access thisp page because you are not an authorized Administrator/staff!'
);
die (error($error));
}
$head = Array(
'title' => 'Dashboard',
'page' => 'dashboard'
);
head($head);
adminheader();
?>

			<div class="dashContent">
				<div class="container-fluid">
					<div class="row">
				<?php adminleftmenu(); ?>
						<div class="col-lg-10">
							<div class="dash_main_content">
								<div class="dash_content_title">
									<p>Domain.com</p>
									<p>Dashboard</p>
								</div>
								<div class="dash_var_content">
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dashFooter">
				<div class="container-fluid">
					
				</div>
			</div>
		
        <!-- your site or application content ends here -->
		
        <!-- your site or application content ends here -->
<script src="/themes/js/jquery.min.js"></script>
<script src="/dashboard/js/admin.js"></script>

    </body>
</html>
