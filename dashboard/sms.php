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
case 'bulk':
{
$head = Array(
'title' => 'Bulk SMS',
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
					<li><a href="<?php echo base_url(); ?>dashboard/individual-sms/"><button type="button" class="btn btn-primary btn-xs">Individual SMS</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/bulk-sms/"><button type="button" class="btn btn-primary btn-xs">Bulk SMS</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$smsupdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
isset($_POST['message'])?$message=$_POST['message']:$message=null;
isset($_POST['receiver'])?$smsreceiver=numberonly($_POST['receiver']):$smsreceiver=null;
if($process==1)
{

if(strlen($message)<5||strlen($message)>119)
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Message body should between 5-120 characters!';
echo '</div>';
$smsupdate=false;
}
else if($smsreceiver<0)
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Please select valid sms receiver!';
echo '</div>';
$smsupdate=false;
}
else
{
$smsQ=0;
$role = $db->where('role',$smsreceiver)->ObjectBuilder()->getOne('users_role');
$smsto = ucfirst($role->title);
$receivers = $db->where('privilege',$smsreceiver)->where('phonenumber','','!=')->orderBy("id","Asc")->ObjectBuilder()->get ("users");
					if ($db->count > 0)
						foreach ($receivers as $receiver) { 
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
					
						}


if ($smsQ)
{
/**
 @* Log 
**/
$title = 'Bulk SMS';
$log = '<b>'.user::inses()->name . '</b> sent bulk sms to <b>'.$smsto.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> SMS sent successfully!';
echo '</div>';
$smsupdate =true;
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
if ($smsupdate==false)
{
?>
              <form method="post" class="form-horizontal form-label-left input_mask">

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="receiver" class="form-control" required>
                        <option value="">--Select Receiver--</option>
					  <?php
					  $roles = $db->orderBy("id","Asc")->ObjectBuilder()->get ("users_role");
					if ($db->count > 0)
						foreach ($roles as $role) { 
					if($smsreceiver==$role->role){$selected =' selected';}else{$selected='';}
						$db->where('privilege',$role->role)->orderBy("id","Asc")->ObjectBuilder()->get ("users");
						 echo '<option value="'.$role->role.'"'.$selected.'>'.ucfirst($role->title).' ['.$db->count.']</option>';
						}
					  ?>
					  </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Message (max-120 Characters)
                        <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="message" class="form-control col-md-7 col-xs-12" type="text" required="required" placeholder="Type message..."><?php _e($message) ?></textarea>
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
break;case 'individual':
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
$smsupdate =false;

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
$smsupdate=false;
}
else if(!is_array($smsreceiver))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> Please select valid sms receiver!';
echo '</div>';
$smsupdate=false;
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
$smsupdate =true;
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
if ($smsupdate==false)
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