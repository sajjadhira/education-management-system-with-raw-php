<?php
/**
 * @name			Iskul - Education Management System
 * @category		Framework
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @Author URL		https://phpans.com
 * @Theme URL		https://phpans.com/demo/eskul/
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
if (!user::inses())
{
$error =Array(
'title'			=>	'Access Denied',
'description'	=>	'Sorry, You cannot access this page because you are not an authorized Administrator/staff!'
);
die (error($error));
}
isset($_GET['action']) ? $action = hyphenonly($_GET['action']) : $action=NULL;
switch($action)
{
case 'action':
{
}
default:
{
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
        
        <!-- page content -->
        <div class="right_col" role="main">


          <div class="">
            <div class="row top_tiles">
              <div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats students">
                  <div class="icon"><i class="fa fa-group"></i></div>
                  <div class="count">
				  <?php
				  $db->where ('privilege', getvalue('title','student','users_role','role'))->get('users');
				  echo $db->count;
				  ?>
				  </div>
                  <h3>Students</h3>
				  <p>Total Students</p>
                </div>
              </div>
			    
				<div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats parents">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count">
				  <?php
				  $db->where ('privilege', getvalue('title','parent','users_role','role'))->get('users');
				  echo $db->count;
				  ?>
				  </div>
                  <h3>Parents</h3>
                  <p>Total Parents</p>
                </div>
              </div>
			  
              <div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats teachers">
                  <div class="icon"><i class="fa fa-mortar-board"></i></div>
                  <div class="count">
				 <?php
				  $db->where ('privilege', getvalue('title','teacher','users_role','role'))->get('users');
				  echo $db->count;
				  ?>
				  </div>
                  <h3>Teachers</h3>
				  <p>Total Teachers</p>
                </div>
              </div>
              <div class="animated fadeIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats attendance">
                  <div class="icon"><i class="fa fa-bar-chart-o"></i></div>
                  <div class="count">
				  <?php
				  $studentrole = getvalue('title','student','users_role','role'); 
				  $db->where ('date', date('Y-m-d'))->where('role',$studentrole)->where('status',1)->get('attendence');
				  echo $db->count;
				  ?>
				  </div>
                  <h3>Attendance</h3>
                  <p>Total present student today</p>
                </div>
              </div>
            </div>

 <div class="row animated fadeIn">
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Recent Notice</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
$items = $db->orderBy("id","Desc")->get ("notice",5);
if ($db->count > 0)
    foreach ($items as $item) { 
				  ?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php _e(date('M',strtotime($item['time']))); ?></p>
                        <p class="day"><?php _e(date('d',strtotime($item['time']))); ?></p>
                      </a>
                      <div class="media-body">
                        <h3><a class="title" href="<?php _e(base_url());?>notice/<?php _e($item['id'])?>/"><?php _e($item['title']); ?></a></h3>
                        <p><?php _e(wordonly(display($item['description']),10))._e('...'); ?></p>
                      </div>
                    </article>
					
<?php
	}
?>

                  </div>
                </div>
              </div>
			  
			  
			  
			  
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Activities</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
     				  <?php
$logs = $db->orderBy("id","Desc")->ObjectBuilder()->get ("log",5);
if ($db->count > 0)
    foreach ($logs as $log) { 
				  ?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?php _e(date('M',strtotime($log->time))); ?></p>
                        <p class="day"><?php _e(date('d',strtotime($log->time))); ?></p>
                      </a>
                      <div class="media-body">
                        <h3><?php _e($log->title); ?></h3>
                        <p><?php _e($log->log); ?> - <i><?php _e(date('d M Y h:i:s a',strtotime($log->time))); ?></i></p>
                      </div>
                    </article>
					
<?php
	}
?>
                  </div>
                </div>
              </div> 
			  
			  
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Quick Links</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <div class="row">
                 
					<a href="<?php echo base_url(); ?>dashboard/teacher-attendence/"><button type="button" class="btn btn-info">Teachers Attendance</button></a>
					
					<a href="<?php echo base_url(); ?>dashboard/manage-attendence/"><button type="button" class="btn btn-info">Student Attendance</button></a>
					
					<a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-info">Notice Board</button></a>
					
					
					<a href="<?php echo base_url(); ?>dashboard/view-routine/"><button type="button" class="btn btn-info">Class Routine</button></a>
					
					<a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-info">Settings</button></a>
					
					<a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-info">Payments</button></a>
				
					</div>
                  </div>
                </div>
              </div>
</div><!-- row end -->



            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Event Schedule</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="calendar"></div>

                  </div>
                </div>
              </div>
            </div>
			
			
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php dashboardfooter(); ?>
      </div>
    </div>

<!-- jQuery -->

    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>themes/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>themes/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>themes/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url(); ?>themes/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>themes/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>themes/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>themes/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>themes/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>themes/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>themes/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>themes/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>themes/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>themes/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>themes/fullcalendar/dist/fullcalendar.min.js"></script>
	<!-- Count Up -->
    <script src="<?php echo base_url(); ?>themes/countUp/jquery.counterup.min.js"></script>

  </body>
</html>
<?php
}

} // case end
