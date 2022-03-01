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
isset($_GET['action']) ? $action = hyphenonly($_GET['action']) : $action=NULL;

switch($action)
{
case 'add-notice':
{
$head = Array(
'title' => 'Dashboard',
'page' => 'add-notice'
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-notice/"><button type="button" class="btn btn-primary btn-xs">Add Notice</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-primary btn-xs">Manage Notice</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;

switch($process)
{
case 1:
{
/** Values **/
isset($_POST['title']) ? $title= $_POST['title'] : $title=null;
isset($_POST['message']) ? $message= $_POST['message'] : $message=null;
isset($_POST['category']) ? $category= $_POST['category'] : $category=null;
isset($_POST['slug']) ? $slug= hyphenonly($_POST['slug']) : $slug=null;
isset($_FILES['image']) ? $images= $_FILES['image'] : $images=null;
isset($_POST['uplaodfile']) ? $uplaodfile= $_POST['uplaodfile'] : $uplaodfile=null;
$exists = $db->where ('title',$title)->has ('notice');
/** Values **/
if (strlen($title)<10)
{
echo '<div class="alert alert-danger text-center">';
echo 'Notice title should at least 10 characters!';
echo '</div>';
}
else if (strlen($message)<10)
{
echo '<div class="alert alert-danger text-center">';
echo 'Notice description should at least 10 characters!';
echo '</div>';
}
else if ($exists)
{
echo '<div class="alert alert-danger text-center">';
echo 'A notice already exists with same name!';
echo '</div>';
}
else
{
if(isset($_FILES['image'])) {
$origname = $_FILES['image']['name'];
$beforedir = '../';
$dir = "images/notice";
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
$uplaodfile = strtolower($validname.'_'.uniqid().'.'.$extension);
}
else
{
$uplaodfile = strtolower($validname.'.'.$extension);
}

$uploader = new ImageUploader($_FILES['image'],$beforedir.$dir.'/',$uplaodfile,300,300);
$uploader->upload();
$ok = $uploader->getInfo();
if(!empty($ok))
{
$image = '/'.$dir . '/' . $uplaodfile;
$info= $uploader->getInfo();
}
else
{
$image = '';
$info= $uploader->getError();
}

}
else
{
$image = '';
}
/** File **/
if(isset($_FILES['file'])) {
$origname = $_FILES['file']['name'];
$ext = explode(".", $origname);
$extension = end($ext);
$validname = validtext($ext[0]);
$uplaodfile = validtext($ext[0]).'.'.$extension;

$support = array('zip','rar','pdf','jpg','png','jpeg');
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
$basedir = 'images/notice/files';
$backdir = '../';
$dir = $backdir.$basedir;
if (file_exists($dir.'/'.$uplaodfile))
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
if(move_uploaded_file($_FILES['file']['tmp_name'],$dir.'/'.$uplaodfile))
{
$file = '/'.$basedir . '/' . $uplaodfile;

if(file_exists($backdir.settings('logo'))){unlink($backdir.settings('logo'));}

}
}

$data = Array (
    'title' => $title,
    'uid' => user::inses()->id,
    'description' => $message,
    'image' => $image,
    'file' => $file,
    'time' => $db->now()
);
$query = $db->insert ('notice', $data);
if ($query)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Notice has been added successfully!';
echo '</div>';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}

}
break;
default:
{
?>
                <div class="x_content animated fadeIn">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<form method="post" enctype="multipart/form-data" >
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Title</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="text" name="title" class="form-control" placeholder="Notice Title">
                    </div>
                  </div>
                  </div>
				  <div class="form-group">
                  <div id="phpansEditor"></div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Image <span class="badge">.jpg</span><span class="badge">.png</span><span class="badge">.gif</span><span class="badge">.jpeg</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" name="image" class="form-control">
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">File <span class="badge">.pdf</span><span class="badge">.zip</span><span class="badge">.rar</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" name="file" class="form-control">
                    </div>
                  </div>
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Add Notice</button>
					</form>
					</div>	
<?php
}

}	// Case End
?>
				
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
case 'manage-notice':
{
$head = Array(
'title' => 'Manage Notice',
'page' => 'manage-notice'
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
                <h3>Manage <small>Notice</small></h3>
              </div>

                        <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo base_url(); ?>dashboard/add-notice/"><button type="button" class="btn btn-primary btn-xs">Add Notice</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-primary btn-xs">Manage Notice</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
            </div>
            
            <div class="clearfix"></div>
	
            <div class="row animated fadeIn">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Title</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
isset($_GET['page'])?$page=numberonly($_GET['page']):$page=1;
if($page<1)$page=1;
// set page limit to 2 results per page. 20 by default
$db->pageLimit = 10;
$notices = $db->orderBy("id","Desc")->arraybuilder()->paginate("notice", $page);
$Pages = $db->totalPages;
if($page>$Pages)$page=$Pages;
foreach($notices as $notice)
{
?>
                        <tr>
                          <td>#</td>
                          <td>
                            <a href="<?php echo base_url(); ?>notice/<?php _e($notice['id']) ?>/" target="_blank"><?php _e($notice['title']) ?></a>
                            <br />
                            <small><i class="fa fa-clock-o"></i> <?php _e(date('d-m-Y h:i:s A',strtotime($notice['time']))) ?></small>
                          </td>
                          <td>
						  <a href="<?php echo base_url(); ?>notice/<?php _e($notice['id']) ?>/" target="_blank"><button type="button" class="btn btn-success btn-xs">
							Visit Notice</button></a>
                            <a href="<?php echo base_url(); ?>dashboard/notice.php?action=edit&amp;id=<?php _e($notice['id']) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a onclick="return confirm('Are you sure you want to delete this notice?');" href="<?php echo base_url(); ?>dashboard/notice.php?action=delete&amp;id=<?php _e($notice['id']) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
<?php 
}
?>
 
                      </tbody>
                    </table>
                    <!-- end project list -->
<?php if($Pages>1){	?>
<div class="row">
<ul class="pagination">
<?php
$i=1;
for($i>1;$i<=$Pages;$i++)
{
if ($page==$i){$active = ' class="active"';}else{$active='';}
?>
  <li <?php _e($active) ?>><a href="<?php echo base_url(); ?>dashboard/manage-notice/<?php _e($i) ?>/"><?php _e($i) ?></a></li>
 <?php
}
 ?>
</ul>
</div>
<?php } ?>

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
'title' => 'Edit Notice',
'page' => 'edit-notice'
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
if(!$db->where ('id',$id)->has ('notice'))
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

?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
<h1 class="title text-center"><?php _e($head['title']) ?></h1>
      <div class="x_content">
                  <div id="alerts"></div>
<div class="ln_solid"></div>
<?php
isset($_POST['process'])?$process=numberonly($_POST['process']):$process=null;
switch($process)
{
case 1:
{
	/** Values **/
isset($_POST['title']) ? $title= $_POST['title'] : $title=null;
isset($_POST['message']) ? $message= $_POST['message'] : $message=null;
isset($_POST['category']) ? $category= $_POST['category'] : $category=null;
isset($_POST['slug']) ? $slug= hyphenonly($_POST['slug']) : $slug=null;
isset($_FILES['image']) ? $images= $_FILES['image'] : $images=null;
if (strlen($title)<10)
{
echo '<div class="alert alert-danger text-center">';
echo 'Notice title should at least 10 characters!';
echo '</div>';
}
else if (strlen($message)<10)
{
echo '<div class="alert alert-danger text-center">';
echo 'Notice description should at least 10 characters!';
echo '</div>';
}
else
{
$thumbnails = '';
$file = '';
$data = Array (
    'title' => $title,
    'description' => $message,
    'image' => $thumbnails,
    'file' => $file
);
$query = $db->where('id',$id)->update ('notice', $data);
if ($query)
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Notice has been updated successfully!';
echo '</div>';
}
else
{
echo '<div class="alert alert-danger text-center">';
echo '<span class="glyphicon glyphicon-remove"></span> There is an error!' . $db->getLastError();
echo '</div>';
}

}
}
break;
default:
{
$result = $db->where ('id', $id)->ObjectBuilder()->getOne("notice");
$text =  $result->description;
$text = str_replace('\n','<br>',$text);
?>
<form method="post" enctype="multipart/form-data" >
                  <div class="form-group">
				  <div class="row">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Title</label>
                    <div class="col-md-11 col-sm-11 col-xs-12">
                      <input type="text" name="title" class="form-control" value="<?php _e($result->title) ?>" placeholder="Notice Title">
                    </div>
                  </div>
                  </div>
				  <div class="form-group">
                  <!-- phpans Editor -->
				  <div class="md-editor active" id="editor"><div class="md-header btn-toolbar"><div class="btn-group"><button class="btn-default btn-sm btn" type="button" title="Bold" tabindex="-1" id="centerText"><span class="fa fa-align-center"></span> </button><button class="btn-default btn-sm btn" type="button" title="Bold" tabindex="-1" id="boldText"><span class="fa fa-bold"></span> </button><button class="btn-default btn-sm btn" type="button" title="Italic" tabindex="-1" id="italicText"><span class="fa fa-italic"></span> </button><button class="btn-default btn-sm btn" type="button" title="Heading" tabindex="-1" id="h2Text"><span class="fa fa-header"></span> </button></div><div class="btn-group"><button class="btn-default btn-sm btn" type="button" title="URL/Link" tabindex="-1" id="urlText"><span class="fa fa-link"></span> </button><button class="btn-default btn-sm btn" type="button" title="External URL/Link" tabindex="-1" id="externalurlText"><span class="fa fa-external-link"></span> </button><button class="btn-default btn-sm btn" type="button" title="Image" tabindex="-1" id="imageText"><span class="fa fa-image"></span> </button><button class="btn-default btn-sm btn" type="button" title="Youtube" tabindex="-1" id="youtubeembedText"><span class="fa fa-youtube"></span> </button></div><div class="btn-group"><button class="btn-default btn-sm btn" type="button" title="Unordered List" tabindex="-1" id="ulText"><span class="fa fa-list"></span> </button><button class="btn-default btn-sm btn" type="button" title="Ordered List" tabindex="-1" id="liText"><span class="fa fa-list-ol"></span> </button><button class="btn-default btn-sm btn" type="button" title="Table" tabindex="-1" id="tableText"><span class="fa fa-table"></span> </button><button class="btn-default btn-sm btn" type="button" title="Table TR" tabindex="-1" id="trText"><span class="fa fa-columns"></span> </button><button class="btn-default btn-sm btn" type="button" title="Table TD" tabindex="-1" id="tdText"><span class="fa fa-bars"></span> </button><button class="btn-default btn-sm btn" type="button" title="Code" tabindex="-1" id="codeText"><span class="fa fa-code"></span> </button><button class="btn-default btn-sm btn" type="button" title="Quote" tabindex="-1" id="blockquoteText"><span class="fa fa-quote-left"></span> </button></div><div class="btn-group"><button class="btn-sm btn btn-primary" type="button" title="Preview" tabindex="-1" id="EditorPreview" title="Editor Preview"><span class="fa fa-search"></span> Preview</button></div><div class="btn-group"><button class="btn-default btn-sm btn open-modal" type="button" title="Help" tabindex="-1"id="helpEditor"><span class="fa fa-question-circle"></span> </button><button class="btn-default btn-sm btn" type="button" title="Clear" tabindex="-1"id="clear_autosave"><span class="fa fa-minus-circle"></span> </button></div><div class="md-controls"><a class="md-control md-control-fullscreen" href="#"><span class="fa fa-expand"></span></a></div></div><textarea name="message" id="inputMessage" rows="12" class="form-control"><?php echo $text; ?></textarea><div id="preview"></div><div id="helpText"></div><div class="md-footer EditorFooter"><div id="inputMessage-footer" class="markdown-editor-status"><div class="small-font">characters: <span id="totalChars">0</span>&nbsp;&nbsp;&nbsp;words: <span id="wordCount">0</span>&nbsp;&nbsp;&nbsp;<span id="save_msg">saved</span></div></div></div></div>
                  <!-- phpans Editor -->
                  </div>
				   <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Image <span class="badge">.jpg</span><span class="badge">.png</span><span class="badge">.gif</span><span class="badge">.jpeg</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" name="image" class="form-control">
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">File <span class="badge">.pdf</span><span class="badge">.zip</span><span class="badge">.rar</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" name="file" class="form-control">
                    </div>
                  </div>
				  <input type="hidden" name="process" value="1">
					<button type="submit" class="btn btn-primary">Edit Notice</button>
					</form>
<?php }
} ?>					

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
'title' => 'Delete Notice',
'page' => 'delete-notice'
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
					<li><a href="<?php echo base_url(); ?>dashboard/add-notice/"><button type="button" class="btn btn-primary btn-xs">Add Notice</button></a></li>
					<li><a href="<?php echo base_url(); ?>dashboard/manage-notice/"><button type="button" class="btn btn-primary btn-xs">Manage Notice</button></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
      <div class="x_content">
	  
<div class="ln_solid"></div>
<?php
if($db->where('id', $id)->delete('notice'))
{
echo '<div class="alert alert-success text-center">';
echo '<span class="glyphicon glyphicon-ok-circle"></span> Notice has been deleted successfully!';
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