<?php

include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Save","add-email-template.php?action=ADD","Add New EMAIL Template");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$EMAIL_TEMPLATE_ID = isset($_GET['email_template_id']) ? $_GET['email_template_id'] :"" ;

$email_template_name = "";
$precondition = "";
$email_subject = "";
$email_body = "";
$email_status = "";

$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM email_templates where EMAIL_TEMPLATE_ID=".$EMAIL_TEMPLATE_ID;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		$email_template_name = $DatabaseCo->dbRow->EMAIL_TEMPLATE_NAME;
		$precondition = $DatabaseCo->dbRow->PRE_CONDITION;
		$email_subject = $DatabaseCo->dbRow->EMAIL_SUBJECT;
		$email_body = $DatabaseCo->dbRow->EMAIL_CONTENT;
		$email_status = $DatabaseCo->dbRow->STATUS;

	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update EMAIL Template".$EMAIL_TEMPLATE_ID);
	$pageSetting->setFormAction("add-email-template.php?email_template_id=".$EMAIL_TEMPLATE_ID."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new Status();

		$email_template_name = $_POST['email_template_name'];
		$precondition = $_POST['precondition'];
		$email_subject = $_POST['email_subject'];
		$email_body = $_POST['email_body'];
		$email_status = $_POST['email_status'];

	
		$STATUS_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
				$SQL_STATEMENT = "INSERT into email_templates  (EMAIL_TEMPLATE_ID,EMAIL_TEMPLATE_NAME,PRE_CONDITION,EMAIL_SUBJECT,EMAIL_CONTENT,STATUS) values ('','".$email_template_name."','".$precondition."','".$email_subject."',\"".htmlspecialchars($email_body, ENT_QUOTES)."\",'".$email_status."')";

	
				break;
			case 'UPDATE':
				$email_template_id = $_POST['email_template_id'];
				$SQL_STATEMENT =  "UPDATE email_templates  set EMAIL_TEMPLATE_NAME='".$email_template_name."',PRE_CONDITION='".$precondition."',EMAIL_SUBJECT='".$email_subject."',EMAIL_CONTENT=\"".htmlspecialchars($email_body, ENT_QUOTES)."\",STATUS='".$email_status."' WHERE EMAIL_TEMPLATE_ID=".$email_template_id;	
				break;
				
		}
	
		
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $STATUS_MESSAGE = $statusObj->getStatusMessage();
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | add email template</title>
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
	setPageContext("email-templates","email-mgmt");
	$(document).ready(function()
	 {
	    var formId = "#add_email_template";
	    var rules = {
                email_template_name: { required: true, minlength: 5, maxlength: 200 },
                precondition: { required: true, minlength: 1, maxlength: 200 },
		email_subject: { required: true, minlength: 5, maxlength: 300 },
		email_body: { required: true, minlength: 5, maxlength: 500 },
		email_status: { required: true}
            };
	    var messages = {
                email_template_name: { required: "EMAIL Template Name field is required." },
                precondition: { required: "Precondition field is required."},
		email_subject: { required: "EMAIL Subject field is required."},
		email_body: { required: "EMAIL Body field is required."},
		email_status: { required: "EMAIL Statu field is required."}
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
      <div class="breadcum-wide"><a href="#" title="User">Email Templates</a> / <a href="#" title="Role">Add  New Email Template</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="List All Email Temapltes" onclick="window.location='email-templates.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Email templates</a>
          <a href="javascript:;" class="button" title="Add New Email Temaplte" onclick="window.location='add-email-template.php'"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Email Template</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
        <?php
					if(!empty($STATUS_MESSAGE))
					{	
						if($statusObj->getActionSuccess()){
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>
        <form action="<?php echo $pageSetting->getFormAction();?>"  method="post" class="form-data" id="add_email_template"  >
          <p class="cf"> <span class="tinyBox">Template Name:</span><br/>
            <input type="text" class="input-textbox" name="email_template_name" id="Email_Template_Name" value="<?php echo $email_template_name;?>" <?php if($ACTION=='UPDATE'){?> readonly="readonly"  <?php }?>/>
          </p>
          <p class="cf"> <span class="tinyBox">Pre Conditions:</span><br/>
            <select name="precondition" class="comboBox" id="Precondition">
              <option value="">Please Select Pre Conditions</option>
              <option value="REGISTRATION" <?php if($precondition=="REGISTRATION") echo "SELECTED";?>>Registration</option>
              <option value="MEMBER_ACTION" <?php if($precondition=="MEMBER_ACTION") echo "SELECTED";?>>Member Action</option>
             
            </select>
          </p>
          <p class="cf"> <span class="tinyBox">EMAIL Subject:</span><br/>
            <input type="text" class="input-textbox"  name="email_subject" id="EMAIL_Subject" value="<?php echo $email_subject;?>"/>
          </p>
          <p class="cf"> <span class="tinyBox">Email Body:</span>
	     <textarea   name="email_body" id="elm1" ><?php echo $email_body;?></textarea>
          </p>
          <p class="cf"> <span class="tinyBox">Status:</span><br/>
            <input type="radio"  value="APPROVED" name="email_status" id="EMAIL_Status"  <?php if($email_status=='APPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="email_status" id="EMAIL_Status"  <?php if($email_status=='UNAPPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span>
	  </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="email_template_id" value="<?php echo $EMAIL_TEMPLATE_ID;?>" />	  
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
