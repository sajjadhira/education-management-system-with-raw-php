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
header ("Location: ../installer.php");
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
case 'gallery':
{
$head = Array(
'title' => 'Gallery',
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-gallery-photo/"><button type="button" class="btn btn-primary btn-xs">Add Photo</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                <div class="x_content">
<div class="row">

<?php
$photos=$db->orderBy('id','Desc')->ObjectBuilder()->get('gallery');
foreach ($photos as $gallery)
{
?>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="<?php _e(base_url().$gallery->image) ?>" alt="image" />
                            <div class="mask">
                              <p>#<?php _e($gallery->id) ?> By <?php _e(user::info($gallery->uid)->name) ?></p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo base_url(); ?>dashboard/gallery.php?action=edit&amp;id=<?php _e($gallery->id) ?>"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo base_url(); ?>dashboard/gallery.php?action=delete&amp;id=<?php _e($gallery->id) ?>"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><?php _e($gallery->text) ?></p>
                          </div>
                        </div>
                      </div>
<?php } ?>
</div>	

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
case 'add':
{
$head = Array(
'title' => 'Add Gallery Photo',
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
                  <div class="x_title">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>

                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/gallery/"><button type="button" class="btn btn-primary btn-xs">Gallery</button></a></li>
                      </li>
                    </ul>
                  </div>
				  
				  
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>

<?php
$logoupdate = false;
isset($_POST['process'])?$process=$_POST['process']:$process=null;
isset($_POST['text'])?$text=$_POST['text']:$text=null;
if(isset($_FILES['file'])) {
$origname = strtolower($_FILES['file']['name']);
$ext = explode(".", $origname);
$extension = end($ext);
$md5 = md5(time()).md5($origname);

$basedir = 'gallery';
$backdir = '../';
$dir = $backdir.$basedir;
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
					</div>	';

dashboardfooter();
echo '</div>';
echo '</body>';
echo '</html>';
exit;
}
if(file_exists($dir.'/'.$uplaodfile)){$uplaodfile=validtext($ext[0]).'_'.uniqid().'.'.$extension;}
if (!is_dir($dir))
{
 mkdir($dir, 0755);
}
if(move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/'.$uplaodfile))
{
$image = $basedir . '/' . $uplaodfile;
$data = Array(
'uid' => user::inses()->id,
'image' => $image,
'text' => $text,
'datetime' => $db->now()
);

$GalleryQuery = $db->insert('gallery',$data);

}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}


if ($GalleryQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Gallery photo has been added successfully!';
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
                      <div class="form-group">
                        
						<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
						
						<div class="col-md-12">
						Upload Image <input class="form-control" type="file" name="file">
						</div>
						<div class="col-md-12">
                        Caption <textarea name="text" class="form-control"></textarea>
						</div>
                        <br/>
						 <button type="submit" class="btn btn-primary">Upload Picture</button>
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
case 'edit':
{
isset($_GET['id'])?$id=numberonly($_GET['id']):$id=0;
if(!$db->where('id',$id)->has('gallery'))
{
ob_clean();
die(error(array('title'=>'Gallery image not found','description'=>'Your requested gallery image does not found in our system!')));
}
$head = Array(
'title' => 'Edit Gallery Photo',
'page' => 'dashboard'
);
head($head);
$gallery = $db->where('id',$id)->ObjectBuilder()->getOne('gallery');
?>


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

                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/gallery/"><button type="button" class="btn btn-primary btn-xs">Gallery</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/add-gallery-photo/"><button type="button" class="btn btn-primary btn-xs">Add Photo</button></a></li>
                      </li>
                    </ul>
                  </div>
				  
				  
                  </div>
      <div class="x_content">
                  <div id="alerts"></div>

<?php
$galleryupdate = false;
isset($_POST['process'])?$process=$_POST['process']:$process=null;
isset($_POST['text'])?$text=$_POST['text']:$text=null;
if($process==1) {

$data = Array(
'uid' => user::inses()->id,
'text' => $text
);

$GalleryQuery = $db->where('id',$id)->update('gallery',$data);

if ($GalleryQuery)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Gallery photo has been updated successfully!';
echo '</div>';
$galleryupdate =true;
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}
}

if ($galleryupdate==false)
{
?>
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        
						<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
						
						<div class="col-md-12">
						<img src="/<?php _e($gallery->image) ?>" class="img-responsive">
						</div>
						<div class="col-md-12">
                        Caption <textarea name="text" class="form-control"><?php _e($gallery->text) ?></textarea>
						</div>
                        <br/>
						<input type="hidden" name="process" value="1">
						 <button type="submit" class="btn btn-primary">Update Picture</button>
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
'title' => 'Delete Gallery Photo',
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
					<li><a href="<?php echo base_url(); ?>dashboard/gallery/"><button type="button" class="btn btn-primary btn-xs">Gallery</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/add-gallery-photo/"><button type="button" class="btn btn-primary btn-xs">Add Photo</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php
$gallery = $db->where ('id', $id)->ObjectBuilder()->getOne("gallery");

if($db->where('id', $id)->delete('gallery'))
{
$photo = '../'.$gallery->image;
unlink($photo);
/**
 @* Log 
**/
$title = 'Gallery Delete';
$log = '<b>'.user::inses()->name . '</b> deleted a gallery photo <b>#'.$gallery->id.'</b>';
activitylog($title,$log);
/**/
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Gallery photo <b>#'.$gallery->id.'</b> has been deleted successfully!';
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
break;
default:
{
_e(error());
}
}
?>