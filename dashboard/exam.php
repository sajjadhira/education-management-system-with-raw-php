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
case 'type-list':
{
$head = Array(
'title' => 'Exam Type List',
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-exam-type/"><button type="button" class="btn btn-primary btn-xs">Add Exam Type</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/add-exam/"><button type="button" class="btn btn-primary btn-xs">Add Exam</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/bulk-sms/"><button type="button" class="btn btn-primary btn-xs">Bulk SMS</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">

				<table class="table table-striped">
				<thead>
				<tr>
				<th>Exam Name</th>
				<th>Session</th>
				<th>Action</th>
				</tr>
				</thead>
				
				
				<tbody>
				<?php
				$exams = $db->OrderBy('id','Asc')->ObjectBuilder()->get('exam_type');
				foreach ($exams as $exam)
				{
				?>
				<tr>
				<td><?php _e($exam->name) ?></td>
				<td><?php _e($exam->session) ?></td>
				<td><a href="<?php echo base_url(); ?>dashboard/exam.php?action=edit&amp;id=<?php _e($exam->id) ?>"><span class="label label-primary"><i class="fa fa-pencil" area-hidden="true"></i> Edit</span></a> <a href="<?php echo base_url(); ?>dashboard/exam.php?action=delete&amp;id=<?php _e($exam->id) ?>"><span class="label label-danger"><i class="fa fa-recycle" area-hidden="true"></i> Delete</span></a></td>
				</tr>
				<?php
				}
				?>
				</tbody>
				
				</table>
				
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
case 'add-type':
{
$head = Array(
'title' => 'Add Exam Type',
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
          <li><a href="<?php echo base_url(); ?>dashboard/exam-type-list/"><button type="button" class="btn btn-primary btn-xs">Exam Type List</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$examipdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['name'])?$name=$_POST['name']:$name=null;
isset($_POST['session'])?$session=$_POST['session']:$session=null;
if($process==1)
{

if(strlen($name)<5)
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Exam name should more then 5characters!';
echo '</div>';
$examipdate=false;
}
else if($db->where('name',$name)->where('session',$session)->has('exam_type'))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Exam type already exist with same name!';
echo '</div>';
$examipdate=false;
}
else
{
$data = Array
(
'name' => $name,
'session' => $session
);
$inserted = $db->insert('exam_type',$data);
if ($inserted)
{
/**
 @* Log 
**/
$title = 'Exam Type';
$log = '<b>'.user::inses()->name . '</b> add exam type <b>'.$name.' and session '.$session.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Exam has been added successfully!';
echo '</div>';
$examipdate =true;
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
if ($examipdate==false)
{
?>
              <form method="post" class="form-horizontal form-label-left input_mask">

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
            <input name="name" type="text" class="form-control" required>
                       
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Session<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
        if(settings('session')==(date('Y')-(1).'-'.date('y'))){$opt1=' selected';}else{$opt1='';}
        if(settings('session')==date('Y').'-'.(date('y')+(1))){$opt2=' selected';}else{$opt2='';}
        if(settings('session')==(date('Y')+(1)).'-'.(date('y')+(2))){$opt3=' selected';}else{$opt3='';}
        if(settings('session')==(date('Y')+(2)).'-'.(date('y')+(3))){$opt4=' selected';}else{$opt4='';}
            ?>
            <select name="session" class="form-control" required="true">
            <option value="">Select Session</option>
            <option value="<?php _e((date('Y')-(1).'-'.date('y')))?>"<?php _e($opt1)?>><?php _e(date('Y')-(1).'-'.date('y'))?></option>
            <option value="<?php _e(date('Y').'-'.(date('y')+(1)))?>"<?php _e($opt2)?>><?php _e(date('Y').'-'.(date('y')+(1)))?></option>
            <option value="<?php _e((date('Y')+(1)).'-'.(date('y')+(2)))?>"<?php _e($opt3)?>><?php _e((date('Y')+(1)).'-'.(date('y')+(2)))?></option>
            <option value="<?php _e((date('Y')+(2)).'-'.(date('y')+(3)))?>"<?php _e($opt4)?>><?php _e((date('Y')+(2)).'-'.(date('y')+(3)))?></option>

            </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Add Exam</button>
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
case 'add-exam':
{
$head = Array(
'title' => 'Add Exam',
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
					<li><a href="<?php echo base_url(); ?>dashboard/exam-type-list/"><button type="button" class="btn btn-primary btn-xs">Exam Type List</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$examipdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['name'])?$name=$_POST['name']:$name=null;
isset($_POST['session'])?$session=$_POST['session']:$session=null;
if($process==1)
{

if(strlen($name)<5)
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Exam name should more then 5characters!';
echo '</div>';
$examipdate=false;
}
else if($db->where('name',$name)->where('session',$session)->has('exam_type'))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Exam type already exist with same name!';
echo '</div>';
$examipdate=false;
}
else
{
$data = Array
(
'name' => $name,
'session' => $session
);
$inserted = $db->insert('exam_type',$data);
if ($inserted)
{
/**
 @* Log 
**/
$title = 'Exam Type';
$log = '<b>'.user::inses()->name . '</b> add exam type <b>'.$name.' and session '.$session.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Exam has been added successfully!';
echo '</div>';
$examipdate =true;
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
if ($examipdate==false)
{
?>
              <form method="post" class="form-horizontal form-label-left input_mask">

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Exam Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="examtype" class="form-control" required="required">
                  <?php 
                  $types = $db->orderBy('id','Desc')->ObjectBuilder()->get('exam_type');
                  foreach ($types as $exam) {
                  
                  ?>
						
                  <option value="<?php _e($exam->id) ?>"><?php _e($exam->name. ' ' .$exam->session) ?></option>
              <?php } ?>


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

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Add Exam</button>
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

case 'individual':
{
$head = Array(
'title' => 'Individual SMS',
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
					<li><a href="<?php echo base_url(); ?>dashboard/general-settings/"><button type="button" class="btn btn-primary btn-xs">General Setting</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/bulk-sms/"><button type="button" class="btn btn-primary btn-xs">Bulk SMS</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/individual-sms/"><button type="button" class="btn btn-primary btn-xs">Individual SMS</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$examipdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['message'])?$message=$_POST['message']:$message=null;
isset($_POST['receiver'])?$smsreceiver=$_POST['receiver']:$smsreceiver=null;
if($process==1)
{

if(strlen($message)<5||strlen($message)>119)
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Message body should between 5-120 characters!';
echo '</div>';
$examipdate=false;
}
else if(!is_array($smsreceiver))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Please select valid sms receiver!';
echo '</div>';
$examipdate=false;
}
else
{
$smsQ=0;
$smsto = '';
						foreach ($smsreceiver as $smsreceive) {
					$receiver= $db->where('id',$smsreceive)->ObjectBuilder()->getOne('users');
					$sms = Array(
					'number' => $receiver->phonenumber,
					'message' => $message
					);
					if(sms($sms))
					{
					$smsQ.=$smsQ*1;
					}
					else
					{
					$smsQ.=$smsQ*0;
					}
					$smsto.= $receiver->name. ', ';
						}


if ($smsQ)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> SMS sent successfully!';
echo '</div>';
$examipdate =true;
/**
 @* Log 
**/
$title = 'SMS Individual';
$log = '<b>'.user::inses()->name . '</b> sent individual sms to <b>'.$smsto.'</b>';
activitylog($title,$log);
/**/
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
if ($examipdate==false)
{
?>
              <form method="post" class="form-horizontal form-label-left input_mask">

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="receiver[]" class="form-control" multiple>
                        <option value="">--Select Receiver--</option>
					  <?php
					  $receivers = $db->orderBy("privilege","Asc")->where('phonenumber','','!=')->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($receivers as $receiver) { 
					$selected ='';
						 echo '<option value="'.$receiver->id.'"'.$selected.'>'.ucfirst($receiver->name).'</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Message (max-120 Characters)
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="message" class="form-control col-md-7 col-xs-12" type="text" required="required" placeholder="Type message..."></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-success">Send Message</button>
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
default:
{
_e(error());
}
}
?>