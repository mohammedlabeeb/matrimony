<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Save","add-cms-page.php?action=ADD","Add New CMS Page");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$cms_id = isset($_GET['cms_id']) ? $_GET['cms_id'] :"" ;

$page_name = "";
$cms_title = "";
$cms_content = "";
$visibility ="";

$roleRealID = "Real-";
$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM cms_pages where cms_id=".$cms_id;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		
		$page_name = $DatabaseCo->dbRow->page_name;
		$cms_title = $DatabaseCo->dbRow->cms_title;
		$cms_content = $DatabaseCo->dbRow->cms_content;
		$visibility =$DatabaseCo->dbRow->status;

	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update CMS Page ".$cms_id);
	$pageSetting->setFormAction("add-cms-page.php?cms_id=".$cms_id."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new status();

		$page_name = $_POST['page_name'];
		$cms_title = $_POST['cms_title'];
		$cms_content = $_POST['cms_content'];
		$visibility = $_POST['visibility'];

	
		$status_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
				$SQL_STATEMENT = "INSERT into cms_pages (cms_id,page_name,cms_title,cms_content,status) values ('','".$page_name."',\"".htmlspecialchars($cms_title, ENT_QUOTES)."\",\"".htmlspecialchars($cms_content, ENT_QUOTES)."\",'".$visibility."')";

	
				break;
			case 'UPDATE':
				$cms_id = $_POST['cms_id'];
				$SQL_STATEMENT =  "UPDATE cms_pages  set page_name='".$page_name."',cms_title=\"".htmlspecialchars($cms_title, ENT_QUOTES)."\",cms_content=\"".htmlspecialchars($cms_content, ENT_QUOTES)."\",status='".$visibility."'  WHERE cms_id=".$cms_id;	
				break;
				
		}
	
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $status_MESSAGE = $statusObj->getstatusMessage();
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | add new cms Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
setPageContext("cms","cms-page");
	$(document).ready(function()
	 {
	    var formId = "#add_cms_page";
	    var rules = {
                page_name: { required: true, minlength: 5, maxlength: 100 },
                cms_title: { required: true, minlength: 5, maxlength: 200 },
		visibility: { required: true}
            };
	    var messages = {
                page_name: { required: "page Name field is required." },
                cms_title: { required: "Page Title field is required." },
		visibility: { required: "Page status field is required."}
		};
            validateForm(formId,rules,messages);
	tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	width: "300px",
	height: "350px",
	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example word content CSS (should be your site CSS) this one removes paragraph margins
	content_css : "css/word.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js",

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
	});	    
});

</script>
</head>
<body>
<div id="wrapper">
  <?php
	require_once('./page-part/header.php');
?>
  <!-- start content -->
  <div id="container" class="cf">
    <?php
	require_once('./page-part/left-menu.php');
?>
    <div class="widecolumn alignleft">
      <div class="breadcum-wide"><a href="#" title="User">CMS</a> / <a href="#" title="Role">Add  New Page</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="List All Cms Pages"  onclick="window.location='cms-page-list.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All CMS Pages</a>
          <a href="javascript:;" class="button" title="Add New Cms Pages"  onclick="window.location='add-cms-page.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Page</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
        <?php
					if(!empty($status_MESSAGE))
					{	
						if($statusObj->getActionSuccess()){
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$status_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$status_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>
        <form action="<?php echo $pageSetting->getFormAction();?>"   method="post" class="form-data" id="add_cms_page"  >
          <p class="cf"> <span class="tinyBox">Page Name:</span><br/>
            <input type="text" class="input-textbox" name="page_name" id="page_name" value="<?php echo $page_name;?>"/>
          </p>
          <p class="cf"> <span class="tinyBox">Page Title:</span><br/>
            <input type="text" class="input-textbox" name="cms_title" id="cms_title" value="<?php echo $cms_title;?>"/>
          </p>
          <p class="cf"> <span class="tinyBox">Page Content:</span>
            <textarea id="elm1" name="cms_content" id="cms_content" ><?php echo $cms_content;?></textarea>
          </p>
                   <p class="cf"> <span class="tinyBox"> status:</span>
            <input type="radio"  value="APPROVED" name="visibility" id="Page_status"  <?php if($visibility=="APPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="visibility" id="Page_status"  <?php if($visibility=="UNAPPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span> </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="cms_id" value="<?php echo $cms_id;?>" />	  
        </form>
      </div>
      <?php
	require_once('./page-part/footer.php');
?>
    </div>
  </div>
  <!-- end content --> 
</div>
</body>
</html>
