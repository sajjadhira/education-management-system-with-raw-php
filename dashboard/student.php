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
case 'admit-student':
{
$head = Array(
'title' => 'Admit Student',
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
					<li><a href="<?php echo base_url(); ?>dashboard/manage-student/"><button type="button" class="btn btn-primary btn-xs">Manage Student</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$registration =false;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
/** Values **/
isset($_POST['name']) ? $name= $_POST['name'] : $name=null;
isset($_POST['username']) ? $username= validtext($_POST['username']) : $username=null;
isset($_POST['email']) ? $email= $_POST['email'] : $email=null;
isset($_POST['password']) ? $password= $_POST['password'] : $password=null;
isset($_POST['parent']) ? $parent= numberonly($_POST['parent']) : $parent=0;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=0;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=0;
isset($_POST['classroll']) ? $classroll= numberonly($_POST['classroll']) : $classroll=0;
isset($_POST['guideteacher']) ? $guideteacher= numberonly($_POST['guideteacher']) : $guideteacher=0;
isset($_POST['dob']) ? $dob= $_POST['dob'] : $dob=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
if($process==1)
{

$existsroll = $db->where ('classroll',$classroll)->where ('class',$class)->has ('student');

/** Values **/
if (strlen($name)<3)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student name!';
echo '</div>';
$registration =false;
}
else if (strlen($username)<3||strlen($username)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select valid username!<br/>Username must be 3-8 characters';
echo '</div>';
$registration =false;
}
else if (user::has($username))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> username already exists, please choose different one!';
echo '</div>';
$registration =false;
}
else if (invalidemail($email))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid email address!';
echo '</div>';
$registration =false;
}
else if (user::has($email))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> This email is associate with another account!';
echo '</div>';
$registration = false;
}
else if (empty($password))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type your password!';
echo '</div>';
$registration = false;
}
else if (strlen($password)<6||strlen($password)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Password should 6-10 characters!';
echo '</div>';
$registration = false;
}
else if ($parent<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student parent!';
echo '</div>';
$registration = false;
}
else if ($class<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student class!';
echo '</div>';
$registration = false;
}
else if ($classroll<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student class rool!';
echo '</div>';
$registration = false;
}
else if ($existsroll)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Class role already exists!';
echo '</div>';
$registration = false;
}
else if (strlen($dob)<10||strlen($dob)>10)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student date of birth!';
echo '</div>';
$registration = false;
}
else if (strlen($gender)<4)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student gender';
echo '</div>';
$registration = false;
}
else if (strlen($address)<0)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student address';
echo '</div>';
$registration = false;
}
else if (strlen($phonenumber)<8||strlen($phonenumber)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type valid phone number';
echo '</div>';
$registration = false;
}
else
{

if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$beforedir = '../';
$dir = "images/student";
$ext = explode(".", $origname);
$extension = end($ext);
$validname = validtext($ext[0]);
$fileready = $validname.'.'.$extension;
if (!is_dir($beforedir.$dir))
{
 mkdir($beforedir.$dir, 0755);
}
if (file_exists($beforedir.$dir.'/'.$fileready))
{
$uploadfile = strtolower($validname.'_'.uniqid().'.'.$extension);
}
else
{
$uplaodfile = strtolower($validname.'.'.$extension);
}

$uploader = new ImageUploader($_FILES['file'],$beforedir.$dir.'/',$uplaodfile,250,250);
$uploader->upload();
$ok = $uploader->getInfo();
if(!empty($ok))
{
$avatar = $dir . '/' . $uplaodfile;
$info= $uploader->getInfo();
}
else
{
$avatar = '';
$info= $uploader->getError();
}

}
else
{
$avatar = '';
}

$pass_encrept_options = [
					'cost' => 11,
					'salt' => random_bytes(22),
					];
					$userSQL = Array (
						'name' => $name,
						'username' => $username,
						'password' => password_hash($password,PASSWORD_BCRYPT),
						'email' => $email,
						'gender' => $gender,
						'avatar' => $avatar,
						'birthday' => $dob,
						'phonenumber' => $phonenumber,
						'address1' => $address,
						'registered' => $db->now()
					);
$userQuery = $db->insert ('users', $userSQL);
$userinfo = user::info($username);
$studentSQL = Array (
						'uid' => $userinfo->id,
						'class' => $class,
						'classroll' => $classroll,
						'section' => $section,
						'parent' => $parent,
						'session' => settings('session'),
						'guideteacher' => $guideteacher
					);
$studentQuery = $db->insert ('student', $studentSQL);
if ($userQuery&&$studentQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Student has been admited successfully!';
echo '</div>';

$registration =true;
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
if ($registration==false)
{
?>
                    <form enctype="multipart/form-data" method="post" class="form-horizontal form-label-left input_mask">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" id="name" name="name" class="form-control has-feedback-left" placeholder="Student Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($name) ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						<div class="text-danger" id="name_error"></div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Student Username" required="required" value="<?php _e($username) ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
						<div class="text-danger" id="username_error"></div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="email" name="email" id="email" class="form-control has-feedback-left" placeholder="Student Email" required="required" value="<?php _e($email) ?>">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
						<div class="text-danger" id="email_error"></div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Student Password" required="required" value="<?php _e($password) ?>">
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
						<div class="text-danger" id="password_error"></div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="parent" class="form-control" required="required">
                          					  <option value="">Select</option>
					  <?php
					  $postparent = $parent;
					  $parents = $db->where('privilege',getvalue('title','parent','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($parents as $parent) { 
						if ($postparent==$parent->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$parent->id.'"'.$selected.'>'.$parent->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="">Select</option>
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
						<div class="text-danger" id="studentclass_error"></div>
                        </div>
                      </div>
                      <div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Section</label>
					  <div class="col-md-9 col-sm-9 col-xs-12">
                       <div id="getsectionfromclass">
					   <fieldset disabled>
					   <select name="section" id="sectionselect" class="form-control">
					   <option value="">Select Class First</option>
					   <?php
					  if($postclass>0)
					  {
					  $postsection = $section;
					  $sections = $db->where('class',$postclass)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
					if ($postsection==$section->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.'</option>';
						}
					  }
					  ?>
					   </select>
					   </fieldset>
					   </div>
					   <div class="text-danger" id="section_error"></div>
					   </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class Roll
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="classroll" class="form-control col-md-7 col-xs-12" type="number" placeholder="Numeric Roll" id="classroll" required="required" value="<?php _e($classroll) ?>">
                        </div>
						<div class="text-danger" id="classroll_error"></div>
                      </div>
					     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Guide Teacher</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="guideteacher" class="form-control" required="required">
                        <option value="0">Select Teacher</option>
					  <?php
					  $teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy("id","Desc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($teachers as $teacher) { 
						if ($guideteacher==$teacher->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$teacher->id.'"'.$selected.'>'.$teacher->name.'</option>';
						}
					  ?>
					  </select>
						<div class="text-danger" id="guideteacher_error"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="dob" id="date" class="date-picker form-control col-md-7 col-xs-12" type="date" required="required" value="<?php _e($dob) ?>">
						<div class="text-danger" id="date_error"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="gender" id="gender" class="form-control col-md-7 col-xs-12" required="required">
						  <?php
						  if($gender=='Male'){$selecmale=' selected';}else{$selecmale='';}
						  if($gender=='Female'){$selecfemale=' selected';}else{$selecfemale='';}
						  ?>
						  <option value="">Select</option>
						  <option value="Male"<?php _e($selecmale) ?>>Male</option>
						  <option value="Female"<?php _e($selecfemale) ?>>Female</option>
						  </select>
						  <div class="text-danger" id="gender_error"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="address" id="address" class="form-control col-md-7 col-xs-12" type="text" placeholder="Student Address" required="required" value="<?php _e($address) ?>">
						  <div class="text-danger" id="address_error"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="phonenumber" class="form-control col-md-7 col-xs-12" type="text" id="phonenumber" required="required" value="<?php _e($phonenumber); ?>">
						  <div class="text-danger" id="phonenumber_error"></div>
                        </div>
                      </div>
					  						
					<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo
                    <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
					<label class="btn btn-block btn-primary">
					<i class="fa fa-image"></i> Student Photo...<input type="file"  name="file" style="display: none;"> <span id="attached"></span>
            </label>
        </div>
        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" id="AdmissionFrom" class="btn btn-success">Add Student</button>
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
case 'manage-student':
{
$head = Array(
'title' => 'Manage Student',
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
                <h3>Manage <small>Students</small></h3>
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
                    <h2>Students</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
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

						 echo '<div class="tab-pane active" id="'.$class->name.'">';
						 echo '<h1 class="text-center">Class '.$class->name.'</h1>';

echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 10%">Class Roll</th>
                          <th style="width: 20%">Student Name</th>
                          <th style="width: 50%">Action</th>
                        </tr>
                      </thead>
                      <tbody>';		
isset($_GET['page'])?$page=numberonly($_GET['page']):$page=1;
if($page<1)$page=1;
$db->pageLimit = 20;
$students = $db->where('class',$class->class)->orderBy('classroll','Asc')->ObjectBuilder()->paginate("student",$page);
$Pages = $db->totalPages;
if($page>$Pages)$page=$Pages;
foreach($students as $student)
{
echo '<tr>';
echo '<td>#</td>';
echo '<td>'.$student->classroll.'</td>';
echo '<td>'.getvalue('id',$student->uid,'users','name').'</td>';
echo '<td><a target="_blank" href="'.base_url().'student/'.getvalue('id',$student->uid,'users','username').'/" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> Profile </a> <a target="_blank" href="'.base_url().'dashboard/attendence/individual/'.$student->uid.'/report/'.strtotime(date('Y-m-d')).'/" class="btn btn-success btn-xs"><i class="fa fa-bar-chart"></i> Attendence </a> <a target="_blank" href="'.base_url().'dashboard/result.php?action=indivitual&amp;id='.$student->id.'" class="btn btn-primary btn-xs"><i class="fa fa-area-chart"></i> Mark Sheet </a> <a href="'.base_url().'dashboard/student.php?action=edit&amp;id='.$student->id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm(\'Are you sure you want to delete '.getvalue('id',$student->uid,'users','name').'?\');" href="'.base_url().'dashboard/student.php?action=delete&amp;id='.$student->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>';
echo '</tr>';
}
echo ' 
                      </tbody>
                    </table>';
echo '</div>';
						
						?>

                      </div>
<?php if($Pages>1){	?>
<div class="row">
<ul class="pagination">
<?php
$i=1;
for($i>1;$i<=$Pages;$i++)
{
if ($page==$i){$active = ' class="active"';}else{$active='';}
?>
  <li <?php _e($active) ?>><a href="<?php echo base_url(); ?>dashboard/manage-student/class-<?php _e($getclass) ?>/page-<?php _e($i) ?>/"><?php _e($i) ?></a></li>
 <?php
}
 ?>
</ul>
</div>
<?php } ?>
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
						 echo '<li'.$cssclass.'><a href="'.base_url().'dashboard/manage-student/class-'.$class->class.'/" >Class '.$class->name.'</a></li>';
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
'title' => 'Edit Student',
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
if(!$db->where ('id',$id)->has ('student'))
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
$studentdata = $db->where ('id', $id)->ObjectBuilder()->getOne("student");
$userdata = $db->where ('id', $studentdata->uid)->ObjectBuilder()->getOne("users");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
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
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<?php
$registration =false;
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
/** Values **/
isset($_POST['name']) ? $name= $_POST['name'] : $name=null;
isset($_POST['password']) ? $password= $_POST['password'] : $password=null;
isset($_POST['parent']) ? $parent= numberonly($_POST['parent']) : $parent=0;
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=0;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=0;
isset($_POST['classroll']) ? $classroll= numberonly($_POST['classroll']) : $classroll=0;
isset($_POST['guideteacher']) ? $guideteacher= numberonly($_POST['guideteacher']) : $guideteacher=0;
isset($_POST['studentid']) ? $studentid= numberonly($_POST['studentid']) : $studentid=0;
isset($_POST['dob']) ? $dob= $_POST['dob'] : $dob=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
isset($_POST['uplaodfile']) ? $uplaodfile= $_POST['uplaodfile'] : $uplaodfile=null;
if($process==1)
{

$existsroll = $db->where ('classroll',$classroll)->where('uid',$studentdata->uid,'!=')->where ('class',$class)->has ('student');

/** Values **/
if (strlen($name)<3)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student name!';
echo '</div>';
$registration =false;
}
else if (!empty($_POST['password'])&&(strlen($password)<6||strlen($password)>10))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Password should 6-10 characters!';
echo '</div>';
$registration = false;
}
else if ($parent<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student parent!';
echo '</div>';
$registration = false;
}
else if ($class<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student class!';
echo '</div>';
$registration = false;
}
else if ($classroll<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student class rool!';
echo '</div>';
$registration = false;
}
else if ($existsroll)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Class role already exists!';
echo '</div>';
$registration = false;
}
else if (strlen($dob)<10||strlen($dob)>10)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student date of birth!';
echo '</div>';
$registration = false;
}
else if (strlen($gender)<4)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student gender';
echo '</div>';
$registration = false;
}
else if (strlen($address)<0)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student address';
echo '</div>';
$registration = false;
}
else if (strlen($phonenumber)<10||strlen($phonenumber)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type valid phone number';
echo '</div>';
$registration = false;
}
else
{
$pass_encrept_options = [
					'cost' => 11,
					'salt' => random_bytes(22),
					];
if (isset($_POST['password']))
{
$newpassword = password_hash($password,PASSWORD_BCRYPT);
}
else
{
$newpassword = $studentdata->password;
}

if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$beforedir = '../';
$dir = "images/student";
$ext = explode(".", $origname);
$extension = end($ext);
$validname = validtext($ext[0]);
$fileready = $validname.'.'.$extension;
if (!is_dir($beforedir.$dir))
{
 mkdir($beforedir.$dir, 0755);
}
if (file_exists($beforedir.$dir.'/'.$fileready))
{
$uploadfile = strtolower($validname.'_'.uniqid().'.'.$extension);
}
else
{
$uplaodfile = strtolower($validname.'.'.$extension);
}

$uploader = new ImageUploader($_FILES['file'],$beforedir.$dir.'/',$uplaodfile,250,250);
$uploader->upload();
$ok = $uploader->getInfo();
if(!empty($ok))
{
$existfile = '..'.$userdata->avatar;
if (isset($userdata->avatar)&&file_exists($existfile))
{
unlink($existfile);
}

$avatar = '/'.$dir . '/' . $uplaodfile;
$info= $uploader->getInfo();
}
else
{
$avatar = $userdata->avatar;
$info= $uploader->getError();
}

}
else
{
$avatar = $userdata->avatar;
}
					$userSQL = Array (
						'name' => $name,
						'password' => $newpassword,
						'gender' => $gender,
						'birthday' => $dob,
						'avatar' => $avatar,
						'phonenumber' => $phonenumber,
						'address1' => $address
					);
$userQuery = $db->where('id',$studentdata->uid)->update ('users', $userSQL);
$studentSQL = Array (
						'class' => $class,
						'classroll' => $classroll,
						'section' => $section,
						'parent' => $parent,
						'guideteacher' => $guideteacher
					);
$studentQuery = $db->where('uid',$studentdata->uid)->update ('student', $studentSQL);
if ($userQuery&&$studentQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Student information has been updated successfully!';
echo '</div>';
$registration =true;
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
<?php 
if ($registration==false)
{
?>
                    <form enctype="multipart/form-data" method="post" class="form-horizontal form-label-left input_mask">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" id="name" name="name" class="form-control" placeholder="Student Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($userdata->name) ?>">
						</div>
						</div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="password" name="password" class="form-control" placeholder="Student Password">
						</div>
						</div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="parent" class="form-control" required="required">
                         <option value="0">Select</option>
					  <?php
					  
					  $parents = $db->where('privilege',getvalue('title','parent','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($parents as $parent) { 
						if ($studentdata->parent==$parent->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$parent->id.'"'.$selected.'>'.$parent->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="class" id="studentclass" class="form-control">
                        <option value="0">Select</option>
					  <?php
					  
					  $classes = $db->orderBy("class","Asc")->ObjectBuilder()->get ("class");
					if ($db->count > 0)
						foreach ($classes as $class) { 
					if ($studentdata->class==$class->class){$selected=' selected';}else{$selected='';}
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
					   <select name="section" id="studentclass" class="form-control">
                        <option value="0">--Select Section--</option>
					  <?php
					  
					  $sections = $db->where('class',$studentdata->class)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
					if ($studentdata->section==$section->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.' '.$section->title.'</option>';
						}
					  ?>
					  </select>
					   </div>
					   </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class Roll
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="classroll" class="form-control col-md-7 col-xs-12" type="number" placeholder="Numeric Roll" required="required" value="<?php _e($studentdata->classroll) ?>">
                        </div>
                      </div>
					                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Guide Teacher</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="guideteacher" class="form-control" required="required">
                        <option value="0">Select Teacher</option>
					  <?php
					  $teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy("id","Desc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($teachers as $teacher) { 
						if ($studentdata->guideteacher==$teacher->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$teacher->id.'"'.$selected.'>'.$teacher->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="dob" class="date-picker form-control col-md-7 col-xs-12" type="date" required="required" value="<?php _e($userdata->birthday) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="gender" class="form-control col-md-7 col-xs-12" required="required">
						  <?php
						  if($userdata->gender=='Male'){$selecmale=' selected';}else{$selecmale='';}
						  if($userdata->gender=='Female'){$selecfemale=' selected';}else{$selecfemale='';}
						  ?>
						  <option value="">Select</option>
						  <option value="Male"<?php _e($selecmale) ?>>Male</option>
						  <option value="Female"<?php _e($selecfemale) ?>>Female</option>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="address" class="form-control col-md-7 col-xs-12" type="text" placeholder="Student Address" required="required" value="<?php _e($userdata->address1) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="phonenumber" class="form-control col-md-7 col-xs-12" type="text" required="required" value="<?php _e($userdata->phonenumber) ?>">
                        </div>
                      </div>

          <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo
                    <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
            <?php

            if (!empty($userdata->avatar) && file_exists('..'.$userdata->avatar))
            {
            ?>
            <img src="<?php _e('..'.$userdata->avatar) ?>" alt="<?php _e($userdata->name) ?>">
            <?php
            }
            ?>
          <label class="btn btn-block btn-primary">
          <i class="fa fa-image"></i> Change Photo...<input type="file"  name="file" style="display: none;"> <span id="attached"></span>
            </label>
        </div>
        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="studentid" value="<?php _e($studentdata->uid) ?>">
                          <button type="submit" class="btn btn-success">Edit Student</button>
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
$head = Array(
'title' => 'Delete Student',
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
          <div class="row">
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
$studentdata = $db->where ('id', $id)->ObjectBuilder()->getOne("student");
$userdata = $db->where ('id', $studentdata->uid)->ObjectBuilder()->getOne("users");

if($db->where('id', $id)->delete('student')&&$db->where('id', $studentdata->uid)->delete('users'))
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Student '.$userdata->name.' has been deleted successfully!';
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