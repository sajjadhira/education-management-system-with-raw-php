<?php
/**
 * @name			Iskul - Education Management System
 * @category		Framework
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/eskul/
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
case 'manage':
{
$registration =false;
isset($_GET['section'])?$section=numberonly($_GET['section']):$section=null;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
$class = getvalue('id',$section,'section','class');
$sectioninfo = $db->where ('id', $section)->ObjectBuilder()->getOne("section");
$classinfo = $db->where ('class', $sectioninfo->class)->ObjectBuilder()->getOne("class");

isset($_POST['processchange'])?$processchange=numberonly($_POST['processchange']):$processchange=null;
isset($_POST['section'])?$sectionchange=numberonly($_POST['section']):$sectionchange=null;
isset($_POST['date'])?$datechange=$_POST['date']:$date=null;
if($processchange==1)
{
ob_clean();
$location = '/dashboard/attendence/section-'.$sectionchange.'/manage/'.strtotime($datechange).'/';
echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
$head = Array(
'title' => 'Manage Attendence For Class '.$classinfo->name. ' Section '.$sectioninfo->name.' '.$sectioninfo->title.'',
'page' => 'dashboard'
);
head($head);
isset($_GET['date'])?$date=numberonly($_GET['date']):$date=0;
?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="/dashboard/attendence-report/"><button type="button" class="btn btn-warning btn-xs">Attendence Report</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">

                <form method="post" class="animated fadeIn form-horizontal form-label-left input_mask">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="section" class="form-control" required>
                        <option value="">--Select Section--</option>
					  <?php
					  $SectionChanger = $db->where('class',$class)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($SectionChanger as $SC) { 
					if($section==$SC->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$SC->id.'"'.$selected.'>'.$SC->name.' '.$SC->title.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" id="date" class="date-picker form-control col-md-7 col-xs-12" type="date" value="<?php echo date("Y-m-d",$date);?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="processchange" value="1">
                          <button type="submit" class="btn btn-success">Manage Attendence</button>
                        </div>
                      </div>

                    </form>
<div class="ln_solid"></div>

<form method="post" class="form-horizontal form-label-left input_mask">
<?php
/** **/
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=0;
isset($_POST['student'])?$students =$_POST['student']:$students=0;
$query='';
if(is_array($students)){foreach($students as $student)
{
$studentdata = $db->where('id',$student)->ObjectBuilder()->getOne('student');
$status = $_POST["attendence_$student"];
$exists = $db->where ('uid',$student)->where('date',date('Y-m-d',$date))->has ('attendence');
if($exists)
{
$data = Array (
    'uid' => $student,
    'byid' => user::inses()->id,
    'status' => $status,
    'role' => getvalue('title','student','users_role','role'),
    'date' => date('Y-m-d',$date)
);
$query.= $db->where('uid',$student)->update ('attendence', $data);
$did = 'updated';
}
else
{
$data = Array (
    'uid' => $student,
    'byid' => user::inses()->id,
    'status' => $status,
    'role' => getvalue('title','student','users_role','role'),
    'date' => date('Y-m-d',$date)
);
$query.= $db->insert ('attendence', $data);
$did = 'added';
}

if ($did=='added'&&$status==0)
{
/**
 @* SMS Alert
**/
$sms = Array(
'message' => 'Hello '.user::info($studentdata->parent)->name . ' Your student '.user::info($studentdata->uid)->name. ' absent in school today. \n From- '.settings('sitename'),
'number' => user::info($studentdata->parent)->phonenumber
);
sms($sms);

}

}


if($query)
{

/**
 @* Log 
**/
$title = 'Student Attendence';
$log = '<b>'.user::inses()->name . '</b> managed attendence for <b>Class '.$classinfo->name. ' Section ('.$sectioninfo->name.' - '.$sectioninfo->title.')</b> date <b>'.date('Y-m-d',$date).'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Attendence has been '.$did.' successfully!';
echo '</div>';
}

}
/** **/

					  					  
					  $students = $db->where('section',$section)->where('class',$classinfo->id)->orderBy("id","Asc")->ObjectBuilder()->get ("student");
					if ($db->count > 0)
					{
						echo '<h2 class="text-center">Class '.$classinfo->name. ' Section '.$sectioninfo->name.' '.$sectioninfo->title.' - Date: '.date('d F Y',$date).'</h2>';
						echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Class Roll</th>
                          <th style="width: 20%">Name</th>
                          <th style="width: 20%">Status</th>
                        </tr>
                      </thead>
                      <tbody>';	
						foreach ($students as $student) { 						
						 echo '<tr>';
						 echo '<td>#</td>';
						 echo '<td>'.$student->classroll.'</td>';
						 echo '<td>'
						 .user::info($student->uid)->name.
						 '
						 <input type="hidden" name="student[]" value="'.$student->uid.'"
						 </td>';
						 isset(user::attendence($student->uid,date('Y-m-d',$date))->status)?$status=user::attendence($student->uid,date('Y-m-d',$date))->status:$status=null;
						 if($status==1){$present=' selected';}else{$present='';}
						 if($status==0){$absent=' selected';}else{$absent='';}
						 echo '<td>
						 <select class="form-control" name="attendence_'.$student->uid.'" required>
						 <option value="">--Select--</option>
						 <option value="1"'.$present.'>Present</option>
						 <option value="0"'.$absent.'>Absent</option>
						 </select>
						 </td>';
						 echo '</tr>';
						}
					echo ' 
                      </tbody>
                    </table>';
					echo '<input type="hidden" name="process" value="1">';
					echo '<div class="text-center"><button class="btn btn-primary" type="submit">Save Attendence</button></div>';
					}
					else
					{
					echo '<div class="alert alert-danger text-center">';
					echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No student found Class '.$classinfo->name.' Section '.$sectioninfo->name.' '.$sectioninfo->title;
					echo '</div>';
					}
?>
</form>
					</div>	
				
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'teacher':
{

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;

isset($_POST['processchange'])?$processchange=numberonly($_POST['processchange']):$processchange=null;
isset($_POST['date'])?$datechange=$_POST['date']:$date=null;
if($processchange==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/teacher/manage/'.strtotime($datechange).'/';
echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
$head = Array(
'title' => 'Manage Attendence For Teachers',
'page' => 'dashboard'
);
head($head);
isset($_GET['date'])?$date=numberonly($_GET['date']):$date=0;
?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/attendence-report/"><button type="button" class="btn btn-warning btn-xs">Attendence Report</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">

                <form method="post" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" id="date" class="date-picker form-control col-md-7 col-xs-12" type="date" value="<?php echo date("Y-m-d",$date);?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="processchange" value="1">
                          <button type="submit" class="btn btn-success">Manage Attendence</button>
                        </div>
                      </div>

                    </form>
<div class="ln_solid"></div>

<form method="post" class="animated fadeIn form-horizontal form-label-left input_mask">
<?php
/** **/
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=0;
isset($_POST['teacher'])?$teachers =$_POST['teacher']:$teachers=0;
$query='';
if(is_array($teachers)){foreach($teachers as $teacher)
{

$status = $_POST["attendence_$teacher"];
$exists = $db->where ('uid',$teacher)->where('date',date('Y-m-d',$date))->has ('attendence');
if($exists)
{
$data = Array (
    'uid' => $teacher,
    'byid' => user::inses()->id,
    'status' => $status,
    'role' => getvalue('title','teacher','users_role','role'),
    'date' => date('Y-m-d',$date)
);
$query.= $db->where('uid',$teacher)->update ('attendence', $data);
$did = 'updated';
}
else
{
$data = Array (
    'uid' => $teacher,
    'byid' => user::inses()->id,
    'status' => $status,
    'role' => getvalue('title','teacher','users_role','role'),
    'date' => date('Y-m-d',$date)
);
$query.= $db->insert ('attendence', $data);
$did = 'added';
}

}


if($query)
{


/**
 @* Log 
**/
$title = 'Teacher Attendence';
$log = '<b>'.user::inses()->name . '</b> managed attendence for teachers date <b>'.date('Y-m-d',$date).'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span>Teacher attendence has been '.$did.' successfully!';
echo '</div>';
}

}
/** **/

					  					  
					  $teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
					{
						echo '<h2 class="text-center">Teacher\'s Attendence - Date: '.date('d F Y',$date).'</h2>';
						echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Name</th>
                          <th style="width: 20%">Status</th>
                        </tr>
                      </thead>
                      <tbody>';	
						foreach ($teachers as $teacher) { 						
						 echo '<tr>';
						 echo '<td>#</td>';
						 echo '<td>'
						 .$teacher->name.
						 '
						 <input type="hidden" name="teacher[]" value="'.$teacher->id.'"
						 </td>';
						 isset(user::attendence($teacher->id,date('Y-m-d',$date))->status)?$status=user::attendence($teacher->id,date('Y-m-d',$date))->status:$status=null;
						 if($status==1){$present=' selected';}else{$present='';}
						 if($status==0){$absent=' selected';}else{$absent='';}
						 echo '<td>
						 <select class="form-control" name="attendence_'.$teacher->id.'" required>
						 <option value="">--Select--</option>
						 <option value="1"'.$present.'>Present</option>
						 <option value="0"'.$absent.'>Absent</option>
						 </select>
						 </td>';
						 echo '</tr>';
						}
					echo ' 
                      </tbody>
                    </table>';
					echo '<input type="hidden" name="process" value="1">';
					echo '<div class="text-center"><button class="btn btn-primary" type="submit">Save Attendence</button></div>';
					}
					else
					{
					echo '<div class="alert alert-danger text-center">';
					echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No teacher found!';
					echo '</div>';
					}
?>
</form>
					</div>	
				
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'report':
{
isset($_GET['section'])?$section=numberonly($_GET['section']):$section=null;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
$class = getvalue('id',$section,'section','class');
$sectioninfo = $db->where ('id', $section)->ObjectBuilder()->getOne("section");
$classinfo = $db->where ('class', $sectioninfo->class)->ObjectBuilder()->getOne("class");

isset($_POST['processchange'])?$processchange=numberonly($_POST['processchange']):$processchange=null;
isset($_POST['section'])?$sectionchange=numberonly($_POST['section']):$sectionchange=null;
isset($_POST['date'])?$datechange=$_POST['date']:$date=null;
if($processchange==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/section-'.$sectionchange.'/report/'.strtotime($datechange).'/';
echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
$head = Array(
'title' => 'Attendence For Class '.$classinfo->name. ' Section '.$sectioninfo->name.' '.$sectioninfo->title.'',
'page' => 'dashboard'
);
head($head);
isset($_GET['date'])?$date=numberonly($_GET['date']):$date=0;
?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/manage-attendence/"><button type="button" class="btn btn-primary btn-xs">Manage Attendence</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">

                <form method="post" class="form-horizontal form-label-left input_mask">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="section" class="form-control" required>
                        <option value="">--Select Section--</option>
					  <?php
					  $SectionChanger = $db->where('class',$class)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($SectionChanger as $SC) { 
					if($section==$SC->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$SC->id.'"'.$selected.'>'.$SC->name.' '.$SC->title.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Month
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" class="date-picker form-control col-md-7 col-xs-12" type="month" value="<?php echo date("Y-m",$date);?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="processchange" value="1">
                          <button type="submit" class="btn btn-success">Attendence Report</button>
                        </div>
                      </div>

                    </form>
<div class="ln_solid"></div>

<?php
echo '<h2 class="text-center">'.date('F Y',$date).'</h2>';
$monthday = date('t',$date);
$d=1;
echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 10%">Student <i class="fa fa-arrows-v" area-hidden="true"></i> Date <i class="fa fa-arrows-h" area-hidden="true"></i></th>
                          ';
for($d>0;$d<=$monthday;$d++)
{
echo '<th style="width: 3%">'.$d.'</th>';
}
						  
echo '</tr>
                      </thead>
                      <tbody>';

 $students = $db->where('section',$section)->orderBy("id","Asc")->ObjectBuilder()->get ("student");
if ($db->count > 0)
foreach($students as $student)
{
echo '<tr>';
echo '<td style="width: 10%">'.user::info($student->uid)->name.'</td>';
$monthday = date('t',$date);
$d=1;
for($d>0;$d<=$monthday;$d++)
{
isset(user::attendence($student->uid,date('Y-m-'.$d,$date))->status)?$status=user::attendence($student->uid,date('Y-m-'.$d,$date))->status:$status=null;
if($status==0){$showStatus='<div class="alert-danger text-center circle-radius-effect font-bold">a</div>';}else if($status==1){$showStatus='<div class="alert-success text-center circle-radius-effect font-bold">p</div>';}else{$showStatus='n/a';}
echo '<td style="width: 3%">'.$showStatus.'</td>';
}			
echo '</tr>';		  
}
echo '</tbody>
</table>';


// $db->join("users u", "p.uid=u.id", "LEFT");
// $products = $db->get ("student p", null, "u.name, p.uid");
// print_r ($products);
?>
					</div>	
				
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'individual':
{
isset($_GET['user'])?$user=numberonly($_GET['user']):$user=null;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
$userinfo = user::info($user);

isset($_POST['processchange'])?$processchange=numberonly($_POST['processchange']):$processchange=null;
isset($_POST['date'])?$datechange=$_POST['date']:$date=null;
if($processchange==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/individual/'.$userinfo->id.'/report/'.strtotime($datechange).'/';
echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
$head = Array(
'title' => 'Attendence Report Of '.$userinfo->name,
'page' => 'dashboard'
);
head($head);
isset($_GET['date'])?$date=numberonly($_GET['date']):$date=0;
?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/manage-attendence/"><button type="button" class="btn btn-primary btn-xs">Manage Attendence</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">

                <form method="post" class="form-horizontal form-label-left input_mask">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Month
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" class="date-picker form-control col-md-7 col-xs-12" type="month" value="<?php echo date("Y-m",$date);?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="processchange" value="1">
                          <button type="submit" class="btn btn-success">Attendence Report</button>
                        </div>
                      </div>

                    </form>
<div class="ln_solid"></div>

<?php
echo '<h2 class="text-center">'.date('F Y',$date).'</h2>';
$monthday = date('t',$date);
$d=1;
echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 10%">Student <i class="fa fa-arrows-v" area-hidden="true"></i> Date <i class="fa fa-arrows-h" area-hidden="true"></i></th>
                          ';
for($d>0;$d<=$monthday;$d++)
{
echo '<th style="width: 3%">'.$d.'</th>';
}
						  
echo '</tr>
                      </thead>
                      <tbody>';


echo '<tr>';
echo '<td style="width: 10%">'.user::info($userinfo->id)->name.'</td>';
$monthday = date('t',$date);
$d=1;
for($d>0;$d<=$monthday;$d++)
{
isset(user::attendence($userinfo->id,date('Y-m-'.$d,$date))->status)?$status=user::attendence($userinfo->id,date('Y-m-'.$d,$date))->status:$status=null;
if($status==0){$showStatus='<div class="alert-danger text-center circle-radius-effect font-bold">a</div>';}else if($status==1){$showStatus='<div class="alert-success text-center circle-radius-effect font-bold">p</div>';}else{$showStatus='n/a';}
echo '<td style="width: 3%">'.$showStatus.'</td>';
}			
echo '</tr>';		  

echo '</tbody>
</table>';

?>
					</div>	
				
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'manage-attendence':
{
$head = Array(
'title' => 'Manage Attendence',
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
            <div class="page-title">
              <div class="title_left">
                <h3>Manage <small>Attendence</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>
	
            <div class="row animated fadeIn">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Attendence</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/attendence-report/"><button type="button" class="btn btn-primary btn-xs">Attendence Report</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

				 <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
					  
						                    <!-- start project list -->
                      
						<?php

isset($_GET['class'])? $getclass=numberonly($_GET['class']):$getclass=1;
$class = $db->where('class',$getclass)->ObjectBuilder()->getOne("class");
						
echo '<h1 class="text-center">Manage Class '.$class->name.' Attendence</h1>';
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['section'])?$section=numberonly($_POST['section']):$section=null;
isset($_POST['date'])?$date=$_POST['date']:$date=null;
if($process==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/section-'.$section.'/manage/'.strtotime($date).'/';

echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
?>
                  <form method="post" class="form-horizontal form-label-left input_mask">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="section" class="form-control" required>
                        <option value="">--Select Section--</option>
					  <?php
					  $postclass = $class;
					  $sections = $db->where('class',$getclass)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.' '.$section->title.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" id="date" class="date-picker form-control col-md-7 col-xs-12" type="date" value="<?php echo date("Y-m-d");?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Manage Attendence</button>
                        </div>
                      </div>

                    </form>
<?php echo '</div>'; ?>


                      </div>



                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-right">
					  <?php
					  
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
						if($class->class==$getclass)
						{$cssclass=' class="active"';}
						else
						{$cssclass= '';}
						 echo '<li'.$cssclass.'><a href="'.base_url().'dashboard/manage-attendence/class-'.$class->class.'/" >Class '.$class->name.'</a></li>';

						}
					  
					  ?>
                      </ul>
                    </div>				  
                    </div>

                    <div class="clearfix"></div>

				  
				  
				  
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

	  </body>
	</html>
<?php
}
break;
case 'teacher-attendence':
{
$head = Array(
'title' => 'Teacher Attendence',
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
            <div class="page-title">
              <div class="title_left">
                <h3>Teacher <small>Attendence</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>
	
            <div class="row animated fadeIn">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Attendence</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/attendence-report/"><button type="button" class="btn btn-primary btn-xs">Attendence Report</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

				 <div class="col-xs-12">
                      <!-- Tab panes -->
                      <div class="tab-content">
					  
						                    <!-- start project list -->
                      
						<?php

echo '<h1 class="text-center">Teacher\'s Attendence</h1>';
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['date'])?$date=$_POST['date']:$date=null;
if($process==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/teacher/manage/'.strtotime($date).'/';

echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
?>
                  <form method="post" class="form-horizontal form-label-left input_mask">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" id="date" class="date-picker form-control col-md-7 col-xs-12" type="date" value="<?php echo date("Y-m-d");?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Manage Attendence</button>
                        </div>
                      </div>

                    </form>
<?php echo '</div>'; ?>


                      </div>
			  
                    </div>

                    <div class="clearfix"></div>

				  
				  
				  
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

	  </body>
	</html>
<?php
}
break;
case 'attendence-report':
{
$head = Array(
'title' => 'Attendence Report',
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
            <div class="page-title">
              <div class="title_left">
                <h3>Attendence <small>Report</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>
	
            <div class="row animated fadeIn">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Attendence</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/manage-attendence/"><button type="button" class="btn btn-primary btn-xs">Manage Attendence</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

				 <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
					  
						                    <!-- start project list -->
                      
						<?php

isset($_GET['class'])? $getclass=numberonly($_GET['class']):$getclass=1;
$class = $db->where('class',$getclass)->ObjectBuilder()->getOne("class");
						
echo '<h1 class="text-center">Attendence Report of Class '.$class->name.'</h1>';
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['section'])?$section=numberonly($_POST['section']):$section=null;
isset($_POST['date'])?$date=$_POST['date']:$date=null;
if($process==1)
{
ob_clean();
$location = base_url().'dashboard/attendence/section-'.$section.'/report/'.strtotime($date).'/';
echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
?>
                  <form method="post" class="form-horizontal form-label-left input_mask">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="section" class="form-control" required>
                        <option value="">--Select Section--</option>
					  <?php
					  $postclass = $class;
					  $sections = $db->where('class',$getclass)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.' '.$section->title.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Month
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="date" class="date-picker form-control col-md-7 col-xs-12" type="month" value="<?php echo date("Y-m");?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Attendence Report</button>
                        </div>
                      </div>

                    </form>
<?php echo '</div>'; ?>


                      </div>



                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-right">
					  <?php
					  
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
						if($class->class==$getclass)
						{$cssclass=' class="active"';}
						else
						{$cssclass= '';}
						 echo '<li'.$cssclass.'><a href="'.base_url().'dashboard/manage-attendence/class-'.$class->class.'/" >Class '.$class->name.'</a></li>';
						}
					  
					  ?>
                      </ul>
                    </div>				  
                    </div>

                    <div class="clearfix"></div>

				  
				  
				  
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

	  </body>
	</html>
<?php
}
break;
default:
{
_e(error());
}
}
?>