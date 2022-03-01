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
case 'add-subject':
{
$head = Array(
'title' => 'Add Subject',
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-subject/"><button type="button" class="btn btn-primary btn-xs">Add Subject</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-subject/"><button type="button" class="btn btn-primary btn-xs">Manage Subject</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
switch($process)
{
case 1:
{
/** Values **/
isset($_POST['name']) ? $name= $_POST['name'] : $name=null;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=0;
isset($_POST['teacher']) ? $teacher= numberonly($_POST['teacher']) : $teacher=0;
$exists = $db->where ('name',$name)->where ('class',$class)->has ('subject');
/** Values **/
if (strlen($name)<1)
{
echo '<div class="alert alert-danger text-center">';
echo 'Please type a valid subject name!';
echo '</div>';
}
else if ($class<1)
{
echo '<div class="alert alert-danger text-center">';
echo 'Please select valid class!';
echo '</div>';
}
else if ($exists)
{
echo '<div class="alert alert-danger text-center">';
echo 'A section already exists with same name with same class!';
echo '</div>';
}
else
{

$data = Array (
    'name' => $name,
    'teacher' => $teacher,
    'class' => $class
);
$query = $db->insert ('subject', $data);
if ($query)
{
/**
 @* Log 
**/
$title = 'Subject';
$log = '<b>'.user::inses()->name . '</b> added a new subject <b>'.$name.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Subject has been added successfully!';
echo '</div>';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}

}
break;
default:
{
?>
                <div class="x_content">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<form method="post" enctype="multipart/form-data" >
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="text" name="name" class="form-control" placeholder="English" autocomplete="off">
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Class</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
					
                      <select name="class" class="form-control">
					  <option value="0">Select Class</option>
					  <?php
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
						 echo '<option value="'.$class->class.'">'.$class->name.'</option>';
						}
					  ?>
					  </select>
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Teacher</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
					
                      <select name="teacher" class="form-control">
					  <option value="0">Select Subject Teacher</option>
					  <?php
					  $teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($teachers as $teacher) { 
						 echo '<option value="'.$teacher->id.'">'.$teacher->name.'</option>';
						}
					  ?>
					  </select>
                    </div>
                  </div>
                  </div>
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Add Subject</button>
				  </form>
					</div>	
<?php
}

}	// Case End
?>
				
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
case 'manage-subject':
{
$head = Array(
'title' => 'Manage Subject',
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
                <h3>Manage <small>Subject</small></h3>
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
                    <h2>Subjects</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-subject/"><button type="button" class="btn btn-primary btn-xs">Add Subject</button></a></li>
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
						$classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) {
						if($class->id==1)
						{$cssclass='class="tab-pane active"';}
						else
						{$cssclass= 'class="tab-pane"';}
						 echo '<div '.$cssclass.' id="'.$class->name.'">';
						 echo '<h1 class="text-center">Class '.$class->name.'</h1>';
						 
echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Subject Name</th>
                          <th style="width: 20%">Teacher</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>';					 
$subjects = $db->where('class',$class->class)->ObjectBuilder()->get("subject");
foreach($subjects as $subject)
{
echo '<tr>';
echo '<td>#</td>';
echo '<td>'.$subject->name.'</td>';
echo '<td>'.getvalue('id',$subject->teacher,'users','name').'</td>';
echo '<td><a href="'.base_url().'dashboard/subject.php?action=edit&amp;id='.$subject->id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm(\'Are you sure you want to delete '.$subject->name.'?\');" href="'.base_url().'dashboard/subject.php?action=delete&amp;id='.$subject->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>';
echo '</tr>';
}
echo ' 
                      </tbody>
                    </table>';
echo '</div>';
						}
						?>

                      </div>
                    </div>

                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-right">
					  <?php
					  
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
						if($class->id==1)
						{$cssclass=' class="active"';}
						else
						{$cssclass= '';}
						 echo '<li'.$cssclass.'><a href="#'.$class->name.'" data-toggle="tab">Class '.$class->name.'</a></li>';
						}
					  
					  ?>
                      </ul>
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
'title' => 'Edit Subject',
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
if(!$db->where ('id',$id)->has ('subject'))
{
echo '<div class="right_col" role="main">
<div class="row">
<h1 class="title text-center"> Edit Notice</h1>
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-subject/"><button type="button" class="btn btn-primary btn-xs">Add Subject</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-subject/"><button type="button" class="btn btn-primary btn-xs">Manage Subject</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
$result = $db->where ('id', $id)->ObjectBuilder()->getOne("subject");
switch($process)
{
case 1:
{
/** Values **/
isset($_POST['name']) ? $name= $_POST['name'] : $name=null;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=null;
isset($_POST['teacher']) ? $teacher= numberonly($_POST['teacher']) : $teacher=null;
isset($_GET['id']) ? $id= numberonly($_GET['id']) : $id=null;
$exists = $db->where ('id',$id)->has ('subject');
/** Values **/
if (strlen($name)<1)
{
echo '<div class="alert alert-danger text-center">';
echo 'Please type a valid class name!';
echo '</div>';
}
else if ($class<1)
{
echo '<div class="alert alert-danger text-center">';
echo 'Please select valid class!';
echo '</div>';
}
else if (!$exists)
{
echo '<div class="alert alert-danger text-center">';
echo 'Requested class is not found!';
echo '</div>';
}
else
{

$data = Array (
    'name' => $name,
    'teacher' => $teacher,
    'class' => $class
);
$query = $db->where('id',$id)->update ('subject', $data);
if ($query)
{
/**
 @* Log 
**/
$title = 'Subject';
$log = '<b>'.user::inses()->name . '</b> edit a subject <b>'.$result->name.'</b> to <b>'.$name.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Subject has been updated successfully!';
echo '</div>';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}
}
break;
default:
{

?>
<form method="post" enctype="multipart/form-data" >
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Name</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="text" name="name" class="form-control" placeholder="A" value="<?php _e($result->name) ?>" autocomplete="off">
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Class</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
					
                      <select name="class" class="form-control">
					  <option value="0">Select Class</option>
					  <?php
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($class->class==$result->class)
					{$selected=' selected';}
					else
					{$selected='';}
						 echo '<option value="'.$class->class.'"'.$selected.'>'.$class->name.'</option>';
						}
					  ?>
					  </select>
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Teacher</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
					
                      <select name="teacher" class="form-control">
					  <option value="0">Select Subject Teacher</option>
					  <?php
					  $teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($teachers as $teacher) { 
					if ($teacher->id==$result->teacher)
					{$selected=' selected';}
					else
					{$selected='';}
						 echo '<option value="'.$teacher->id.'"'.$selected.'>'.$teacher->name.'</option>';
						}
					  ?>
					  </select>
                    </div>
                  </div>
                  </div>
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Edit Subject</button>
				  </form>
<?php }
} ?>					

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
$head = Array(
'title' => 'Delete Subject',
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

$result = $db->where ('id', $id)->ObjectBuilder()->getOne("subject");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-subject/"><button type="button" class="btn btn-primary btn-xs">Add Subject</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-subject/"><button type="button" class="btn btn-primary btn-xs">Manage Subject</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php
if($db->where('id', $id)->delete('subject'))
{
/**
 @* Log 
**/
$title = 'Subject';
$log = '<b>'.user::inses()->name . '</b> delete a subject <b>'.$result->name.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Section has been deleted successfully!';
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