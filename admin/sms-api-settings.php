<?php
error_reporting(0);
	session_start();
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","sms-api-settings.php","Add SMS API Settings");
	$sms_api_row = getRowCount("select count(rec_id) from sms_api",$DatabaseCo);
	
	
	$account_id = "";
	$acc_passwrod = "";
	$base_url = "";
	$sent_title = "";
	$sms_api_status = "";
	
	$ACTION_MODE = "ADD";
	
	if($sms_api_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM sms_api";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			$account_id = $DatabaseCo->dbRow->account_id;
			$acc_passwrod = $DatabaseCo->dbRow->password;
			$base_url = $DatabaseCo->dbRow->base_url;
			$sent_title = $DatabaseCo->dbRow->sent_title;
			$sms_api_status = $DatabaseCo->dbRow->status;
			
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update SMS API Settings");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$account_id = isset($_POST['account_id'])?$_POST['account_id']:"";
		$acc_passwrod = isset($_POST['acc_passwrod'])?$_POST['acc_passwrod']:"";
		$base_url = isset($_POST['base_url'])?$_POST['base_url']:"";
		$sent_title = isset($_POST['sent_title'])?$_POST['sent_title']:"";
		$sms_api_status = isset($_POST['sms_api_status'])?$_POST['sms_api_status']:0;

		if($sms_api_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE sms_api  set account_id='".$account_id."',password='".$acc_passwrod."',base_url='".$base_url."',sent_title='".$sent_title."',status='".$sms_api_status."'";			
		}
		else
		{
			//Insert Case
			$SQL_STATEMENT = "INSERT INTO sms_api (rec_id,account_id,password,base_url,sent_title,status) values ('','".$account_id."','".$acc_passwrod."','".$base_url."','".$sent_title."','".$sms_api_status."')";			
		}
			
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$status_MESSAGE = $statusObj->getstatusMessage();
	}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | sms api settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
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
	setPageContext("sms","sms-api");
	$(document).ready(function()
	 {
	    var formId = "#sms_api_setting";
	    var rules = {
                account_id: { required: true, minlength: 5, maxlength: 200 },
                acc_passwrod: { required: true, minlength: 5, maxlength: 200 },
		base_url: { required: true, minlength: 5, maxlength: 200 },
		sent_title: { required: true, minlength: 5, maxlength: 200 },
		sms_api_status: {required: true}
            };
	    var messages = {
		cc_avenue_app_id:{required:"CC-Avenue App ID field is required."},
                account_id: {required:"Account ID field is required."},
                acc_passwrod: { required: "password field is required."},
		base_url: { required: "Base URL field is required."},
		sent_title: { required: "Sent Title field is required."},
		sms_api_status: {required: "status field is required."}
		};
            validateForm(formId,rules,messages);	
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
	<div class="breadcum-wide"><a href="#" title="Site Settings">SMS API Settings </a>/ <a href="#" title="Database Settings">SMS API Settings</a></div>
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
		}else{
			echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$status_MESSAGE."</li></ul></div>";	
		}
							
	}else{
		echo "<div class='error-msg' id='validationSummary'></div>";						
	}
?>	
<form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="sms_api_setting">
		<p class="cf">
	      <label>1. Account ID:</label>
	      <input type="text" class="input-textbox" name="account_id" id="account_id" value="<?php echo $account_id;?>" />
	      </p>
	    <p class="cf">
	      <label>2. password:</label>
	      <input type="text" class="input-textbox" name="acc_passwrod" id="password" value="<?php echo $acc_passwrod;?>"/>
				</p>
	    <p class="cf">
	      <label>3. Base URL:</label>
	      <input type="text" class="input-textbox" name="base_url" id="base_url" value="<?php echo $base_url;?>"/>
				</p>
	    <p class="cf">
	      <label>4. Sent Title:</label>
	      <input type="text" class="input-textbox" name="sent_title" id="sent_title" value="<?php echo $sent_title;?>" />
				</p>
	    <p class="cf">
	      <label>5. status:</label>
	         <input type="radio"  value="APPROVED" name="sms_api_status" id="Sms_api_status"  <?php if($sms_api_status=='APPROVED') echo "checked";?> /><span class="radio-btn-text">Active</span>
	      <input type="radio"  value="UNAPPROVED" name="sms_api_status" id="Sms_api_status"  <?php if($sms_api_status=='UNAPPROVED') echo "checked";?>/><span class="radio-btn-text">Inactive</span>
				</p>                
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
