<?php
/**
 * @name			DevsBangla Education
 * @category		E-Commerce
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/e-commerce/
**/

function stripslashes_from_strings_only( $value ) {
	return is_string( $value ) ? stripslashes( $value ) : $value;
}
function map_deep( $value, $callback ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $index => $item ) {
			$value[ $index ] = map_deep( $item, $callback );
		}
	} elseif ( is_object( $value ) ) {
		$object_vars = get_object_vars( $value );
		foreach ( $object_vars as $property_name => $property_value ) {
			$value->$property_name = map_deep( $property_value, $callback );
		}
	} else {
		$value = call_user_func( $callback, $value );
	}

	return $value;
}
function stripslashes_deep( $value ) {
	return map_deep( $value, 'stripslashes_from_strings_only' );
}
function unslash( $value ) {
	return stripslashes_deep( $value );
}
function hyphenonly($string) {
 $string = strtolower( preg_replace('@[\W_]+@', '-', $string) );
 $string = ltrim($string,'-');
 return $string;
}
function underscoreonly($string) {
 $string = strtolower( preg_replace('@[\W_]+@', '_', $string) );
 return $string;
}
function textonly($string) {
 $string = strtolower( preg_replace('@[\W_]+@', '', $string) );
 return $string;
}
function numberonly($string) {
 $string = strtolower( preg_replace('@[\D_]+@', '', $string) );
 if ($string<0||$string==null||$string==null)$string=0;
 return $string;
}
function validtext($string) {
 $string = preg_replace('#[^A-Za-z0-9-./]#', '', $string);
 return $string;
}
function clean($string) {
 $string = trim($string);
 $string = strtolower( preg_replace('@[\W_]+@', '-', $string) );
 $string = trim($string);
 $string = strtolower( preg_replace('@[\W_]+@', '-', $string) );
 $string = ltrim($string);
 return $string; // Removes special chars.
}
function _img($path=null,$alt=null,$class='img')
{
if($path==null)
{
echo '<img src="'.base_url().'images/nophoto.jpg" alt="" class="img-responsive">';
}
else
{
echo '<img src="'.base_url().$path.'" alt="'.$alt.'" class="'.$class.'">';
}
}

function head($array)
{
global $config;
$author = 'Sajjad Hossain';
$og_url = $config['host_protocol'].$_SERVER['HTTP_HOST'];
/** Array Informations */
isset($array['title'])? $title = $array['title'] : $title=null;
isset($array['description'])? $description = $array['description'] : $description=null;
isset($array['keywords'])? $keywords = $array['keywords'] : $keywords=null;
isset($array['images'])? $og_image = $array['images'] : $og_image=null;
isset($array['page'])?$page = $array['page']:$page=null;
/** Array Informations */
echo '<!DOCTYPE html>
<html>
<head>
<title>'.$title.'</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta http-equiv="content-language" content="en" />
  <meta name="robots" content="all"/>
  <meta name="robots" content="index, follow"/>
  <meta name="classification" content="reference" />
  <meta name="rating" content="general" />
  <meta name="description" content="'.$description.'">
  <meta name="keywords" content="'.$keywords.'">
  <meta property="og:title" content="'.$title.'" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="'.$og_url.'" />
  <meta property="fb:admins" content="189705028165702"/>
  <meta property="og:image" content="'.$og_image.'" />
  <meta property="og:description" content="'.$description.'" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="distribution" content="global" />
  <meta name="author" content="'.$author.'" />
  <meta name="google-site-verification" content="4T_8elyHJs1n5DiDE8ooEopyLYQ-YQWhi1U7RTtjZhg" />
  <link rel="canonical" href="'.$og_url.'">
  <link rel="icon" type="image/png" href="'.base_url().settings('favicon').'">
  <link href="'.base_url().'themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="'.base_url().'themes/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="'.base_url().'themes/css/styles.css" rel="stylesheet">
  <link href="'.base_url().'themes/animate.css/animate.css" rel="stylesheet">';
switch ($page)
{
case 'dashboard':
{
echo '
    <!-- NProgress -->
    <link href="'.base_url().'themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="'.base_url().'themes/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="'.base_url().'themes/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="'.base_url().'themes/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">

    <!-- Custom Theme Style -->
    <link href="'.base_url().'themes/build/css/custom.css" rel="stylesheet">
	';
}
break;
case 'add-notice':
case 'edit-notice':
case 'delete-notice':
{
echo '
    <!-- NProgress -->
    <link href="'.base_url().'themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="'.base_url().'themes/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="'.base_url().'themes/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="'.base_url().'themes/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="'.base_url().'themes/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="'.base_url().'themes/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="'.base_url().'themes/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="'.base_url().'themes/build/css/custom.min.css" rel="stylesheet">
    <link href="'.base_url().'themes/editor/css/bootstrap-markdown.min.css" rel="stylesheet">
    <link href="'.base_url().'themes/editor/css/styles.css" rel="stylesheet">
	';
}
break;
case 'manage-notice':
{
echo '
    <!-- NProgress -->
    <link href="'.base_url().'themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="'.base_url().'themes/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="'.base_url().'themes/build/css/custom.min.css" rel="stylesheet">
';
}
break;
case 'gallery':
{
echo '
    <link href="'.base_url().'themes/lightbox/lightbox.css" rel="stylesheet">
';
}
break;
default:
{

}
//Case end
}

echo '</head>
<body>';
if (settings('site-preloader'))
{

echo '
<div class="preload">
<div class="preloader"></div>
</div>
';

}
switch($page)
{
case 'dashboard':
case 'add-notice':
case 'manage-notice':
case 'edit-notice':
case 'delete-notice':
{
}
break;
default:
{
if(user::admininses()){dashboardheader();}


} // case completed

} // Switch End
}
function dashboardheader()
{
echo '<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="'.base_url().user::inses()->avatar.'" alt="'.user::inses()->name.'">'.user::inses()->name.'
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="'.base_url().'user/'.user::inses()->username.'"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="'.base_url().'logout/"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="'.base_url().'images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="'.base_url().'images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="'.base_url().'images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="'.base_url().'images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
';

}
function dashboardfooter()
{
echo '        <!-- footer content -->
        <footer>
          <div class="pull-right">
           &copy; 2016 <b>Iskul - Education Management System</b> Developed by <a href="https://phpans.com/scripts/"><b>PHPANS</b></a>
          </div>
          <div class="clearfix"></div>
        </footer>

        <!-- /footer content -->
		<!-- jQuery -->
    <!-- jQuery -->
    <script src="'.base_url().'themes/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="'.base_url().'themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="'.base_url().'themes/build/js/custom.js"></script>
	<script src="'.base_url().'themes/editor/js/content.js"></script>
	<script src="'.base_url().'themes/js/contents.js"></script>
	<a href="#top" class="cd-top">Top</a>';
  echo '<div id="base_url" style="display:none">'.base_url().'</div>';

}
function dashboardleftmenu()
{
$db = MysqliDb::getInstance();
						echo '
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-university"></i> <span>'.settings('sitename').'</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="'.base_url().user::inses()->avatar.'" alt="'.user::inses()->name.'" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>'.user::inses()->name.'</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="'.base_url().'dashboard/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				  <li><a><i class="fa fa-line-chart"></i> Attendance <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-attendence/">Manage Attendance</a></li>
                      <li><a href="'.base_url().'dashboard/attendence-report/">Attendance Report</a></li>
                      <li><a href="'.base_url().'dashboard/teacher-attendence/">Teachers Attendance</a></li>
                    </ul>
				  </li>
				  <li><a><i class="fa fa-newspaper-o"></i> Notice Board <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/add-notice/">Add Notice</a></li>
                      <li><a href="'.base_url().'dashboard/manage-notice/">Manage Notice</a></li>
                    </ul>
				  </li>
				';
              echo '<li><a><i class="fa fa-group"></i> Students <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-student/">Manage Student</span></a></li>
                      <li><a href="'.base_url().'dashboard/admit-student/">Admit Student</a></li>
                    </ul>
                  </li>';
				$requests = $db->where('status',0)->get('online_admission');
                  echo '<li><a><i class="fa fa-group"></i> Online Admission <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/admission-requests/">Admission Requests <span class="badge">'.$db->count.'</span></a></li>
                      <li><a href="'.base_url().'dashboard/manage-student/">Manage Student</span></a></li>
                      <li><a href="'.base_url().'dashboard/admit-student/">Admit Student</a></li>
                    </ul>
                  </li>';
				
                  echo '<li><a><i class="fa fa-search"></i> Result <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-promotion/">Student Promotion</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-mortar-board"></i> Teachers <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-teacher/">Manage Teacher</a></li>
                      <li><a href="'.base_url().'dashboard/add-teacher/">Add Teacher</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> Parents <span class="fa fa-plus"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-parent/">Manage Parent</a></li>
                      <li><a href="'.base_url().'dashboard/add-parent/">Add Parent</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-cubes"></i> Class <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-class/">Manage Class</a></li>
                      <li><a href="'.base_url().'dashboard/add-class/">Add Class</a></li>
                    </ul>
				  </li>
				  <li><a><i class="fa fa-cubes"></i> Section <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/manage-section/">Manage Section</a></li>
                      <li><a href="'.base_url().'dashboard/add-section/">Add Section</a></li>
                    </ul>
				  </li>
				    
				  <li><a><i class="fa fa-tasks"></i> Class Routine <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/view-routine/">View Routine</a></li>
                      <li><a href="'.base_url().'dashboard/add-routine/">Add Class Routine</a></li>

                    </ul>
				  </li>
  
				  <li><a><i class="fa fa-book"></i> Subjects <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/add-subject/">Add Subject</a></li>
                      <li><a href="'.base_url().'dashboard/manage-subject/">Manage Subject</a></li>
                    </ul>
				  </li>
				  
				  
				  <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/general-settings/">General Settings</a></li>
                      <li><a href="'.base_url().'dashboard/sms-settings/">SMS Settings</a></li>
                      <li><a href="'.base_url().'dashboard/alert-settings/">Alert Settings</a></li>
                      <li><a href="'.base_url().'dashboard/styles-settings/">Styles Settings</a></li>
                    </ul>
				  </li>
	
				  <li><a><i class="fa fa-mobile"></i> SMS <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/individual-sms/">Individual SMS</a></li>
                      <li><a href="'.base_url().'dashboard/bulk-sms/">Bulk SMS</a></li>
                    </ul>
				  </li>
	
				  <li><a><i class="fa fa-photo"></i> Gallery <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/add-gallery-photo/">Add Photo</a></li>
                      <li><a href="'.base_url().'dashboard/gallery/">Gallery</a></li>
                    </ul>
				  </li>
  
	
				  <li><a><i class="fa fa-industry"></i> Exam <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/exam-type-list/">Exam Type List</a></li>
                      <li><a href="'.base_url().'dashboard/add-exam/">Add Exam</a></li>
                      <li><a href="'.base_url().'dashboard/exam-result/">Exam Result</a></li>
                      <li><a href="'.base_url().'dashboard/manage-mark/">Manage Mark</a></li>
                      <li><a href="'.base_url().'dashboard/send-result/">Send Result</a></li>
                      <li><a href="'.base_url().'dashboard/tabulation-sheet/">Tabulation Sheet</a></li>
                      <li><a href="'.base_url().'dashboard/exam-grade/">Exam Grade</a></li>
                    </ul>
				  </li>
 
	
				  <li><a><i class="fa fa-money"></i> Payments <span class="fa fa-plus"></span></a>
				  <ul class="nav child_menu">
                      <li><a href="'.base_url().'dashboard/payment-generate/">Payment Generate</a></li>
                      <li><a href="'.base_url().'dashboard/payment-report/">Payment Report</a></li>
                      <li><a href="'.base_url().'dashboard/payment-type/">Payment Type</a></li>
                      <li><a href="'.base_url().'dashboard/payment-fee/">Payment Fee</a></li>
                    </ul>
				  </li>

                </ul>
              </div>
			  

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout/">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>';
}
function foot()
{
global $config;
echo '<!-- jQuery -->
    <script src="'.base_url().'themes/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="'.base_url().'themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="'.base_url().'themes/build/js/custom.js"></script>
	<script src="'.base_url().'themes/editor/js/content.js"></script>
	<script src="'.base_url().'themes/js/contents.js"></script>';
echo '<div id="base_url" style="display:none">'.base_url().'</div>';
echo '</body>';
echo '</html>';
exit();
}
function error($array=null)
{
isset($array['title'])?$title=$array['title']:$title='Object not found!';
isset($array['description'])?$description=$array['description']:$description='Sorry, but the page you were trying to view does not exist.';;
return '
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
';
}
function html_code($str)
{
return $str;
}
function ads($str)
{
return $str;
}
function display($text)
{
global $config;
$text = htmlspecialchars($text);
$text = nl2br($text);
$text = preg_replace("/\[h1\](.*?)\[\/h1\]/i","<h1>\\1</h1>", $text);
$text = preg_replace("/\[h2\](.*?)\[\/h2\]/i","<h2>\\1</h2>", $text);
$text = preg_replace("/\[h3\](.*?)\[\/h3\]/i","<h3>\\1</h3>", $text);
$text = preg_replace("/\[h4\](.*?)\[\/h4\]/i","<h4>\\1</h4>", $text);
$text = preg_replace("/\[h5\](.*?)\[\/h5\]/i","<h5>\\1</h5>", $text);
$text = preg_replace("/\[h6\](.*?)\[\/h6\]/i","<h6>\\1</h6>", $text);
$text = preg_replace("/\[b\](.*?)\[\/b\]/i","<b>\\1</b>", $text);
$text = preg_replace("/\[span\](.*?)\[\/span\]/i","<span>\\1</span>", $text);
$text = preg_replace("/\[i\](.*?)\[\/i\]/i","<i>\\1</i>", $text);
$text = preg_replace("/\[u\](.*?)\[\/u\]/i","<u>\\1</u>", $text);
$text = preg_replace("/\[big\](.*?)\[\/big\]/i","<big>\\1</big>", $text);
$text = preg_replace("/\[small\](.*?)\[\/small\]/i","<small>\\1</small>", $text);
$text = preg_replace("/\[blink\](.*?)\[\/blink\]/i","<blink>\\1</blink>", $text);
$text = preg_replace("/\[del\](.*?)\[\/del\]/i","<del>\\1</del>", $text);
$text = preg_replace("/\[table\](.*?)\[\/table\]/i","<table class='table table-striped'>\\1</table>", $text);
$text = preg_replace("/\[tr\](.*?)\[\/tr\]/i","<tr>\\1</tr>", $text);
$text = preg_replace("/\[td\](.*?)\[\/td\]/i","<td>\\1</td>", $text);
$text = preg_replace("/\[ul\](.*?)\[\/ul\]/i","<ul>\\1</ul>", $text);
$text = preg_replace("/\[li\](.*?)\[\/li\]/i","<li>\\1</li>", $text);
$text = preg_replace("/\[code\](.*?)\[\/code\]/i","<pre><code>\\1</code></pre>", $text);
// $text = preg_replace("/\[html\](.*?)\[\/html\]/i","\\1", $text);

$text = preg_replace("/\[blockquote\](.*?)\[\/blockquote\]/i","<blockquote>\\1</blockquote>", $text);
$text = preg_replace("/\[highlight_word\](.*?)\[\/highlight_word\]/i","<span class=\"highlight_word\">$1</span>",$text);
$text = preg_replace("/\[center\](.*?)\[\/center\]/i","<div class=\"text-center\">\\1</div>", $text);
$text = preg_replace("/\[left\](.*?)\[\/left\]/i","<div class=\"text-left\">\\1</div>", $text);
$text = preg_replace("/\[right\](.*?)\[\/right\]/i","<div class=\"text-right\">\\1</div>", $text);
$text = preg_replace("/\[input\](.*?)\[\/input\]/i","<input name=\"bbcode\" value=\"\\1\"/>", $text);
$text = preg_replace("/\[submit\](.*?)\[\/submit\]/i","<input type=\"submit\" value=\"\\1\"/>", $text);
$text = preg_replace("/\[divid\=(.*?)\](.*?)\[\/div\]/is","<div id=\"$1\">$2</div>",$text);
$text = preg_replace("/\[bg\=(.*?)\](.*?)\[\/bg\]/is","<div style=\"background-color:$1;color:#FFF;border-radius:5px;-webkit-border-radius:5px;padding:10px\">$2</div>",$text);
$text = preg_replace("/\[style\=(.*?)\](.*?)\[\/style\]/is","<div style=\"$1\">$2</div>",$text);
$text = preg_replace("/\[spanstyle\=(.*?)\](.*?)\[\/spanstyle\]/is","<span style=\"$1\">$2</span>",$text);

$text = preg_replace("/\[div\=(.*?)\](.*?)\[\/div\]/is","<div class=\"$1\">$2</div>",$text);
$text = preg_replace("/\[button\=(.*?)\](.*?)\[\/button\]/is","<button class=\"$1\">$2</button>",$text);
$text = preg_replace("/\[fa\=(.*?)\](.*?)\[\/fa\]/is","<i class=\"fa $1 $2\" aria-hidden=\"true\"></i>",$text);
$text = preg_replace("/\[call\=(.*?)\](.*?)\[\/call\]/is","<a href=\"wtai://wp/mc;$1\">$2</a>",$text);
$text = preg_replace("/\[image\=(.*?)\](.*?)\[\/image\]/is","<a href=\"$1\" target=\"_blank\"><img src=\"$1\" alt=\"\$2\"></a>",$text);
// $text = preg_replace("/\[youtube\=(.*?)\](.*?)\[\/youtube\]/is","<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/$1\"></param><embed src=\"http://www.youtube.com/v/$1\" type=\"application/x-shockwave-flash\" width=\"425\" height=\"350\"></embed></object>",$text);
$text = preg_replace("/\[youtube\=(.*?)\](.*?)\[\/youtube\]/is","<iframe class=\"youtube\" id=\"player\" type=\"text/html\" src=\"https://www.youtube.com/embed/$1\" frameborder=\"0\"></iframe>",$text);
$text = preg_replace("/\[video\=(.*?)\](.*?)\[\/video\]/is","<iframe id=\"player\" type=\"text/html\" width=\"800\" height=\"500\" src=\"/embed-player.php?u=$1\" frameborder=\"0\"></iframe>",$text);
$text = str_replace("[br/]","<br/>",$text);
$text = str_replace('\\r\\n',"<br/>",$text);
$text = str_replace('\r\n',"<br/>",$text);
$text = str_replace('\\n',"<br/>",$text);
$text = str_replace('\n',"<br/>",$text);
$text = str_replace("[hr/]","<hr>",$text);
$text = str_replace('&amp;',"&",$text);
$text = str_replace('[:lt]',"&lt;",$text);
$text = str_replace('[:gt]',"&gt;",$text);
$text = preg_replace("/\[color\=(.*?)\](.*?)\[\/color\]/is","<font color=\"$1\">$2</font>",$text);

$text = preg_replace("/\[externalurl\=(.*?)\](.*?)\[\/externalurl\]/is","<a  rel=\"nofollow\" class=\"plain\" target=\"_blank\" href=\"$1\">$2 <i class=\"fa fa-external-link\"></i></a>",$text);
$text = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is","<a class=\"plain\" href=\"$1\">$2</a>",$text);

return $text;
}
function wordonly($str,$word)
{
$i=0;
$str = strip_tags($str);
$str = explode(' ',$str);
$count = count($str);
if($count<$word){$ret=$count;}else{$ret=$word;}
$words='';
for($i>0;$i<$ret;$i++)
{
$words.= trim($str[$i]). ' ';
}
return $words;
}
function settings($name)
{
global $config;
$db = MysqliDb::getInstance();
$settings = $db->where('name',$name)->getValue ("settings","value");
return $settings;
}

function getvalue($row,$from,$table,$show)
{
global $config;
$db = MysqliDb::getInstance();
$settings = $db->where($row,$from)->getValue ($table,$show);
return $settings;
}
function hasvalue($row,$from,$table,$show)
{
global $config;
$db = MysqliDb::getInstance();
$settings = $db->where($row,$from)->has ($table,$show);
if($settings){return true;}else{return false;}
}

function realeacape($str)
{
global $config;
$db = MysqliDb::getInstance();
return $db->escape ($str);
}
function _e($s)
{
echo $s;
}
function activitylog($title,$log)
{
global $config;
$db = MysqliDb::getInstance();
					$logdata = Array (
						'title' => $title,
						'log' => $log,
						'time' => $db->now()
					);
return $db->insert ('log', $logdata);
}
function invalidemail($email) {
if (preg_match("/^([._a-z0-9-]+[._a-z0-9-]*)@(([a-z0-9-]+\.)*([a-z0-9-]+)(\.[a-z]{2,3}))$/", $email)) {
return false;
} else {
return true;
}
}
function sms($array=null)
{
if (empty($array)&&!is_array($array)){return false;}
else
$message=$array['message'];
$number=$array['number'];
$api = '';
if($api){return true;}
}
// function base_url()
// {
// global $config;
// return $config['sitelink'];
// }

function base_url()
{
  $base_url = (isset($_SERVER['HTTPS']) &&
  $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
$tmpURL = dirname(__FILE__);
$tmpURL = str_replace(chr(92),'/',$tmpURL);
$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
$tmpURL = ltrim($tmpURL,'/');
$tmpURL = rtrim($tmpURL, '/');
$tmpURL = str_replace('/functions','',$tmpURL);
$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
return $base_url.'/'; 
}
?>