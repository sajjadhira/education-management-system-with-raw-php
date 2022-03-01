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
case 'add-class':
{
$head = Array(
'title' => 'Add Class',
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-class/"><button type="button" class="btn btn-primary btn-xs">Add Class</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-class/"><button type="button" class="btn btn-primary btn-xs">Manage Class</button></a></li>
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
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=null;
$exists = $db->where ('name',$name)->orWhere ('class',$class)->has ('class');
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
echo 'Please add valid class!';
echo '</div>';
}
else if ($exists)
{
echo '<div class="alert alert-danger text-center">';
echo 'A class already exists with same name!';
echo '</div>';
}
else
{

$data = Array (
    'name' => $name,
    'class' => $class
);
$query = $db->insert ('class', $data);
if ($query)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Class has been added successfully!';
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
                      <input type="text" name="name" class="form-control" placeholder="One" autocomplete="off">
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Numeric Name</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="number" name="class" class="form-control" placeholder="1" autocomplete="off">
                    </div>
                  </div>
                  </div>
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Add Class</button>
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
case 'manage-class':
{
$head = Array(
'title' => 'Manage Class',
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
                <h3>Manage <small>Classes</small></h3>
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
                    <h2>Classes</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-class/"><button type="button" class="btn btn-primary btn-xs">Add Class</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Class Name</th>
                          <th style="width: 20%">Class Numeric Name</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
isset($_GET['page'])?$page=numberonly($_GET['page']):$page=1;
if($page<1)$page=1;
$db->pageLimit = 20;
$classes = $db->orderBy("class","Asc")->arraybuilder()->paginate("class", $page);
foreach($classes as $class)
{
?>
                        <tr>
                          <td>#</td>
                          <td><?php _e($class['name']) ?></td>
                          <td><?php _e($class['class']) ?></td>
                          <td>
                            <a href="<?php echo base_url(); ?>dashboard/class.php?action=edit&amp;id=<?php _e($class['id']) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm('Are you sure you want to delete this class?');" href="/dashboard/class.php?action=delete&amp;id=<?php _e($class['id']) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
<?php 
}
?>
 
                      </tbody>
                    </table>


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
'title' => 'Edit Class',
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
if(!$db->where ('id',$id)->has ('class'))
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-class/"><button type="button" class="btn btn-primary btn-xs">Add Class</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-class/"><button type="button" class="btn btn-primary btn-xs">Manage Class</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
switch($process)
{
case 1:
{
/** Values **/
isset($_POST['name']) ? $name= $_POST['name'] : $name=null;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=null;
isset($_POST['id']) ? $requestedid= numberonly($_POST['id']) : $requestedid=null;
isset($_GET['id']) ? $id= numberonly($_GET['id']) : $id=null;
$exists = $db->where ('name',$name)->orWhere ('class',$class)->has ('class');
$namehas= $db->where ('name',$name)->has ('class');
$classhas= $db->where ('class',$class)->has ('class');
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
echo 'Please add valid class!';
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
    'class' => $class
);
$query = $db->where('id',$id)->update ('class', $data);
if ($query)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Class has been updated successfully!';
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
$result = $db->where ('id', $id)->ObjectBuilder()->getOne("class");
?>
<form method="post" enctype="multipart/form-data" >
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Class Name</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="text" name="name" class="form-control" value="<?php _e($result->name) ?>" placeholder="Class Name">
                    </div>
                  </div>
                  </div>
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Class Numeric Name</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="number" name="class" class="form-control" value="<?php _e($result->class) ?>" placeholder="Class Name">
                    </div>
                  </div>
                  </div>
				  <input type="hidden" name="id" value="<?php _e($result->id) ?>">
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Edit Class</button>
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
'title' => 'Delete Class',
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


?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="/dashboard/add-class/"><button type="button" class="btn btn-primary btn-xs">Add Class</button></a></li>
					<li><a href="/dashboard/manage-class/"><button type="button" class="btn btn-primary btn-xs">Manage Class</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php
if($db->where('id', $id)->delete('class'))
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Class has been deleted successfully!';
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