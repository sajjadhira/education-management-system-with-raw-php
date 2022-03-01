<?php
/**
 * @name			Iskul - Education Management System
 * @category		Framework
 * @author			DevsBangla.
 * @copyright		DevsBangla.
 * @version			1.0.0
 * @Author URL		https://devsbangla.com
 * @Theme URL		https://devsbangla.com/demo/iskul/
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
case 'add-parent':
{
$head = Array(
'title' => 'Add Parent',
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
					<li><a href="<?php echo base_url(); ?>dashboard/manage-parent/"><button type="button" class="btn btn-primary btn-xs">Manage Parent</button></a></li>
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
isset($_POST['dob']) ? $dob= $_POST['dob'] : $dob=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['student']) ? $student= $_POST['student'] : $student=null;
isset($_POST['profession']) ? $profession= $_POST['profession'] : $profession=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
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
else if (strlen($dob)<10||strlen($dob)>10)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select parent date of birth!';
echo '</div>';
$registration = false;
}
else if (strlen($gender)<4)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select parent gender';
echo '</div>';
$registration = false;
}
else if (strlen($address)<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type parent address';
echo '</div>';
$registration = false;
}
else if (strlen($profession)<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type parent profession';
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
$dir = "images/parent";
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
$avatar = '/'.$dir . '/' . $uplaodfile;
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
						'privilege' =>	getvalue('title','parent','users_role','role'),
						'gender' => $gender,
						'birthday' => $dob,
            'avatar' => $avatar,
						'phonenumber' => $phonenumber,
						'address1' => $address,
						'profession' => $profession,
						'registered' => $db->now()
					);
$userQuery = $db->insert ('users', $userSQL);
$userinfo = user::info($username);
if(is_array($student))
{
foreach ($student as $stu)
{
$studentSQL = Array (
						'parent' => $userinfo->id
					);
$studentQuery = $db->where('uid',$stu)->update ('student', $studentSQL);

}
}
else
{
$studentQuery = true;
}
if ($userQuery&&$studentQuery)
{
	
/**
 @* Log 
**/
$title = 'Parent Add';
$log = '<b>'.user::inses()->name . '</b> added a parent <b>'.$name.'</b>';
activitylog($title,$log);
/**/
	
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Parent has been added successfully!';
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
                        <input type="text" id="name" name="name" class="form-control has-feedback-left" placeholder="Parent Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($name) ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Parent Username" required="required" value="<?php _e($username) ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="email" name="email" class="form-control has-feedback-left" placeholder="Parent Email" required="required" value="<?php _e($email) ?>">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Parent Password" required="required" value="<?php _e($password) ?>">
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Students</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="student[]" class="form-control" multiple>
                        <option value="0">--Select Students--</option>
					  <?php
					  $postclass = $class;
					  $students = $db->where('privilege',getvalue('title','student','users_role','role'))->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($students as $student) { 
					$selected='';
						 echo '<option value="'.$student->id.'"'.$selected.'>'.$student->name.'</option>';
						}
					  ?>
					  </select>
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
                          <input name="address" class="form-control col-md-7 col-xs-12" type="text" placeholder="Parent Address" required="required" value="<?php _e($address) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profession
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="profession" class="form-control col-md-7 col-xs-12" type="text" placeholder="Parent Profession" required="required" value="<?php _e($profession) ?>">
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
          <i class="fa fa-image"></i> Parent Photo...<input type="file"  name="file" style="display: none;"> <span id="attached"></span>
            </label>
        </div>
        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Add Parent</button>
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
case 'manage-parent':
{
$head = Array(
'title' => 'Manage Parent',
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
                <h3>Manage <small>Parents</small></h3>
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
                    <h2>Parents</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-parent/"><button type="button" class="btn btn-primary btn-xs">Add New Parent</button></a></li>
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


						 echo '<h1 class="text-center">Parents</h1>';

echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Name</th>
                          <th style="width: 20%">Phone Number</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>';		
isset($_GET['page'])?$page=numberonly($_GET['page']):$page=1;
if($page<1)$page=1;
$db->pageLimit = 20;					  
$parents = $db->where('privilege',getvalue('title','parent','users_role','role'))->orderBy('id','Asc')->ObjectBuilder()->paginate("users",$page);
$Pages = $db->totalPages;
if($page>$Pages)$page=$Pages;
foreach($parents as $parent)
{
echo '<tr>';
echo '<td>#</td>';
echo '<td>'.$parent->name.'</td>';
echo '<td>'.$parent->phonenumber.'</td>';
echo '<td><a target="_blank" href="'.base_url().'parent/'.$parent->username.'/" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> Profile </a> <a href="'.base_url().'dashboard/parent.php?action=edit&amp;id='.$parent->id.'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm(\'Are you sure you want to delete '.$parent->name.'?\');" href="'.base_url().'dashboard/parent.php?action=delete&amp;id='.$parent->id.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a></td>';
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
for($i>1;$i<=$totalNotice;$i++)
{
if ($page==$i){$active = ' class="active"';}else{$active='';}
?>
  <li <?php _e($active) ?>><a href="<?php echo base_url(); ?>dashboard/manage-parent/page-<?php _e($i) ?>/"><?php _e($i) ?></a></li>
 <?php
}
 ?>
</ul>
</div>
<?php } ?>					  
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
'title' => 'Edit Parent',
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
isset($_POST['profession']) ? $profession= $_POST['profession'] : $profession=null;
isset($_POST['gender']) ? $gender= $_POST['gender'] : $gender=null;
isset($_POST['address']) ? $address= $_POST['address'] : $address=null;
isset($_POST['student']) ? $student= $_POST['student'] : $student=null;
isset($_POST['uplaodfile']) ? $uplaodfile= $_POST['uplaodfile'] : $uplaodfile=null;
isset($_POST['phonenumber']) ? $phonenumber= $_POST['phonenumber'] : $phonenumber=null;
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
else if (strlen($address)<1)
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
$dir = "images/parent";
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
						'profession' => $profession,
						'address1' => $address
					);
$userQuery = $db->where('id',$id)->update ('users', $userSQL);
$userinfo = user::info($id);
if(is_array($student))
{
foreach ($student as $stu)
{
$studentSQL = Array (
						'parent' => $userinfo->id
					);
$studentQuery = $db->where('uid',$stu)->update ('student', $studentSQL);

}
}
else
{
$studentQuery = true;
}
if ($userQuery&&$studentQuery)
{
/**
 @* Log 
**/
$title = 'Parent Edit';
$log = '<b>'.user::inses()->name . '</b> edit a parent <b>'.$name.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Parent information has been updated successfully!';
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

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" id="name" name="name" class="form-control has-feedback-left" placeholder="Parent Name" required="required" data-validate-length-range="6" data-validate-words="2" value="<?php _e($userdata->name) ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Parent Username" required="required" value="<?php _e($userdata->username) ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="email" name="email" class="form-control has-feedback-left" placeholder="Parent Email" required="required" value="<?php _e($userdata->email) ?>">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Parent Password">
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Students</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="student[]" class="form-control" multiple>
                        <option value="0">--Select Students--</option>
					  <?php
					  $postclass = $class;
					  $students = $db->orderBy("id","Asc")->ObjectBuilder()->get ("student");
					if ($db->count > 0)
						foreach ($students as $student) { 
					if ($student->parent==$id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$student->uid.'"'.$selected.'>'.getvalue('id',$student->uid,'users','name').'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="dob" class="date-picker form-control col-md-7 col-xs-12" type="date" required="required" value="<?php _e($userdata->birthday) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender
                        <span class="required">*</span></label>
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
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="address" class="form-control col-md-7 col-xs-12" type="text" placeholder="Parent Address" required="required" value="<?php _e($userdata->address1) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profession
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input name="profession" class="form-control col-md-7 col-xs-12" type="text" placeholder="Parent Profession" required="required" value="<?php _e($userdata->profession) ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone
                        <span class="required">*</span></label>
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
                          <button type="submit" class="btn btn-success">Edit Parent</button>
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
'title' => 'Delete Parent',
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
					<li><a href="<?php echo base_url(); ?>dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-student/"><button type="button" class="btn btn-primary btn-xs">Manage Student</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php
$userdata = $db->where ('id', $id)->ObjectBuilder()->getOne("users");

if($db->where('id', $id)->delete('users'))
{
/**
 @* Log 
**/
$title = 'Parent Delete';
$log = '<b>'.user::inses()->name . '</b> deleted a parent <b>'.$userdata->name.'</b>';
activitylog($title,$log);
/**/
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