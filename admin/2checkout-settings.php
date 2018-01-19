<?php
error_reporting(0);
	session_start();
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","2checkout-settings.php","Add 2Checkout API Settings");
	$two_check_row = getRowCount("select count(pay_id) from payment_method",$DatabaseCo);
	
	
	$merchant_id = "";
	$two_check_status = "";
	
	$ACTION_MODE = "ADD";
	
	if($two_check_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM payment_method where pay_id=3";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			
			$merchant_id = $DatabaseCo->dbRow->merchant_id;
			$check_desc = $DatabaseCo->dbRow->check_desc;
			$two_check_status = $DatabaseCo->dbRow->status;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update 2Checkout API Settings");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$merchant_id = isset($_POST['merchant_id'])?$_POST['merchant_id']:"";
		$check_desc = isset($_POST['check_desc'])?$_POST['check_desc']:"";
		$two_check_status = isset($_POST['two_check_status'])?$_POST['two_check_status']:0;
		if($two_check_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE payment_method set merchant_id='".$merchant_id."',check_desc='".$check_desc."',status='".$two_check_status."' where pay_id=3";			
		}
		else
		{
			//Insert Case
$SQL_STATEMENT = "INSERT INTO payment_method (pay_id,merchant_id,check_desc,status) values ('','".$merchant_id."','".$check_desc."','".$two_check_status."')";			
		}
			
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$status_MESSAGE = $statusObj->getstatusMessage();
	}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | 2checkout api settings</title>
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
	setPageContext("payment","twocheckout");
	$(document).ready(function()
	 {
	    var formId = "#two_check_setting";
	    var rules = {
                merchant_id: { required: true, minlength: 5, maxlength: 200 },
                check_desc: { required: true},
				two_check_status: { required: true}

            };
	    var messages = {
		merchant_id:{required:"2Checkout App ID field is required."},
		check_desc: { required: "2Checkout Description is required."},
		two_check_status: { required: "status is required field."}
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Payment Gateway </a>/ <a href="#" title="Database Settings">2Checkout API Settings</a></div>
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
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="two_check_setting">
        
         <p class="cf">
           
         <img src="img/2Checkout.png" border="0" title="2Checkout" width="650" height="150" style="margin-left:27px;">
          </p>
           <p class="cf">
            <label>&nbsp;</label>
            
          </p>
          
          <p class="cf">
            <label>1. 2Checkout Application ID:</label>
            <input type="text" class="input-textbox" name="merchant_id" id="merchant_id" value="<?php echo $merchant_id;?>" />
          </p>
          <p class="cf">
            <label>2. 2Checkout Description:</label>
            <textarea name="check_desc" id="check_desc" rows="3" cols="41"><?php echo $check_desc;?></textarea>
          
          </p>
          <p class="cf">
            <label>3. status:</label>
            <input type="radio"  value="APPROVED" name="two_check_status" id="Two_Check_status"  <?php if($two_check_status=="APPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="two_check_status" id="Two_Check_status"  <?php if($two_check_status=="UNAPPROVED") echo "checked";?>/>
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
