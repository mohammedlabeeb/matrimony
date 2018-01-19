<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Send","newsletter.php?action=ADD","Send Email");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$id = isset($_GET['id']) ? $_GET['id'] :"" ;
require_once("../BusinessLogic/class.config.php");
		
		$id='1';
		$ob=new siteconfig();
		
		$result=$ob->get_site_by_id($id);
		$row=mysql_fetch_array($result);

$page_name = "";
$cms_content = "";


$ACTION_MODE = "ADD";


	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new status();
		$to=implode(',',$_POST['email']);
		$statement = $_POST['cms_content'];
		$content= str_ireplace("'", "\'", $statement);
		$from = $row['contact_email'];
		$subject=$_POST['subject'];

	
		$status_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
				
				$message = "
	    <html>
		<style type='text/css'>
		.green_text
		{
			font-family:Lucida Sans, Arial;
			font-size:14px;
			font-weight:900;
			color:#00AEEF;
		}
		
		</style>
	    <body>		
		<table width='100%' style='border:double 5px #00AEEF;' cellspacing='20px'>
	    <tr>
        <td>
            <table width='100%' height='auto' border='0'>
                
				
                <tr>
                	<td  class='green_text' style='font-size:20px; text-decoration:underline; color:#00AEEF;font-family:Lucida Sans, Arial;' colspan='2'>
                    	$subject
                    </td>
                </tr>
				
			     <tr>
                	<td style='padding-top:10px; line-height:25px; font-family:Lucida Sans, Arial;font-size:14px;font-weight:900;' align='justify' colspan='2'>
             
			              <table border='0' width='100%'>
						  <tr>
						  <td>Hello Dear</td>
						  </tr>
						  <tr>
						  <td>$content</td>
						  </tr>
						 
						 
						  </table> 
                </td>
                </tr>
                               
            </table>
        </td>
    </tr>
</table>	
		</body>
		</html>
		";
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
		$headers .= "BCC: " . $to . "\r\n";
		
		
		mail('hello@gmail.com',$subject, $message, $headers); 
								
				
	
				break;
		
				
		}
	
		 
		 
		 $STATUS_MESSAGE='Email Sent Succssfully...';
		 $save=$STATUS_MESSAGE;
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Email to Members</title>
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
<script type="text/javascript">
setPageContext("member_report","send-email");

	$(document).ready(function()
	 {
	    var formId = "#add_newsletter";
	    var rules = {
               
                email : { required: true, email:true},
				subject : { required: true, minlength: 5, maxlength: 1000 },
				cms_content:{ required: true, minlength: 5, maxlength: 15000 },
				visibility: { required: true}
				
				
				
            };
	    var messages = {
				
                email : { required:"Email is required.", email :"Please Insert valid Email"},
				subject:{ required:"Subject is required."},
				cms_content:{required:"Content is required."},
				visibility: { required: "Page status field is required."}
				
	
		};
            validateForm(formId,rules,messages);	
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
      <div class="breadcum-wide"><a href="#" title="Newsletter">Newsletter</a> / <a href="#" title="Send Newsletter">Send Newsletter</a></div>
      <div class="listing-section">
        <div class="member-list cf">
         
          <a href="javascript:;" class="button" title="Add New Page"  onclick="window.location='newsletter.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Send Newsletter</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
       <?php
					if(!empty($STATUS_MESSAGE))
					{	
						if($save)
						{
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else
						{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>	
        <form action="<?php echo $pageSetting->getFormAction();?>"   method="post" class="form-data" id="add_newsletter" enctype="multipart/form-data"  >
          
          
          
          <p class="cf"> <span class="tinyBox">Send To :</span><br/>
            <select class="comboBox" id="email" name="email[]" multiple="multiple" style="width:650px;height:250px;">
		  
           <optgroup label="Paid Members"> 	
         <?php
		 $SQL_STATEMENT2 = "SELECT email,matri_id FROM register where status='Paid' order by username";
		 $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
		 while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		 { ?>
          <option value="<?php echo $DatabaseCo->dbRow->email;?>" selected="selected" style="margin-top:3px; font-size:15px;"><?php echo $DatabaseCo->dbRow->email;?> &nbsp;&nbsp; (<?php echo $DatabaseCo->dbRow->matri_id;?>)</option>
			<?php 
		 }?>
         </optgroup>
         
          <optgroup label="Active Members">
          <?php
		 $SQL_STATEMENT2 = "SELECT email,matri_id FROM register where status='Active' order by username";
		 $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
		 while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		 { ?>
          <option value="<?php echo $DatabaseCo->dbRow->email;?>" style="margin-top:3px; font-size:15px;"><?php echo $DatabaseCo->dbRow->email;?> &nbsp;&nbsp; (<?php echo $DatabaseCo->dbRow->matri_id;?>)</option>
			<?php 
		 }?>
         </optgroup>
         
          <optgroup label="Inactive Members">	
         <?php
		 $SQL_STATEMENT2 = "SELECT email,matri_id FROM register where status='Inactive' order by username";
		 $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
		 while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		 { ?>
          <option value="<?php echo $DatabaseCo->dbRow->email;?>" style="margin-top:3px; font-size:15px;"><?php echo $DatabaseCo->dbRow->email;?> &nbsp;&nbsp; (<?php echo $DatabaseCo->dbRow->matri_id;?>)</option>
			<?php 
		 }?>
         </optgroup>
          <optgroup label="Suspended Members">	
         <?php
		 $SQL_STATEMENT2 = "SELECT email,matri_id FROM register where status='Suspended' order by username";
		 $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
		 while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		 { ?>
          <option value="<?php echo $DatabaseCo->dbRow->email;?>" style="margin-top:3px; font-size:15px;"><?php echo $DatabaseCo->dbRow->email;?> &nbsp;&nbsp; (<?php echo $DatabaseCo->dbRow->matri_id;?>)</option>
			<?php 
		 }?>
         </optgroup>
         
	        </select>
         
 			           
          </p>
          
          
          <p class="cf"> <span class="tinyBox"><font id="star">*</font>&nbsp;Subject :</span><br/>
            <input type="text" name="subject" id="subject" class="input" size="128" />
          </p>
          
          
          <p class="cf"> <span class="tinyBox"><font id="star">*</font>&nbsp;Message :</span><br/>
            <textarea  name="cms_content" id="cms_content" placeholder="Add content in brief" style="height:250px;margin-left: -5px;width: 420px;" ><?php echo $content;?></textarea>
          </p>
          
          
          
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="id" value="<?php echo $id;?>" />	  
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
