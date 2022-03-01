<?php
/**
 * @name			Iskul - Education Management System
 * @category		Education
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/eskul/
**/
if (!file_exists("../config.php"))
{
header ("Location: /installer.php");
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
'description'	=>	'Sorry, You cannot access this page because you are not an authorized Administrator/staff!'
);
die (error($error));
}
isset($_GET['action']) ? $action = textonly($_GET['action']) : $action=NULL;
$head = Array(
'title' => 'Dashboard',
'page' => 'dashboard'
);
head($head);
?>



  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>





<?php dashboardfooter(); ?>
      </div>
    </div>

<!-- jQuery -->
    <script src="/themes/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/themes/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/themes/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/themes/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="/themes/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="/themes/Flot/jquery.flot.js"></script>
    <script src="/themes/Flot/jquery.flot.pie.js"></script>
    <script src="/themes/Flot/jquery.flot.time.js"></script>
    <script src="/themes/Flot/jquery.flot.stack.js"></script>
    <script src="/themes/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/themes/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/themes/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/themes/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/themes/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/themes/moment/min/moment.min.js"></script>
    <script src="/themes/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/themes/fullcalendar/dist/fullcalendar.min.js"></script>
	<!-- Count Up -->
    <script src="/themes/countUp/jquery.counterup.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="/themes/build/js/custom.min.js"></script>
    <script src="/themes/js/contents.js"></script>
  </body>
</html>