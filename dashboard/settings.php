<?php
/**
 * @name			Iskul - Education Management System
 * @category		Framework
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @Author URL		https://phpans.com
 * @Theme URL		https://phpans.com/demo/iskul/
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
case 'styles':
{
$head = Array(
'title' => 'Styles',
'page' => 'dashboard'
);
head($head);
?>
<link href="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.css" rel="stylesheet">

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
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$settingsupdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
if($process==1)
{
isset($_POST['preloader'])?$preloader=numberonly($_POST['preloader']):$preloader=0;

$SettingsQuery='';
$SettingsQuery.= $db->where('name','site-preloader')->update ('settings',Array('value'=>$preloader));

if ($SettingsQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Styles settings has been updated successfully!';
echo '</div>';
$settingsupdate =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}

?>
<div class="ln_solid"></div>
<?php 
if ($settingsupdate==false)
{
?>
                    <form method="post" class="form-horizontal form-label-left input_mask">

                    
<?php
if(settings('site-preloader')==1){$preloader=' checked';}else{$preloader ='';}
?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
              
                              <input name="preloader" value="1" type="checkbox" class="js-switch" <?php _e($preloader)?>/> Site Preloader
                            </label>
                          </div>
                          
                        </div>
                      </div>

<input type="hidden" name="process" value="1">
<br/><button type="submit" class="btn btn-primary">Save</button>
                    </form>
          
<?php } ?>
          </div>  
        
            </div>
          </div>
        </div>
        <!-- /page content -->
<script src="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.js"></script>
<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'alert':
{
$head = Array(
'title' => 'Alerts',
'page' => 'dashboard'
);
head($head);
?>
<link href="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.css" rel="stylesheet">

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
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<?php
$settingsupdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
if($process==1)
{
isset($_POST['sms'])?$sms=numberonly($_POST['sms']):$sms=0;
isset($_POST['email'])?$email=numberonly($_POST['email']):$email=0;
isset($_POST['attendence'])?$attendence=numberonly($_POST['attendence']):$attendence=0;
isset($_POST['student_alert'])?$student_alert=$_POST['student_alert']:$student_alert=null;

$SettingsQuery='';
$SettingsQuery.= $db->where('name','sms_service')->update ('settings',Array('value'=>$sms));
$SettingsQuery.= $db->where('name','email_service')->update ('settings',Array('value'=>$email));
$SettingsQuery.= $db->where('name','attendence_alert')->update ('settings',Array('value'=>$attendence));
$SettingsQuery.= $db->where('name','student_absent_message')->update ('settings',Array('value'=>$student_alert));

if ($SettingsQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Alert settings has been updated successfully!';
echo '</div>';
$settingsupdate =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}

?>
<div class="ln_solid"></div>
<?php 
if ($settingsupdate==false)
{
?>
                    <form method="post" class="form-horizontal form-label-left input_mask">

                    
<?php
if(settings('sms_service')==1){$sms=' checked';}else{$sms ='';}
if(settings('email_service')==1){$email=' checked';}else{$email ='';}
if(settings('attendence_alert')==1){$attendence=' checked';}else{$attendence ='';}
?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
							
                              <input name="sms" value="1" type="checkbox" class="js-switch" <?php _e($sms)?>/> SMS Alert
                            </label>
                          </div>
                          <div class="">
                            <label>
                              <input name="email" value="1" type="checkbox" class="js-switch" <?php _e($email)?>/> Email Alert
                            </label>
                          </div>
                          <div class="">
                            <label>
                              <input name="attendence" value="1" type="checkbox" class="js-switch" <?php _e($attendence)?>/> Attendence Alert
                            </label>
                          </div>
                          
                        </div>
                      </div>
					  <div class="form-group">
					   Student absent message <textarea id="textarea" required="required" name="student_alert" class="form-control col-md-7 col-xs-12"> <?php _e(settings('student_absent_message'))?></textarea>
					  </div>
<input type="hidden" name="process" value="1">
<br/><button type="submit" class="btn btn-primary">Save</button>
                    </form>
					
<?php } ?>
					</div>	
				
            </div>
          </div>
        </div>
        <!-- /page content -->
<script src="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.js"></script>
<?php dashboardfooter(); ?>
      </div>
    </div>
  </body>
</html>
<?php
}
break;
case 'general':
{
$head = Array(
'title' => 'General Settings',
'page' => 'dashboard'
);
head($head);
?>


<link href="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.css" rel="stylesheet">

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
<?php dashboardleftmenu(); ?>
<?php dashboardheader(); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row animated fadeIn">
                  <div class="x_title">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>

                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>
<?php
$settingsupdate =false;

isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
if($process==1)
{

isset($_POST['sitename'])?$sitename=$_POST['sitename']:$sitename=null;
isset($_POST['sitetitle'])?$sitetitle=$_POST['sitetitle']:$sitetitle=null;
isset($_POST['address'])?$address=$_POST['address']:$address=null;
isset($_POST['phonenumber'])?$phonenumber=$_POST['phonenumber']:$phonenumber=null;
isset($_POST['email'])?$email=$_POST['email']:$email=null;
isset($_POST['paypalemail'])?$paypalemail=$_POST['paypalemail']:$paypalemail=null;
isset($_POST['currency'])?$currency=$_POST['currency']:$currency=null;
isset($_POST['session'])?$session=$_POST['session']:$session=null;
isset($_POST['admission'])?$admission=numberonly($_POST['admission']):$admission=0;



$SettingsQuery='';
$SettingsQuery.= $db->where('name','sitename')->update ('settings',Array('value'=>$sitename));
$SettingsQuery.= $db->where('name','sitetitle')->update ('settings',Array('value'=>$sitetitle));
$SettingsQuery.= $db->where('name','address')->update ('settings',Array('value'=>$address));
$SettingsQuery.= $db->where('name','phonenumber')->update ('settings',Array('value'=>$phonenumber));
$SettingsQuery.= $db->where('name','email')->update ('settings',Array('value'=>$email));
$SettingsQuery.= $db->where('name','paypal_email')->update ('settings',Array('value'=>$paypalemail));
$SettingsQuery.= $db->where('name','currency')->update ('settings',Array('value'=>$currency));
$SettingsQuery.= $db->where('name','session')->update ('settings',Array('value'=>$session));
$SettingsQuery.= $db->where('name','online_admission')->update ('settings',Array('value'=>$admission));

if ($SettingsQuery)
{

echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Site Settings has been updated successfully!';
echo '</div>';
$settingsupdate =true;
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
if ($settingsupdate==false)
{
?>
                   <form method="post" class="form-horizontal form-label-left input_mask">

                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Site name<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="sitename" class="form-control" value="<?php _e(settings('sitename'))?>">
                        </div>
                      </div>
					  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Site Title<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="sitetitle" class="form-control" value="<?php _e(settings('sitetitle'))?>">
                        </div>
                      </div>
					  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="address" class="form-control" value="<?php _e(settings('address'))?>">
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="phonenumber" class="form-control" value="<?php _e(settings('phonenumber'))?>">
                        </div>
                      </div>
					  
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Email<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="email" class="form-control" value="<?php _e(settings('email'))?>">
                        </div>
                      </div>
					  
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PayPal Email<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<input name="paypalemail" class="form-control" value="<?php _e(settings('paypal_email'))?>">
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Currency<span class="required"></span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
						<?php
				if(settings('currency')=='USD'){$USD=' selected';}else{$USD='';}
				if(settings('currency')=='ENR'){$ENR=' selected';}else{$ENR='';}
				if(settings('currency')=='BDT'){$BDT=' selected';}else{$BDT='';}
				if(settings('currency')=='RS'){$RS=' selected';}else{$RS='';}
						?>
						<select name="currency" class="form-control" required="true">
						<option value="">Select Currency</option>
						<option value="USD"<?php _e($USD)?>>USD</option>
						<option value="END"<?php _e($ENR)?>>ENR</option>
						<option value="BDT"<?php _e($BDT)?>>BDT</option>
						<option value="RS"<?php _e($RS)?>>RS</option>
						</select>
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


<?php
if(settings('online_admission')==1){$admission=' checked';}else{$admission ='';}
?>                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
              
                              <input name="admission" value="1" type="checkbox" class="js-switch" <?php _e($admission); ?> /> Online Admission
                            </label>
                          </div>
                          
                        </div>
                      </div>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<input type="hidden" name="process" value="1">
                          <button type="submit" class="btn btn-primary">Update Settings</button>
                        </div>
                      </div>

                    </form>
			

					
<?php } ?>

<!-- Logo Setting -->
<div class="ln_solid"></div>
<h1 class="text-center">Logo Setting</h1>
<?php
$logoupdate = false;
isset($_POST['logoprocess'])?$logoprocess=$_POST['logoprocess']:$logoprocess=null;
if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$ext = explode(".", $origname);
$extension = end($ext);
$md5 = md5(time()).md5($origname);
$uplaodfile = validtext($ext[0]).'.'.$extension;
$support = array('jpg','jpeg','png');
if(!in_array($extension,$support))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span>Unsupported file format! We supprt ';
foreach ($support as $type)
{
echo $type. ', ';
}
echo 'file.';
echo '</div>  
          </div>  
          </div>  
          </div>  ';

dashboardfooter();
echo '</div>';
echo '</body>';
echo '</html>';
exit;
}
$basedir = 'images';
$backdir = '../';
$dir = $backdir.$basedir;
if (!is_dir($dir))
{
 mkdir($dir, 0755);
}
if(move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/'.$uplaodfile))
{
$sitelogo = $basedir . '/' . $uplaodfile;

if(file_exists($backdir.settings('logo'))){unlink($backdir.settings('logo'));}

}
else
{
$sitelogo = settings('logo');
}
$SettingsQuery= $db->where('name','logo')->update ('settings',Array('value'=>$sitelogo));

if ($SettingsQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Site logo has been updated successfully!';
echo '</div>';
$settingsupdate =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}
}
if ($logoupdate==false)
{
?>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group text-center">
						<img id="site-logo" class="img-responsive" src="<?php if(file_exists('../'.settings('logo')))_e(base_url().settings('logo'))?>">
						</div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
						<span class="btn btn-default btn-file">
    Upload new picture <input type="file" name="file" onchange="$('#site-logo').val($(this).val());">
</span>
<span class="label label-success" id="upload-file-info"></span>
						<input type="hidden" name="logoprocess" value="1">
                         <br/><button type="submit" class="btn btn-primary">Update Logo</button>
                        </div>
                      </div>

                    </form>
<?php } ?>			
 

<!-- Icon Setting -->
<div class="ln_solid"></div>
<h1 class="text-center">Icon Setting</h1>
<?php
$iconupdate = false;
isset($_POST['iconprocess'])?$iconprocess=$_POST['iconprocess']:$iconprocess=null;
if(isset($_FILES['iconfile'])) {
$origname = $_FILES['iconfile']['name'];
$ext = explode(".", $origname);
$extension = end($ext);
$md5 = md5(time()).md5($origname);
$uplaodfile = validtext($ext[0]).'.'.$extension;
$support = array('jpg','jpeg','png');
if(!in_array($extension,$support))
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span>Unsupported file format! We supprt ';
foreach ($support as $type)
{
echo $type. ', ';
}
echo 'file.';
echo '</div>  
          </div>  
          </div>  
          </div>  ';

dashboardfooter();
echo '</div>';
echo '</body>';
echo '</html>';
exit;
}
$basedir = 'images';
$backdir = '../';
$dir = $backdir.$basedir;
if (!is_dir($dir))
{
 mkdir($dir, 0755);
}
if(move_uploaded_file($_FILES['iconfile']['tmp_name'],$dir.'/'.$uplaodfile))
{
$siteicon = $basedir . '/' . $uplaodfile;

if(file_exists($backdir.settings('favicon'))){unlink($backdir.settings('favicon'));}

}
else
{
$siteicon = settings('favicon');
}
$SettingsQuery= $db->where('name','favicon')->update ('settings',Array('value'=>$siteicon));

if ($SettingsQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Site icon has been updated successfully!';
echo '</div>';
$settingsupdate =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}
}
if ($iconupdate==false)
{
?>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group text-center">
						<img id="site-logo" class="img-responsive" src="<?php if(file_exists('../'.settings('favicon')))_e(base_url().settings('favicon'))?>">
						</div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
						<span class="btn btn-default btn-file">
    Upload new picture <input type="file" name="iconfile" onchange="$('#upload-icon-info').val($(this).val());">
</span>
<span class="label label-success" id="upload-icon-info"></span>
						<input type="hidden" name="logoprocess" value="1">
                         <br/><button type="submit" class="btn btn-primary">Update Icon</button>
                        </div>
                      </div>

                    </form>
<?php } ?>			
 

					</div>	
					</div>	
					</div>	
<?php dashboardfooter(); ?>
      </div>
<script src="<?php echo base_url(); ?>themes/switchery/dist/switchery.min.js"></script>
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