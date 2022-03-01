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
case 'add-routine':
{
$head = Array(
'title' => 'Add Class Routine',
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
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/view-routine/"><button type="button" class="btn btn-primary btn-xs">View Routine</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$routineadd =false;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=null;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=null;
isset($_POST['teacher']) ? $teacher= numberonly($_POST['teacher']) : $teacher=null;
isset($_POST['subject']) ? $subject= numberonly($_POST['subject']) : $subject=null;
isset($_POST['startingtime']) ? $startingtime= $_POST['startingtime'] : $startingtime='00:00';
isset($_POST['endingtime']) ? $endingtime= $_POST['endingtime'] : $endingtime='00:00';
isset($_POST['day']) ? $day= $_POST['day'] : $day='00:00';



$expstart = explode(':',$startingtime);
$starthour = $expstart[0];
$startminute= $expstart[1];
$expend = explode(':',$endingtime);
$endhour = $expend[0];
$endminute= $expend[1];


if($process==1)
{


$existsroutine = $db->where ('class',$class)->where ('section',$section)->where ('subject',$subject)->where('day',$day)->has ('class_routine');



/** Values **/
if($existsroutine)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Class routine already exists with same subject, same day, same class, same section!';
echo '</div>';
$routineadd = false;
}
else
{

					$routineSQL = Array (
						'class' => $class,
						'section' => $section,
						'subject' => $subject,
						'hourstart' => $starthour,
						'minutestart' => $startminute,
						'hourend' => $endhour,
						'minuteend' => $endminute,
						'day' => $day
					);
$routineQuery = $db->insert ('class_routine', $routineSQL);

if ($routineQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Routine has been added successfully!';
echo '</div>';
$routineadd =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}

}

?>
<div class="ln_solid"></div>
<?php 
if ($routineadd==false)
{
?>
                    <form method="post" class="form-horizontal form-label-left input_mask">

                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="0">Select</option>
					  <?php
					  $postclass = $class;
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($postclass==$class->class){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$class->class.'"'.$selected.'>'.$class->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsectionfromclass">
					   <fieldset disabled>
					   <select name="section" class="form-control">
					   <option value="">Select Class First</option>
					   </select>
					   </fieldset>
					   </div>
					   </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsubjectfromclas">
					   <fieldset disabled>
					   <select name="section" class="form-control">
					   <option value="">Select Class First</option>
					   </select>
					   </fieldset>
					   </div>
					   </div>
                      </div>


					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Day</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="day" class="form-control" required="required">
                        <option value="">Select Day</option>
						<option value="sunday">Sunday</option>
						<option value="monday">Monday</option>
						<option value="tuesday">Tuesday</option>
						<option value="wednesday">Wednesday</option>
						<option value="thursday">Thursday</option>
						<option value="friday">Friday</option>
						<option value="saturday">Saturday</option>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Starting Time
                        <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <input type="time" class="date-picker form-control col-md-7 col-xs-12" name="startingtime">
                        </div>
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Ending Time
                        <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <input type="time" class="date-picker form-control col-md-7 col-xs-12" name="endingtime">
                        </div>
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-12">

                        </div>
                      </div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Add Routine</button>
						   <button class="btn btn-primary" type="reset">Reset Form</button>
                        </div>
                      </div>

                    </form>
					
<?php } ?>
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
case 'view':
{
isset($_GET['class'])?$class=numberonly($_GET['class']):$class=0;
isset($_GET['section'])?$section=numberonly($_GET['section']):$section=0;
$classdata = $db->where('class',$class)->ObjectBuilder()->getOne("class");
$sectiondata = $db->where('id',$section)->ObjectBuilder()->getOne("section");



$existsroutine = $db->where ('class',$class)->where ('section',$section)->has ('class_routine');

if(!$existsroutine)
{
die(error());
}

$title = 'Class Routine Of Class '.$classdata->name. ' Section '.$sectiondata->name ;
$head = Array(
'title' => $title,
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
                <h3>View <small>Routine</small></h3>
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
                    <h2>Routine</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-routine/"><button type="button" class="btn btn-primary btn-xs">Add Routine</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

				 <div class="col-xs-12">
                      <!-- Tab panes -->
                      <div class="tab-content">
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['section'])?$changesection=numberonly($_POST['section']):$changesection=null;
isset($_POST['class'])?$changeclass=numberonly($_POST['class']):$changeclass=null;
if($process==1)
{
ob_clean();
$location = base_url().'dashboard/routine/view/class-'.$changeclass.'/section-'.$changesection.'/';

echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
?>				  
   <form method="post" class="form-horizontal form-label-left input_mask">

                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="0">Select</option>
					  <?php
					  $postclass = $class;
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($postclass==$class->class){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$class->class.'"'.$selected.'>'.$class->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsectionfromclass">
					   <fieldset disabled>
					   <select name="section" class="form-control" required>
					   <option value="">Select Class First</option>
					   </select>
					   </fieldset>
					   </div>
					   </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">View Routine</button>
						   <button class="btn btn-primary" type="reset">Reset Form</button>
                        </div>
                      </div>

                    </form>

                      </div>

                    </div>

                    <div class="clearfix"></div>
					
					<div class="col-xs-12">
					
					<?php
echo '<table class="table table-striped projects">

                      <tbody>';	
					  
					$days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
foreach($days as $day)
{
echo '<tr>';
echo '<td>'.ucfirst($day).'</td>';

$routines = $db->where('day',$day)->where('section',$section)->orderBy('hourstart','Asc')->ObjectBuilder()->get("class_routine");
foreach($routines as $routine)
{
echo '<td>'. getvalue('id',$routine->subject,'subject','name') . '('. $routine->hourstart . ':'.$routine->minutestart.' - '.$routine->hourend.':'.$routine->minuteend.') <a href="'.base_url().'dashboard/routine.php?action=edit&amp;id='.$routine->id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a><a onclick="return confirm(\'Are you sure you want to delete this routine?\');" href="'.base_url().'dashboard/routine.php?action=delete&amp;id='.$routine->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a></td>';
}
echo '</tr>';
}
echo '</tbody></table>';			
					?>
					
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
case 'view-routine':
{
$head = Array(
'title' => 'View Routine',
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
                <h3>View <small>Routine</small></h3>
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
                    <h2>Routine</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-routine/"><button type="button" class="btn btn-primary btn-xs">Add Routine</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

				 <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['section'])?$section=numberonly($_POST['section']):$section=null;
isset($_POST['class'])?$class=numberonly($_POST['class']):$class=null;
if($process==1)
{
ob_clean();
$location = base_url().'dashboard/routine/view/class-'.$class.'/section-'.$section.'/';

echo '<html>
<script language="javascript">
    window.location.href = "'.$location.'"
</script></html>';
exit;
}
?>				  
   <form method="post" class="form-horizontal form-label-left input_mask">

                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="0">Select</option>
					  <?php
					  $postclass = $class;
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($postclass==$class->class){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$class->class.'"'.$selected.'>'.$class->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsectionfromclass">
					   <fieldset disabled>
					   <select name="section" class="form-control" required>
					   <option value="">Select Class First</option>
					   </select>
					   </fieldset>
					   </div>
					   </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">View Routine</button>
                        </div>
                      </div>

                    </form>

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
case 'edit':
{
$head = Array(
'title' => 'Edit Routine',
'page' => 'dashboard'
);
head($head);
?>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>
 

<?php
isset($_GET['id'])?$id= numberonly($_GET['id']):$id=0;
$routinedata = $db->where('id',$id)->ObjectBuilder()->getOne('class_routine');
if(!$db->where ('id',$id)->has ('class_routine'))
{
echo '<div class="right_col" role="main">
<div class="row">
<h1 class="title text-center"> Edit Routine</h1>
<div class="x_content">
<div id="alerts"></div>
<div class="ln_solid"></div>';
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> This content is not found!';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
dashboardfooter();
exit;
}
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/view-routine/"><button type="button" class="btn btn-primary btn-xs">View Routine</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/add-routine/"><button type="button" class="btn btn-primary btn-xs">Add Routine</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<?php
$routineadd =false;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=null;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=null;
isset($_POST['teacher']) ? $teacher= numberonly($_POST['teacher']) : $teacher=null;
isset($_POST['subject']) ? $subject= numberonly($_POST['subject']) : $subject=null;
isset($_POST['startingtime']) ? $startingtime= $_POST['startingtime'] : $startingtime='00:00';
isset($_POST['endingtime']) ? $endingtime= $_POST['endingtime'] : $endingtime='00:00';
isset($_POST['day']) ? $day= $_POST['day'] : $day='00:00';



$expstart = explode(':',$startingtime);
$starthour = $expstart[0];
$startminute= $expstart[1];
$expend = explode(':',$endingtime);
$endhour = $expend[0];
$endminute= $expend[1];


if($process==1)
{




					$routineSQL = Array (
						'class' => $class,
						'section' => $section,
						'subject' => $subject,
						'hourstart' => $starthour,
						'minutestart' => $startminute,
						'hourend' => $endhour,
						'minuteend' => $endminute,
						'day' => $day
					);
$routineQuery = $db->where('id',$id)->update ('class_routine', $routineSQL);

if ($routineQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Routine has been updated successfully!';
echo '</div>';
$routineadd =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}


}


?>
<?php 
if ($routineadd==false)
{
?>
                   <form method="post" class="form-horizontal form-label-left input_mask">

                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="">Select</option>
					  <?php
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($routinedata->class==$class->class){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$class->class.'"'.$selected.'>'.$class->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsectionfromclass">
					   <select name="section" class="form-control">
					   <option value="">Select Class First</option>
						  <?php
					  $sections = $db->where("class",$routinedata->class)->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
					if ($routinedata->section==$section->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.'</option>';
						}
					  ?>
					   </select>
					   </div>
					   </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsubjectfromclas">
					   <select name="subject" class="form-control">
					   <option value="">Select Class First</option>
					   	<?php
					  $subjects = $db->where("class",$routinedata->class)->ObjectBuilder()->get ("subject");
					if ($db->count > 0)
						foreach ($subjects as $subject) { 
					if ($routinedata->subject==$subject->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$subject->id.'"'.$selected.'>'.$subject->name.'</option>';
						}
					  ?>
					   </select>
					   </div>
					   </div>
                      </div>


					    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Day</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="day" class="form-control" required="required">
						<?php
					  if($routinedata->day=='sunday'){$sunselect=' selected';}else{$sunselect='';}
					  if($routinedata->day=='monday'){$monselect=' selected';}else{$monselect='';}
					  if($routinedata->day=='tuesday'){$tueselect=' selected';}else{$tueselect='';}
					  if($routinedata->day=='wednesday'){$wedselect=' selected';}else{$wedselect='';}
					  if($routinedata->day=='thursday'){$thuselect=' selected';}else{$thuselect='';}
					  if($routinedata->day=='friday'){$friselect=' selected';}else{$friselect='';}
					  if($routinedata->day=='saturday'){$satselect=' selected';}else{$satselect='';}
					   ?>
                        <option value="">Select Day</option>
						<option value="sunday"<?php _e($sunselect)?>>Sunday</option>
						<option value="monday"<?php _e($monselect)?>>Monday</option>
						<option value="tuesday"<?php _e($tueselect)?>>Tuesday</option>
						<option value="wednesday"<?php _e($wedselect)?>>Wednesday</option>
						<option value="thursday"<?php _e($thuselect)?>>Thursday</option>
						<option value="friday"<?php _e($friselect)?>>Friday</option>
						<option value="saturday"<?php _e($satselect)?>>Saturday</option>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Starting Time
                        <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <input type="time" class="date-picker form-control col-md-7 col-xs-12" name="startingtime" value="<?php _e($routinedata->hourstart.':'.$routinedata->minutestart)?>">
                        </div>
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Ending Time
                        <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <input type="time" class="date-picker form-control col-md-7 col-xs-12" name="endingtime" value="<?php _e($routinedata->hourend.':'.$routinedata->minuteend)?>">
                        </div>
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-12">

                        </div>
                      </div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Edit Routine</button>
                        </div>
                      </div>

                    </form>
					

					
<?php } ?>

					</div>	
					</div>	
					</div>	
<?php dashboardfooter(); ?>
      </div>

  </body>
</html>
<?php

}
break;
case 'delete':
{
	
isset($_GET['id'])?$id= numberonly($_GET['id']):$id=0;
$existsroutine = $db->where ('id',$id)->has ('class_routine');

if(!$existsroutine)
{
die(error());
}
$head = Array(
'title' => 'Delete Routine',
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
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-student/"><button type="button" class="btn btn-primary btn-xs">Manage Student</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php


if($db->where('id', $id)->delete('class_routine'))
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Routine has been deleted successfully!';
echo '</div>';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

?>
					</div>	
					</div>	
					</div>	
<?php dashboardfooter(); ?>
      </div>
      </div>
  </body>
</html>
<?php

}
default:
{
_e(error());
}
}
?>