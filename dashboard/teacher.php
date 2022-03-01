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
case 'add-teacher':
{
$head = Array(
'title' => 'Add Teacher',
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
					<li><a href="<?php echo base_url(); ?>dashboard/manage-teacher/"><button type="button" class="btn btn-primary btn-xs">Manage Teacher</button></a></li>
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
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=0;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=0;
isset($_POST['dob']) ? $dob= $_POST['dob'] : $dob=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['subject']) ? $subject= $_POST['subject'] : $subject=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
if($process==1)
{

// $existsroll = $db->where ('subject',$subject)->has ('student');

/** Values **/
if (strlen($name)<3)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student name!';
echo '</div>';
$registration =false;
}
else if (strlen($username)<3||strlen($username)>8)
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
else if (strlen($password)<6||strlen($password)>10)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Password should 6-10 characters!';
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

if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$beforedir = '../';
$dir = "images/teacher";
$ext = explode(".", $origname);
$extension = end($ext);
$validname = validtext($ext[0]);
$fileready = $validname.'.'.$extension;

if (!is_dir($beforedir.$dir)){
 mkdir($beforedir.$dir, 0755);
}

if (file_exists($beforedir.$dir.'/'.$fileready)){
$uploadfile = strtolower($validname.'_'.uniqid().'.'.$extension);
}else{
$uplaodfile = strtolower($validname.'.'.$extension);
}

$uploader = new ImageUploader($_FILES['file'],$beforedir.$dir.'/',$uplaodfile,250,250);
$uploader->upload();
$ok = $uploader->getInfo();


if(!empty($ok)){
$avatar = '/'.$dir . '/' . $uplaodfile;
$info= $uploader->getInfo();
}else{
$avatar = '';
$info= $uploader->getError();
}

}else{
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
						'privilege' =>	getvalue('title','teacher','users_role','role'),
						'gender' => $gender,
						'birthday' => $dob,
            'avatar' => $avatar,
						'phonenumber' => $phonenumber,
						'address1' => $address,
						'registered' => $db->now()
					);
$userQuery = $db->insert ('users', $userSQL);
$userinfo = user::info($username);
$subjectSQL = Array (
						'teacher' => $userinfo->id
					);
$studentQuery = $db->where('class',$class)->update ('subject', $subjectSQL);
$sectionSQL = Array (
						'teacher' => $userinfo->id
					);
$sectionQuery = $db->where('class',$class)->where('id',$section)->update ('section', $sectionSQL);
if ($userQuery&&$studentQuery&&$sectionQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Teacher has been added successfully!';
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
                        <input type="text" id="name" name="name" class="form-control has-feedback-left" placeholder="Teacher Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($name) ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Teacher Username" required="required" value="<?php _e($username) ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="email" name="email" class="form-control has-feedback-left" placeholder="Teacher Email" required="required" value="<?php _e($email) ?>">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Teacher Password" required="required" value="<?php _e($password) ?>">
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="subject" class="form-control">
                        <option value="0">Select Subject</option>
					  <?php
					  $postclass = $class;
					  $subjects = $db->orderBy("class","Asc")->ObjectBuilder()->get ("subject");
					if ($db->count > 0)
						foreach ($subjects as $subject) { 
					$selected='';
						 echo '<option value="'.$subject->id.'"'.$selected.'>Class '.getvalue('class',$subject->class,'class','name').' '.$subject->name.'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Class Teacher</label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="dob" class="date-picker form-control col-md-7 col-xs-12" type="date" required="required" value="<?php _e($dob) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="gender" class="form-control col-md-7 col-xs-12" required="required">
						  <?php
						  if($gender=='Male'){$selecmale=' selected';}else{$selecmale='';}
						  if($gender=='Female'){$selecfemale=' selected';}else{$selecfemale='';}
						  ?>
						  <option value="">Select</option>
						  <option value="Male"<?php _e($selecmale) ?>>Male</option>
						  <option value="Female"<?php _e($selecfemale) ?>>Female</option>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="address" class="form-control col-md-7 col-xs-12" type="text" placeholder="Teacher Address" required="required" value="<?php _e($address) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="phonenumber" class="form-control col-md-7 col-xs-12" type="text" value="+880" required="required" value="<?php _e($phone) ?>">
                        </div>
                      </div>
          
          <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo
                    <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
          <label class="btn btn-block btn-primary">
          <i class="fa fa-image"></i> Teacher Photo...<input type="file"  name="file" style="display: none;"> <span id="attached"></span>
            </label>
        </div>
        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Add Teacher</button>
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
case 'manage-teacher':
{
$head = Array(
'title' => 'Manage Teacher',
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
                <h3>Manage <small>Teachers</small></h3>
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
	
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Teachers</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-teacher/"><button type="button" class="btn btn-primary btn-xs">Add New Teacher</button></a></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content animated fadeIn">

				 <div class="col-xs-12">
                      <!-- Tab panes -->
                      <div class="tab-content">
					  
						                    <!-- start project list -->
                      
						<?php


						 echo '<h1 class="text-center">Teachers</h1>';

echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Name</th>
                          <th style="width: 20%">Subject</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>';					 
$teachers = $db->where('privilege',getvalue('title','teacher','users_role','role'))->orderBy('id','Asc')->ObjectBuilder()->get("users");
foreach($teachers as $teacher)
{
echo '<tr>';
echo '<td>#</td>';
echo '<td>'.$teacher->name.'</td>';
echo '<td>'.getvalue('teacher',$teacher->id,'subject','name').'</td>';
echo '<td><a target="_blank" href="'.base_url().'teacher/'.$teacher->username.'/" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> Profile </a> <a target="_blank" href="'.base_url().'dashboard/attendence/individual/'.$teacher->id.'/report/'.strtotime(date('Y-m-d')).'/" class="btn btn-success btn-xs"><i class="fa fa-bar-chart"></i> Attendence </a> <a href="'.base_url().'dashboard/teacher.php?action=edit&amp;id='.$teacher->id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm(\'Are you sure you want to delete '.$teacher->name.'?\');" href="'.base_url().'dashboard/teacher.php?action=delete&amp;id='.$teacher->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>';
echo '</tr>';
}
echo ' 
                      </tbody>
                    </table>';
echo '</div>';
						
						?>

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
'title' => 'Edit Teacher',
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
if(!$db->where ('id',$id)->has ('users'))
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
$userdata = $db->where ('id', $id)->ObjectBuilder()->getOne("users");
$sectiondata = $db->where ('teacher', $id)->ObjectBuilder()->getOne("section");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-teacher/"><button type="button" class="btn btn-primary btn-xs">Add Teacher</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-teacher/"><button type="button" class="btn btn-primary btn-xs">Manage Teacher</button></a></li>
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
isset($_POST['class']) ? $class= numberonly($_POST['class']) : $class=0;
isset($_POST['section']) ? $section= numberonly($_POST['section']) : $section=0;
isset($_POST['subject']) ? $subject= numberonly($_POST['subject']) : $subject=0;
isset($_POST['dob']) ? $dob= $_POST['dob'] : $dob=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
isset($_POST['uplaodfile']) ? $uplaodfile= $_POST['uplaodfile'] : $uplaodfile=null;
if($process==1)
{
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
$newpassword = $userdata->password;
}


if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$beforedir = '../';
$dir = "images/teacher";
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
if (file_exists($existfile))
{
unlink($existfile);
}

$avatar = $dir . '/' . $uplaodfile;
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
            'avatar' => $avatar,
						'birthday' => $dob,
						'phonenumber' => $phonenumber,
						'address1' => $address
					);
$userQuery = $db->where('id',$userdata->id)->update ('users', $userSQL);
if($subject>0)
{
$subjectSQL = Array (
						'teacher' => $userdata->id
					);
$subjectQuery = $db->where('id',$subject)->update ('subject', $subjectSQL);
}
else
{
$subjectQuery = true;
}
if($section>0)
{
$sectionSQL = Array (
						'teacher' => $userdata->id
					);
$sectionQuery = $db->where('id',$section)->update ('subject', $sectionSQL);
}
else
{
$sectionQuery = true;
}
if ($userQuery&&$subjectQuery&&$sectionQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Teacher information has been updated successfully!';
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
						<input type="text" id="name" name="name" class="form-control" placeholder="Teacher Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($userdata->name) ?>">
						</div>
						</div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="password" name="password" class="form-control" placeholder="Teacher Password">
						</div>
						</div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="subject" class="form-control">
                        <option value="0">Select</option>
					  <?php
					  
					  $subjects = $db->orderBy("class","Asc")->ObjectBuilder()->get ("subject");
					if ($db->count > 0)
						foreach ($subjects as $subject) { 
						$teacherclass = getvalue('teacher',$userdata->id,'subject','name');
						$classdata = $db->where ('class', $subject->class)->ObjectBuilder()->getOne("class");
					if ($id==$subject->teacher){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$subject->id.'"'.$selected.'>Class '.$classdata->name.' Section '.getvalue('id',$subject->id,'section','name').' - '.$subject->name.'</option>';
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
						$teacherclass = getvalue('teacher',$userdata->id,'section','class');
					if ($teacherclass==$class->teacher){$selected=' selected';}else{$selected='';}
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
                        <option value="0">--Select Section--</option>
					  <?php
					  
					  $sections = $db->where('teacher',$userdata->id)->orderBy("id","Desc")->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
						 echo '<option value="'.$section->id.'"'.$selected.'>Class '.getvalue('id',$section->class,'class','name').' Section '.$section->name.' '.$section->title.'</option>';
						}
					  ?>
					  </select>
					   </div>
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
						<input type="hidden" name="teacherid" value="<?php _e($teacher->id) ?>">
                          <button type="submit" class="btn btn-success">Edit Teacher</button>
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
'title' => 'Delete Teacher',
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