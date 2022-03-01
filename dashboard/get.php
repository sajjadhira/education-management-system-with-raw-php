<?php
/**
 * @name			Education Managemnet System
 * @category		E-Commerce
 * @author			phpans.
 * @copyright		phpans.
 * @version			1.0.0
 * @Author URL		https://phpans.com
 
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
isset($_REQUEST['action'])?$action=$_REQUEST['action']:$action=null;
switch($action)
{
case 'getsection':
{
echo '<select name="section" id="sectionselect" class="form-control">';
$class = numberonly($_POST['class']);
$sections = $db->where('class',$class)->orderBy("name","Asc")->ObjectBuilder()->get ("section");
if ($db->count > 0)
    foreach ($sections as $section) { 
    echo '<option value="'.$section->id.'">'.$section->name.' - '.$section->title.'</option>';
    }
else
echo '<option value="">--No Section Found--</option>';
echo '</select>';
}
break;
case 'checkuser':
{
$username = $_POST['username'];
if(user::has($username)){echo 1;}else{echo 0;}
}
break;
case 'getadmissionresult':
{
$serial = numberonly($_POST['serial']);
$has = $db->where('id',$serial)->has('online_admission');
if($has)
{
$getinfo = $db->where('id',$serial)->ObjectBuilder()->getOne('online_admission');


$middilenumber = substr($getinfo->phonenumber, 4, -2);
$first3digit = substr($getinfo->phonenumber, 0, 4);
$last3digit = substr($getinfo->phonenumber,-2);
$securedmiddle = str_repeat("&#8226;", strlen($middilenumber));
$securedphone = $first3digit.$securedmiddle.$last3digit;
if($getinfo->status==0){$status='<span class="text-warning"><strong>Pending</strong></span>';}
else if($getinfo->status==1){$status='<span class="text-success"><strong>Approved</strong></span>';}
else{$status='<span class="text-danger"><strong>Decline</strong></span>';}

echo '<table class="table table-striped">
    <tbody>
      <tr>
        <td>Application ID</td>
        <td>'.$serial.'</td>
      </tr>
      <tr>
        <td>Applicant Name</td>
        <td>'.$getinfo->name.'</td>
      </tr>
      <tr>
        <td>Class</td>
        <td>'.getvalue('class',$getinfo->class,'class','name').'</td>
      </tr>
      <tr>
        <td>Section</td>
        <td>'.getvalue('id',$getinfo->section,'section','name').' ('.getvalue('id',$getinfo->section,'section','title').')</td>
      </tr>
      <tr>
        <td>Phone</td>
        <td>'.$securedphone.'</td>
      </tr>
      <tr>
        <td>Father\'s Name</td>
        <td>'.$getinfo->father.'</td>
      </tr>
      <tr>
        <td>Mother\'s Name</td>
        <td>'.$getinfo->mother.'</td>
      </tr>
      <tr>
        <td>Status</td>
        <td>'.$status.'</td>
      </tr>
    </tbody>
  </table>';
 if($getinfo->status==1)
 {
 echo '<div class="row text-center">';
 echo '<button class="btn btn-primary" id="download-admit">Download Admit</button>';
 echo '</div>';
}
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<i class="fa fa-times" area-hidden="true"></i> Serial id does not exists!';
echo '</div>';
}
}
break;
case 'checkcaptcha':
{
$captchacode = $_POST['captcha'];
$captcha = new Captcha;
if($captcha->valid($captchacode)){echo 1;}else{echo 0;}
}
break;
case 'reloadcaptcha':
{
$captcha = new Captcha;
$captcha->destroy();
echo '<img src="'.base_url().'captcha.png" alt="N/A"> <span id="reloadcaptcha" class="cursor-pointer label label-primary"><i class="fa fa-refresh" area-hidden="true"></i> Reload Captcha</span>';
}
break;
case 'getsubject':
{
echo '<select name="subject" id="subjectselect" class="form-control">';
$class = numberonly($_POST['class']);
$subjects = $db->where('class',$class)->orderBy("name","Asc")->ObjectBuilder()->get ("subject");
if ($db->count > 0)
    foreach ($subjects as $subjects) { 
    echo '<option value="'.$subjects->id.'">'.$subjects->name.'</option>';
    }
else
echo '<option value="">--No Subject Found--</option>';
echo '</select>';
}
break;
default:
{
die('unfinded!');
}

}
?>