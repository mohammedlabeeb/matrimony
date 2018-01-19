<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
include_once './class/SiteSetting.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Save","add-transactions.php?action=ADD","Add New Transaction");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$TRANSACTION_ID = isset($_GET['transaction_id']) ? $_GET['transaction_id'] :"" ;

$from = "";
$transaction_date = "";
$trans_amount = "";
$trans_amount_type = "";
$trans_purpose = "";
$transaction_status ="";
$payment_mode = "";

$sitesettingObj = new SiteSetting();

$transRealID = $sitesettingObj->getDbRecPrefix()."-Txn-";
$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM transactions where TRANSACTION_ID=".$TRANSACTION_ID;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		$from = $DatabaseCo->dbRow->TRANS_FROM;
		$transaction_date = $DatabaseCo->dbRow->TRANSACTION_DATE;
		$trans_amount = $DatabaseCo->dbRow->TRANSACTION_AMOUNT;
		$trans_amount_type = $DatabaseCo->dbRow->TRANSACTION_AMOUNT_TYPE;
		$trans_purpose = $DatabaseCo->dbRow->TRANSACTION_PURPOSE;
		$transaction_status = $DatabaseCo->dbRow->STATUS;
		$payment_mode = $DatabaseCo->dbRow->PAYMENT_MODE;
	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update Transaction ".$TRANSACTION_ID);
	$pageSetting->setFormAction("add-transactions.php?transaction_id=".$TRANSACTION_ID."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new Status();

		$from = $_POST['from'];
		$real_id_arr = explode("-",$from);
		$owner_id = $real_id_arr[2];		
		
		$transaction_date = $_POST['transaction_date'];
		$trans_amount = $_POST['trans_amount'];
		$trans_amount_type = $_POST['trans_amount_type'];
		$trans_purpose = $_POST['trans_purpose'];
		$transaction_status =$_POST['transaction_status'];
		$payment_mode = $_POST['payment_mode'];

	
		$STATUS_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
				$SQL_STATEMENT = "call addTransaction('".$transRealID."','".$from."',".$owner_id.",'".$transaction_date."',".$trans_amount.",'".$trans_amount_type."','".$payment_mode."',\"".htmlspecialchars($trans_purpose, ENT_QUOTES)."\",'".$transaction_status."')";

	
				break;
			case 'UPDATE':
				$transaction_id = $_POST['transaction_id'];
				$SQL_STATEMENT = "call updateTransaction(".$transaction_id.",'".$from."',".$owner_id.",'".$transaction_date."',".$trans_amount.",'".$trans_amount_type."','".$payment_mode."',\"".htmlspecialchars($trans_purpose, ENT_QUOTES)."\",'".$transaction_status."')";

				break;
				
		}
			
		
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $STATUS_MESSAGE = $statusObj->getStatusMessage();
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | add transaction</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
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
	setPageContext("trans","trans-list");
	$(document).ready(function()
	 {
	    var formId = "#add_transaction";
	    var rules = {
                from: { required: true, minlength: 5, maxlength: 100 },
                transaction_date: { required: true, minlength: 5, maxlength: 200 },
		trans_amount: { required: true, minlength: 1, maxlength: 300 },
		trans_amount_type: { required: true},
		trans_purpose: { required: true, minlength: 5, maxlength: 500 },
		payment_mode:{ required: true},
		transaction_status: { required: true}
            };
	    var messages = {
                from: { required:"From field is required."},
                transaction_date: { required: "Transaction Date is required."},
		trans_amount: { required: "Transaction Amount is required."},
		trans_amount_type: { required: "Transaction Amount Type is required."},
		trans_purpose: { required: "Transaction purpose is required."},
		payment_mode:{ required: "Paymengt Mode is required."},
		transaction_status: { required: "Transaction Status is required."}
		};
            validateForm(formId,rules,messages);

		$("#Transaction_Date" ).datepicker({
		dateFormat:"yy-mm-dd",
		showOn: "button",
		buttonImage: "img/calendar.gif",
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true
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
      <div class="breadcum-wide"><a href="#" title="User">Transaction</a> / <a href="#" title="Role">Add  Transaction</a></div>
      <div class="listing-section">
        <div class="member-list cf">
<a href="javascript:;" class="button"  title="List All Transaction" onclick="window.location='transaction-list.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Transaction</a>
<a href="javascript:;"  class="button" title="Add New Transaction" onclick="window.location='add-transactions.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Add Transaction</a>		
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
        <form action="<?php echo $pageSetting->getFormAction();?>"   method="post" class="form-data" id="add_transaction"  >
          <p class="cf">
            <label>1. From (User ID):</label>
            <input type="text" class="input-textbox" name="from" id="From" value="<?php echo $from;?>"/>
          </p>
          <p class="cf">
            <label>2. Transaction Date:</label>
            <input type="text" class="textBox"  name="transaction_date" id="Transaction_Date" value="<?php echo $transaction_date;?>" />
          </p>	  
          <p class="cf">
            <label>3. Transaction Amount:</label>
            <input type="text" class="textBox"  name="trans_amount" id="Transaction_Amount" value="<?php echo $trans_amount;?>"/>
            &nbsp;&nbsp;
            <select  class="comboBox" name="trans_amount_type" id="Transaction_Amount_Type">
              <option value=""></option>
	      <option value="$" <?php if($trans_amount_type=="$") echo "SELECTED";?>>US-Dollar</option>
              <option value="Rs" <?php if($trans_amount_type=="Rs") echo "SELECTED";?>>Indian-Rupee</option>
            </select>
          </p>
          <p class="cf">
            <label>4. Payment Mode:</label>
            <input type="radio"  value="Paypal" name="payment_mode" id="Payment_mode1"  <?php if($payment_mode=="Paypal") echo "checked";?>/>
            <span class="radio-btn-text">Paypal</span>
            <input type="radio"  value="2Checkout" name="payment_mode" id="Payment_mode1"  <?php if($payment_mode=="2Checkout") echo "checked";?>/>
            <span class="radio-btn-text">2Checkout</span>
            <input type="radio"  value="CC-Avenue" name="payment_mode" id="Payment_mode1"  <?php if($payment_mode=="CC-Avenue") echo "checked";?>/>
            <span class="radio-btn-text">CC-Avenue</span>
            <input type="radio"  value="Bank" name="payment_mode" id="Payment_mode1"  <?php if($payment_mode=="Bank") echo "checked";?>/>
            <span class="radio-btn-text">Bank</span>	    
          </p>	  
          <p class="cf">
            <label>5. Transaction Purpose:</label>
            <textarea class="text-area" cols="50" rows="3" name="trans_purpose" id="Transaction_Purpose" ><?php echo $trans_purpose;?></textarea>
          </p>
        <p class="cf"> <label> 6. Status:</label>
            <input type="radio"  value="APPROVED" name="transaction_status" id="Transaction_Status"  <?php if($transaction_status=="APPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="transaction_status" id="Transaction_Status"  <?php if($transaction_status=="UNAPPROVED") echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span>
	</p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="transaction_id" value="<?php echo $TRANSACTION_ID;?>" />	  
          
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
