<?php
error_reporting(0);
	session_start();
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","cc-avenue-settings.php","Add CC-Avenue API Settings");
	$payment_method_row = getRowCount("select count(pay_id) from payment_method",$DatabaseCo);
	
	
	$merchant_id = "";
	$status = "";
	
	$ACTION_MODE = "ADD";
	
	if($payment_method_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM payment_method where pay_id=2";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			
			$merchant_id = $DatabaseCo->dbRow->merchant_id;
			$status = $DatabaseCo->dbRow->status;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update CC-Avenue API Settings");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$merchant_id = isset($_POST['merchant_id'])?$_POST['merchant_id']:"";
		$status = isset($_POST['status'])?$_POST['status']:0;
		if($payment_method_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE payment_method set merchant_id='".$merchant_id."',status='".$status."' where pay_id=2";			
		}
		else
		{
			//Insert Case
$SQL_STATEMENT = "INSERT INTO payment_method (pay_id,merchant_id,status) values ('','".$merchant_id."','".$status."')";			
		}
			
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$status_MESSAGE = $statusObj->getstatusMessage();
	}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | ccavenue api settings</title>
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
	setPageContext("payment","cc-avenue");
	$(document).ready(function()
	 {
	    var formId = "#payment_method_setting";
	    var rules = {
                merchant_id: { required: true, minlength: 5, maxlength: 200 },
                status: { required: true}

            };
	    var messages = {
		merchant_id:{required:"CC-Avenue App ID field is required."},
		status: { required: "status is required field."}
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Payment Gateway </a>/ <a href="#" title="Database Settings">CC Avenue API Settings</a></div>
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
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="payment_method_setting">
         <p class="cf">
           
         <img src="img/ccavenue.jpg" border="0" title="2Checkout" width="650" height="120" style="margin-left:27px;">
          </p>
           <p class="cf">
            <label>&nbsp;</label>
            
          </p>
          <p class="cf">
            <label>1. CC Avenue Application ID:</label>
            <input type="text" class="input-textbox" name="merchant_id" id="merchant_id" value="<?php echo $merchant_id;?>"/>
          </p>
          <p class="cf">
            <label>2. status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status"  <?php if($status=="APPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
<input type="radio"  value="UNAPPROVED" name="status" id="status"  <?php if($status=="UNAPPROVED") echo "checked";?>/>
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
