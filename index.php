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

$head = Array(
'title' => settings('sitename') . ' - ' . settings('sitetitle')
);
head($head);
?>
	<div class="container">
    <div class="row vertical-offset-50">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/>Iskul - Education Management System<br/>(In Progress)</h3>
			 	</div>
			  	<div class="panel-body">
			
			<div class="row">
			<div class="progress skill-bar ">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100">
                    <span class="skill">Project Completed <i class="val">73%</i></span>
                </div>
            </div>
            </div>
			
			<div class="row animated fadeIn">
			<table class="table">
    <tbody>
      <tr>
        <td>Software Version</td>
        <td>PHP 5.x</td>
      </tr>
      <tr>
        <td>Files Included</td>
        <td>HTML, CSS, JavaScript, PHP, MySQL</td>
      </tr>
      <tr>
        <td>Compatible Browsers</td>
        <td>IE9, IE10, IE11, Firefox, Safari, Opera, Chrome, Edge</td>
      </tr>
      <tr>
        <td>Modules</td>
        <td>16</td>
      </tr>
    </tbody>
  </table>
			</div>
			
			<div class="row text-center">
			<a href="<?php _e(base_url());?>login/" class="btn btn-demo font-20">VIEW DEMO</a>
			<br>
			<a href="<?php _e(base_url());?>online-admission/" class="btn btn-demo font-20">ONLINE ADMISSION</a>
			</div>
			
			<div class="row text-center">
			&copy; Iskul - Education Management System
			</div>
			
			    </div>
			</div>
		</div>
	</div>
</div>
<?php  foot(); ?>