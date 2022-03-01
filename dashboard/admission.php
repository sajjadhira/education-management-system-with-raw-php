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

include "../config.php";
include  ROOT_DIR . "functions/static.class.php";
include  ROOT_DIR . "functions/dynamic.class.php";
include  ROOT_DIR . "functions/basic.functions.php";

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
case 'request':
{
$head = Array(
'title' => 'Admit Student',
'page' => 'dashboard'
);
head($head);
isset($_GET['id']) ? $id = numberonly($_GET['id']) : $id=NULL;
$info = $db->where('id',$id)->ObjectBuilder()->getOne('online_admission');
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
<?php if(isset($_POST['save_status'])&&$_POST['save_status']==1):
isset($_POST['change_status']) ? $change_status= numberonly($_POST['change_status']) : $change_status=0;

$data = array
(
'status' => $change_status
);
$update = $db->where('id',$id)->update('online_admission',$data);
if ($update)
{
echo '<div class="alert alert-success text-center">Student admission information has been updated successfully.</div>';
} else
{
echo '<div class="alert alert-success text-center">There is a problem to update student admission information.</div>';
}

endif;
$info = $db->where('id',$id)->ObjectBuilder()->getOne('online_admission');
 ?>

<table class="table table-striped">
    <tbody>
      
      <tr>
        <td>Photo</td>
        <td><?php  
        if(isset($info->avatar)&&file_exists('../'.$info->avatar))
        echo _img($info->avatar);
         ?></td>
      </tr>


      <tr>
        <td>Application ID</td>
        <td><?php echo $id; ?></td>
      </tr>

           
      <tr>
        <td>Username</td>
        <td><?php echo $info->username; ?></td>
      </tr>
      
      <tr>
        <td>Name</td>
        <td><?php echo $info->name; ?></td>
      </tr>
      
      <tr>
        <td>Email</td>
        <td><?php echo $info->email; ?></td>
      </tr>
      
      <tr>
        <td>Gender</td>
        <td><?php echo $info->gender; ?></td>
      </tr>
      
      <tr>
        <td>Address</td>
        <td><?php echo $info->address; ?></td>
      </tr>
      
      <tr>
        <td>Class</td>
        <td><?php echo getvalue('class',$info->class,'class','name'); ?></td>
      </tr>
      
      <tr>
        <td>Section</td>
        <td><?php echo getvalue('id',$info->section,'section','name').' ('.getvalue('id',$info->section,'section','title').')'; ?></td>
      </tr>
      
      <tr>
        <td>Gender</td>
        <td><?php echo $info->gender; ?></td>
      </tr>
      
      <tr>
        <td>Address</td>
        <td><?php echo $info->address; ?></td>
      </tr>
      
      <tr>
        <td>Phone Number</td>
        <td><?php echo $info->phonenumber; ?></td>
      </tr>
      <?php if(isset($info->parent)&&$info->parent>0): ?>
      <tr>
        <td>Parent</td>
        <td><?php echo getvalue('id',$info->parent,'users','name'); ?></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td>Father's Name</td>
        <td><?php echo $info->father; ?></td>
      </tr>

      <tr>
        <td>Mother's Name</td>
        <td><?php echo $info->mother; ?></td>
      </tr>
      <tr>

        <td>Birthday</td>
        <td><?php echo $info->birthday; ?></td>
      </tr>
      
      <tr>
        <td>Transaction ID</td>
        <td><?php echo $info->transactionid; ?></td>
      </tr>


      <tr>
        <td>Application Status</td>
        <td><?php
if($info->status==0){$status='<span class="text-warning"><strong>Pending</strong></span>';}
else if($info->status==1){$status='<span class="text-success"><strong>Approved</strong></span>';}
else{$status='<span class="text-danger"><strong>Decline</strong></span>';}
         echo $status; ?></td>
      </tr>

      <tr>
        <td>Modify Application</td>
<td>
<form method="post" class="form-inline">
<select name="change_status" class="form-control">
<option value="0">Pending</option>
<option value="1" selected="selected">Approve</option>
<option value="2">Decline</option>
</select>
<button type="submit" class="btn btn-primary">Save</button>
<input type="hidden" name="save_status" value="1">
</form>
</td>
</tr>

      </tbody>
      </table>
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
case 'requests':
{
$head = Array(
'title' => 'Admission Requests',
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
                <h3>Admission <small>Request</small></h3>
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
					<li><a href="/dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
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

						 echo '<div class="tab-pane active" id="admission-request">';
						 echo '<h1 class="text-center">Admission Requests</h1>';

echo '<table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Student Username</th>
                          <th>Student Name</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>';		
isset($_GET['page'])?$page=numberonly($_GET['page']):$page=1;
if($page<1)$page=1;
$db->pageLimit = 20;
$students = $db->orderBy('id','Asc')->ObjectBuilder()->paginate("online_admission",$page);
$Pages = $db->totalPages;
if($page>$Pages)$page=$Pages;
foreach($students as $student)
{
echo '<tr>';
echo '<td>#</td>';
echo '<td>'.$student->username.'</td>';
echo '<td>'.$student->name.'</td>';
echo '<td>'.getvalue('class',$student->class,'class','name').'</td>';
echo '<td>'.getvalue('id',$student->section,'section','name').' ('.getvalue('id',$student->section,'section','title').')</td>';
if($student->status==0){$status='<span class="text-warning"><strong>Pending</strong></span>';}
else if($student->status==1){$status='<span class="text-success"><strong>Approved</strong></span>';}
else{$status='<span class="text-danger"><strong>Declined</strong></span>';}
echo '<td>'.$status.'</td>';
echo '<td><a href="'.base_url().'dashboard/manage-admission-request/request/'.$student->id.'/"><button class="btn btn-primary">Manage</button></a></td>';
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
  <li <?php _e($active) ?>><a href="/dashboard/manage-student/class-<?php _e($getclass) ?>/page-<?php _e($i) ?>/"><?php _e($i) ?></a></li>
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
case 'manage':
{
$head = Array(
'title' => 'Manage Request',
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
if(!$db->where ('id',$id)->has ('online_admission'))
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
$studentdata = $db->where ('id', $id)->ObjectBuilder()->getOne("online_admission");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="/dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
					<li><a href="/dashboard/manage-student/"><button type="button" class="btn btn-primary btn-xs">Manage Student</button></a></li>
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
					'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
					];
if (isset($_POST['password']))
{
$newpassword = password_hash($password,PASSWORD_BCRYPT,$pass_encrept_options);
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
					<li><a href="/dashboard/admit-student/"><button type="button" class="btn btn-primary btn-xs">Admit Student</button></a></li>
					<li><a href="/dashboard/manage-student/"><button type="button" class="btn btn-primary btn-xs">Manage Student</button></a></li>
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