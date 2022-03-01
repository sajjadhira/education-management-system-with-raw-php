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
if (!file_exists(__DIR__ . "/config.php"))
{
header ("Location: ".__DIR__ ."/installer.php");
exit;
}
require_once(__DIR__ . "/config.php");
require_once( ROOT_DIR . "functions/static.class.php");
require_once( ROOT_DIR . "functions/dynamic.class.php");
require_once( ROOT_DIR . "functions/basic.functions.php");
global $config;
$main = new main;
$user = new user;
$db = MysqliDb::getInstance();
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

isset($_GET['action']) ? $action = validtext($_GET['action']) : $action = NULL;

switch ($action) {
case 'result':
$head = Array(
'title' => settings('sitename').' - Admission Result',
);
head($head);
?>
<div class="container-fluid">
    <!-- Second navbar for categories -->
    <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php  _e(settings('sitename')) ?></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url(); ?>online-admission/">Online Admission</a></li>
            <li><a href="<?php echo base_url(); ?>login/">Login</a></li>
            <li><a href="<?php echo base_url(); ?>contact-us/">Contact</a></li>
            <li>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

<div id="download-admit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Download Admit</h4>
      </div>
      <div class="modal-body">

      <div id="admit-content">
      </div>
       			    	<form id="admit-form" method="post">
					
			    	  	<div class="col-md12 form-group">
			    		    <input class="form-control" id="fullphone" placeholder="Please enter full phone number" name="serial" type="text" value="">
							<div class="text-danger" id="fullphone_error"></div>
			    		</div>					
						
    					<div class="row">
						<div class="col-md-12 form-group">
						<input type="hidden" name="process" value="1">
			    		<button class="btn btn-lg btn-info btn-block" id="admit-download" type="submit">Download</button>
						</div>
					</div>
			      	</form>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

	<div class="container animated fadeIn">
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/><?php _e($head['title']) ?></h3>
			 	</div>


			 	<div class="row">


			  	<div class="col-md-4 panel-body">
			    	<form method="post">
					
			    	  	<div class="col-md12 form-group">
			    		    <input class="form-control" id="serial" placeholder="Type Admission serial number" name="serial" type="text" value="">
							<div class="text-danger" id="serial_error"></div>
			    		</div>					
						
    					<div class="row">
						<div class="col-md-12 form-group">
						<input type="hidden" name="process" value="1">
			    		<button class="btn btn-lg btn-success btn-block" id="viweadmissionresult" type="submit">Search</button>
						</div>
					</div>
			      	</form>						
			    </div>

			<div class="col-md-8 panel-body" id="admission-result">
			    
Type students admission serial  number in the input box and click to search button.  Your result will be appare here.

			</div>


			    </div>





			</div>
		</div>
	</div>
</div>

			<div class="container-fluid">
			<div class="row text-center">
			&copy; <?php _e(settings('sitename').' '.settings('sitetitle')) ?>
			</div>	
			</div>	

<?php
foot();
break;	
default:

if(settings('online_admission')==0)
{
$head = Array(
'title' => settings('sitename').' - Online Admission',
);
head($head);
?>
    <!-- Second navbar for categories -->
    <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php  _e(settings('sitename')) ?></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url(); ?>online-admission-result/">Admission Result</a></li>
            <li><a href="<?php echo base_url(); ?>login/">Login</a></li>
            <li><a href="<?php echo base_url(); ?>contact-us/">Contact</a></li>
            <li>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
    

</div><!-- /.container-fluid -->

<div class="container">
<div class="row">

<div class="alert alert-info text-center">
<i class="fa fa-exclamation-triangle" area-hidden="true"></i> Online admission is currently closed.<br>
Please contact directly with administration.<br>

<div class="row">
<?php if(settings('phonenumber')!='') _e('Phone: '.settings('phonenumber').' <br>')?>
<?php if(settings('email')!='') _e('Email: '.settings('email').' <br>')?>
<?php if(settings('address')!='') _e('Address: '.settings('address').' <br/>')?>
</div>


</div>


</div>
</div>

			<div class="container-fluid">
			<div class="row text-center">
			&copy; <?php _e(settings('sitename').' '.settings('sitetitle')) ?>
			</div>	
			</div>	
<?php
foot();
exit();
}

$head = Array(
'title' => settings('sitename').' - Admission Form'
);
head($head);
?>
    <!-- Second navbar for categories -->
    <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php  settings('logo')?_e('<img src="'.base_url().settings('logo').'">'):_e(settings('sitename')) ?></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url(); ?>online-admission-result/">Admission Result</a></li>
            <li><a href="<?php echo base_url(); ?>login/">Login</a></li>
            <li><a href="<?php echo base_url(); ?>contact-us/">Contact</a></li>
            <li>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
    

</div><!-- /.container-fluid -->

<?php
$onlineadmission =false;
isset($_POST['process']) ? $process = $_POST['process'] : $process = NULL;
isset($_POST['username']) ? $username = $_POST['username'] : $username = NULL;
isset($_POST['password']) ? $password = $_POST['password'] : $password = NULL;
isset($_POST['name']) ? $name = $_POST['name'] : $name = NULL;
isset($_POST['birthday']) ? $dob = $_POST['birthday'] : $dob = NULL;
isset($_POST['email']) ? $email = $_POST['email'] : $email = NULL;
isset($_POST['section']) ? $section = numberonly($_POST['section']) : $section = NULL;
isset($_POST['gender']) ? $gender = $_POST['gender'] : $gender = NULL;
isset($_POST['father']) ? $father = $_POST['father'] : $father = NULL;
isset($_POST['mother']) ? $mother = $_POST['mother'] : $mother = NULL;
isset($_POST['address']) ? $address = $_POST['address'] : $address = NULL;
isset($_POST['phonenumber']) ? $phonenumber = $_POST['phonenumber'] : $phonenumber = NULL;
isset($_POST['transaction']) ? $transactionid = $_POST['transaction'] : $transactionid = NULL;
isset($_POST['captcha']) ? $captcha = $_POST['captcha'] : $captcha = NULL;
isset($_POST['parent']) ? $parent = numberonly($_POST['parent']) : $parent = 0;
isset($_POST['class']) ? $class = numberonly($_POST['class']) : $class = 0;

if ($process==1)
{

$exists = $db->where('username',$username)->orWhere('email',$email)->has('online_admission');

$getcaptcha = new Captcha;
/** Values **/
if ($captcha!=$getcaptcha->code())
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Captcha not valid please type valid captcha code!';
echo '</div>';
$onlineadmission =false;
}
else if ($exists)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Information already exists!';
echo '</div>';
$onlineadmission =false;
}
else if (strlen($name)<3)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student name!';
echo '</div>';
$onlineadmission =false;
}
else if (strlen($username)<3||strlen($username)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select valid username!<br/>Username must be 3-8 characters';
echo '</div>';
$onlineadmission =false;
}
else if (user::has($username))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> username already exists, please choose different one!';
echo '</div>';
$onlineadmission =false;
}
else if (invalidemail($email))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid email address!';
echo '</div>';
$onlineadmission =false;
}
else if (user::has($email))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> This email is associate with another account!';
echo '</div>';
$onlineadmission = false;
}
else if (empty($password))
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type your password!';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($password)<6||strlen($password)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Password should 6-10 characters!';
echo '</div>';
$onlineadmission = false;
}
else if ($class<1)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student class!';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($dob)<10||strlen($dob)>10)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student date of birth!';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($gender)<4)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student gender';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($father)<0)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student father\'s name';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($mother)<0)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student mother\'s name';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($address)<5)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type student address';
echo '</div>';
$onlineadmission = false;
}
else if (strlen($phonenumber)<10||strlen($phonenumber)>20)
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type valid phone number';
echo '</div>';
$onlineadmission = false;
}
else
{
if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$beforedir = '';
$dir = "images/student";
$ext = explode(".", $origname);
$extension = end($ext);
$validname = validtext($ext[0]);
$fileready = $validname.'.'.$extension;
if (file_exists($beforedir.$dir.'/'.$fileready))
{
$uploadfile = strtolower($validname.'_'.uniqid().'.'.$extension);
}
else
{
$uplaodfile = strtolower($validname.'.'.$extension);
}
if (!is_dir($dir))
{
 mkdir($dir, 0755);
}
$uploader = new ImageUploader($_FILES['file'],$beforedir.$dir.'/',$uplaodfile,250,250);
$uploader->upload();
$ok = $uploader->getInfo();
if(!empty($ok))
{
$avatar = $dir . '/' . $uplaodfile;
$uploaded= $uploader->getInfo();
}
else
{
$avatar = '';
}

}
else
{
$avatar = '';
}
$pass_encrept_options = [
					'cost' => 11,
					'salt' => random_bytes (22),
					];
					$AdmissionSQL = Array (
						'name' => $name,
						'username' => $username,
						'password' => password_hash($password,PASSWORD_BCRYPT,$pass_encrept_options),
						'email' => $email,
						'gender' => $gender,
						'avatar' => $avatar,
						'phonenumber' => $phonenumber,
						'father' => $father,
						'mother' => $mother,
						'address' => $address,
						'class' => $class,
						'section' => $section,
						'transactionid' => $transactionid,
						'parent' => $parent,
						'datetime' => $db->now()
					);
$AdmissionQuery = $db->insert ('online_admission', $AdmissionSQL);
if ($AdmissionQuery)
{
$getcaptcha->destroy();
$existinfo = $db->where('username',$username)->ObjectBuilder()->getOne('online_admission');
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Application has been submitted successfully!<br/>';
echo 'Your application serial number is <b>'.$existinfo->id.'</b>';
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

					if ($onlineadmission==false)
					{
					?>
	<div class="container">
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center"><i class="fa fa-mortar-board fa-5x" area-hidden="true"></i><br/><?php _e($head['title']) ?></h3>
			 	</div>
			  	<div class="panel-body animated fadeIn">
			    	<form method="post" enctype="multipart/form-data"  role="form" id="AdmissionForm">
					<div class="row">
					
			    	  	<div class="col-md-6 form-group">
			    		    <input class="form-control" id="name" placeholder="Student Name" name="name" type="text" required="required" value="<?php _e($name)?>">
							<div class="text-danger" id="name_error"></div>
			    		</div>					
			    	  	<div class="col-md-6 form-group">
			    		    <input class="form-control" id="username" placeholder="Student Username" name="username" type="text" value="<?php _e($username)?>" required>
							<div class="text-danger" id="username_error"></div>
			    		</div>						
			    	  	<div class="col-md-6 form-group">
			    		    <input class="form-control" id="email" placeholder="Student E-mail" name="email" type="email" value="<?php _e($email)?>" required>
							<div class="text-danger" id="email_error"></div>
			    		</div>					
			    	  	<div class="col-md-6 form-group">
			    		    <input class="form-control" id="password" placeholder="Student Password" name="password" type="password" value="" required>
							<div class="text-danger" id="password_error"></div>
			    		</div>
						
			    	  	<div class="col-md-6 form-group">
			    		    <input class="form-control" id="date" name="birthday" type="date" value="<?php _e($dob)?>" required>
						<div class="text-danger" id="date_error"></div>
			    		</div>
						
						
						<div class="col-md-6 form-group">
						<select name="class" id="studentclass" class="form-control" required="required">
                        <option value="">Select Class</option>
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
					
					<div class="col-md-6 form-group">
                       <div id="getsectionfromclass">
					   <fieldset disabled>
					   <select name="section" id="sectionselect" class="form-control" required="required">
					   <option value="">Select Class First</option>
					   <?php
					   if($class>0)
					   {
					  $postsection = $section;
					  $sections = $db->orderBy("id","Asc")->where('class',$postclass)->ObjectBuilder()->get ("section");
					if ($db->count > 0)
						foreach ($sections as $section) { 
					if ($postclass==$section->id){$selected=' selected';}else{$selected='';}
						 echo '<option value="'.$section->id.'"'.$selected.'>'.$section->name.' - '.$section->title.'</option>';
						}
					   }
					  ?>
					   </select>
					   </fieldset>
					   </div>
					   <div class="text-danger" id="section_error"></div>
                      </div>
						
                        <div class="col-md-6 form-group">
                          <select name="gender" id="gender" class="form-control" required="required">
						  <?php
						  if($gender=='Male'){$maleselected=' selected';}else{$maleselected='';}
						  if($gender=='Female'){$femaleselected=' selected';}else{$femaleselected='';}
						  ?>
						  <option value="">Select Gender</option>
						  <option value="Male" <?php _e($maleselected); ?>>Male</option>
						  <option value="Female" <?php _e($femaleselected); ?>>Female</option>
						  </select>
						  <div class="text-danger" id="gender_error"></div>
                        </div>
						
			    		<div class="col-md-6 form-group">
			    			<input class="form-control" id="father" placeholder="Father's Name" name="father" type="text" value="<?php _e($father) ?>" required>
							<div class="text-danger" id="fathe_rerror"></div>
			    		</div>
						
						
			    		<div class="col-md-6 form-group">
			    			<input class="form-control" id="mother" placeholder="Mother's Name" name="mother" type="text" value="<?php _e($mother) ?>" required>
							<div class="text-danger" id="mother_error"></div>
			    		</div>
						
						
			    		<div class="col-md-6 form-group">
			    			<input class="form-control" id="address" placeholder="Address" name="address" type="text" value="<?php _e($address) ?>">
							<div class="text-danger" id="address_error"></div>
			    		</div>
						
			    		<div class="col-md-6 form-group">
			    			<input class="form-control" id="phonenumber" placeholder="Phone Number" name="phonenumber" type="text" value="<?php _e($phonenumber) ?>">
							<div class="text-danger" id="phonenumber_error"></div>
			    		</div>
						
			    		        <div class="col-md-6 form-group">
            <label class="btn btn-block btn-primary">
                <i class="fa fa-image"></i> Student Photo...<input type="file"  name="file" style="display: none;"> <span id="attached"></span>
            </label>
        </div>
								
						<div class="col-md-6 form-group">
						<select name="parent" id="studentclass" class="form-control">
                        <option value="0">Select Parent</option>
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
						
												
			    		<div class="col-md-6 form-group">
			    			<input class="form-control" id="transaction" placeholder="Transaction ID" name="transaction" type="text" value="<?php _e($transactionid) ?>">
							<div class="text-danger" id="transaction_error"></div>
			    		</div>
												
			    		<div class="col-md-6 form-group">
						
						<div class="col-md-6" id="viewcaptcha">
						<img src="<?php echo base_url(); ?>captcha.png" alt="N/A"> <span id="reloadcaptcha" class="cursor-pointer label label-primary"><i class="fa fa-refresh" area-hidden="true"></i> Reload Captcha</span>
			    		</div>
						
						<div class="col-md-6">
						<input class="form-control" id="captcha" placeholder="Type Captcha" name="captcha" type="text" value="" required>
			    		</div>
						<div class="text-danger" id="captcha_error"></div>
			    		</div>

						
						</div>
					<div class="row">
						<div class="col-md-6 form-group">
						<input type="hidden" name="process" value="1">
			    		<input class="btn btn-lg btn-success btn-block" id="AdmissionFrom" type="submit" value="Apply">
						</div>
					</div>
						
					
			      	</form>			


					
			    </div>
			</div>
		</div>
	</div>
</div>
			<div class="container-fluid">
			<div class="row text-center">
			&copy; <?php _e(settings('sitename').' '.settings('sitetitle')) ?>
			</div>	
			</div>	
<?php
foot();
}

		break;
}

?>