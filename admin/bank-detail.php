<?php
error_reporting(0);
	session_start();
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","bank-detail.php","Add Bank Detail");
	$bank_detail_row = getRowCount("select count(REC_ID) from bank_detail",$DatabaseCo);
	
	
	$bank_detail = "";
	$bank_detail_status = "";
	
	$ACTION_MODE = "ADD";
	
	if($bank_detail_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM bank_detail";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			
			$bank_detail = $DatabaseCo->dbRow->BANK_DETAIL;
			$bank_detail_status = $DatabaseCo->dbRow->STATUS;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update Bank Detail");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$bank_detail = isset($_POST['bank_detail'])?$_POST['bank_detail']:"";
		$bank_detail_status = isset($_POST['bank_detail_status'])?$_POST['bank_detail_status']:0;
		if($bank_detail_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE bank_detail  set BANK_DETAIL=\"".htmlspecialchars($bank_detail, ENT_QUOTES)."\",STATUS='".$bank_detail_status."'";			
		}
		else
		{
			//Insert Case
$SQL_STATEMENT = "INSERT INTO bank_detail (REC_ID,BANK_DETAIL,STATUS) values ('',\"".htmlspecialchars($bank_detail, ENT_QUOTES)."\",'".$bank_detail_status."')";			
		}
			
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();
	}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Bank Detail</title>
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
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">

	setPageContext("payment","bank");
	$(document).ready(function()
	 {
	    var formId = "#bank_detail";
	    var rules = {
                $bank_detail: { required: true, minlength: 5, maxlength: 500 },
                $bank_detail_status: { required: true}

            };
	    var messages = {
		$bank_detail:{required:"Bank Detail field is required."},
		$bank_detail_status: { required: "Status is required field."}
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Payment Gateway </a>/ <a href="#" title="Database Settings">Bank Detail</a></div>
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
		}else{
			echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
		}
							
	}else{
		echo "<div class='error-msg' id='validationSummary'></div>";						
	}
?>
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="bank_detail" enctype="multipart/form-data">
                 
          <p class="cf"> <span class="tinyBox">Bank Detail:</span><br/>
            <textarea id="elm1" name="bank_detail"  ><?php echo $bank_detail;?></textarea>
          </p>
          <p class="cf"> <span class="tinyBox"> Status:</span>
            <input type="radio"  value="APPROVED" name="bank_detail_status" id="Bank_Detail_Status"  <?php if($bank_detail_status=="APPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="bank_detail_status" id="Bank_Detail_Status"  <?php if($bank_detail_status=="UNAPPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span> </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
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
