<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Save","add-membership-plan.php?action=ADD","Add New Membership Plan");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$plan_id = isset($_GET['plan_id']) ? $_GET['plan_id'] :"" ;


$plan_name = "";
$plan_type = "";
$plan_amount = "";
$Plan_currency_type = "";
$plan_duration = "";
$plan_contacts = "";
$profile  ="";
$plan_msg ="";
$video ="";
$chat ="";
$plan_offers ="";
$plan_status ="";


$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM membership_plan where plan_id=".$plan_id;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		$plan_name = $DatabaseCo->dbRow->plan_name;
		$plan_type = $DatabaseCo->dbRow->plan_type;
		$plan_amount  = $DatabaseCo->dbRow->plan_amount;
		$Plan_currency_type = $DatabaseCo->dbRow->plan_amount_type;
		$plan_duration = $DatabaseCo->dbRow->plan_duration;
		$plan_contacts = $DatabaseCo->dbRow->plan_contacts;
		$profile = $DatabaseCo->dbRow->profile;
		$plan_msg = $DatabaseCo->dbRow->plan_msg;
		$video = $DatabaseCo->dbRow->video;
		$chat = $DatabaseCo->dbRow->chat;
		$plan_offers = $DatabaseCo->dbRow->plan_offers;
		$plan_status = $DatabaseCo->dbRow->status;
	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update Membership ".$plan_id);
	$pageSetting->setFormAction("add-membership-plan.php?plan_id=".$plan_id."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new status();
		$plan_name = $_POST['plan_name'];
		$plan_type = $_POST['plan_type'];
		$plan_amount = $_POST['plan_amount'];
		$Plan_currency_type = $_POST['Plan_currency_type'];
		$plan_duration = $_POST['plan_duration'];
		$plan_contacts = $_POST['plan_contacts'];
		$profile  =$_POST['profile'];
		$plan_msg =$_POST['plan_msg'];
		$video =$_POST['video'];
		$chat =$_POST['chat'];
		$plan_offers =$_POST['plan_offers'];
		$plan_status =$_POST['plan_status'];

	
		$status_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		$error_flag = false;
		$error_message = "";
		if($plan_type=="PAID")
		{
				if(empty($plan_amount))
				{
					$error_flag = true;
					$error_message .= "<li>PAID Plan must have amount<li>";
				}
				if(empty($Plan_currency_type))
				{
					$error_flag = true;
					$error_message .= "<li>PAID Plan must Amount Currenct Type<li>";
				}				
		}	
		
		if(!$error_flag)
		{
			switch($ACTION_MODE)
			{
			case 'ADD':
				
                $SQL_STATEMENT = "insert into membership_plan (plan_name,plan_type,plan_amount,plan_amount_type,plan_duration,plan_contacts,profile,plan_msg,video,chat,plan_offers,status) values ('$plan_name','$plan_type','$plan_amount','$Plan_currency_type','$plan_duration','$plan_contacts','$profile','$plan_msg','$video','$chat','$plan_offers','$plan_status')";
				
				
	
				break;
			case 'UPDATE':
				$plan_id = $_POST['plan_id'];
				$SQL_STATEMENT = "update membership_plan set plan_name='$plan_name',plan_type='$plan_type',plan_amount='$plan_amount',plan_amount_type='$Plan_currency_type',plan_duration='$plan_duration',plan_contacts='$plan_contacts',profile='$profile',plan_msg='$plan_msg',video='$video',chat='$chat',plan_offers='$plan_offers',status='$plan_status' where plan_id='$plan_id'"; 

				break;
				
			}
		
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $status_MESSAGE = $statusObj->getstatusMessage();
		}
		else
		{
			$statusObj = new status();
		 	$statusObj->setActionSuccess(false);
		 	$status_MESSAGE = $error_message;
		}
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Add membership plan</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
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
	setPageContext("membership","membership-plan");
	$(document).ready(function()
	 {
	    var formId = "#add_membership";
	    var rules = {
		plan_name : { required: true, minlength: 2, maxlength: 100 },
		plan_type : { required: true},
		plan_duration : { required: true },
		plan_contacts : { required: true },
		profile : { required: true },
		plan_msg : { required: true },
		video : { required: true},
		chat : { required: true},
		plan_status : { required: true},
            };
	    var messages = {
		plan_name : { required:"Plan Name is required."},
		plan_type : { required:"Plan Type is required."},
		plan_duration : { required:"Plan Duration is required."},
		plan_contacts : { required: "No of Allow Contacts is required." },
		profile : { required: "No of Allow Profiles view is required." },
		plan_msg : { required: "No of Allow Messages is required." },
		video : { required: "Video upload detail is required."},
		chat : { required:"Chat detail is required."},
		plan_status :{ required:"plan status is required."},
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
      <div class="breadcum-wide"><a href="#" title="User">Membership Plan</a> / <a href="#" title="Role">Add New Membership Plan</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Membership Plan"  onclick="window.location='membership-plan.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Membership Plan</a>
          <a href="javascript:;"   class="button"  title="Add New Membership Plan"  onclick="window.location='add-membership-plan.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Membership Plan</a>
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
	
       
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="add_membership">
          <p class="cf">
            <label>1. Plan Name:</label>
	    <input type="text" class="input-textbox" name="plan_name" id="plan_name" value="<?php echo $plan_name;?>"/>
            
          </p>
          <p class="cf">
            <label>2. Plan Type:</label>
	    
	     <select  class="comboBox" name="plan_type" id="plan_type">
              <option value="">Select Plan Type</option>
	      <option value="FREE" <?php if($plan_type=="FREE") echo "SELECTED";?>>Free</option>
              <option value="PAID" <?php if($plan_type=="PAID") echo "SELECTED";?>>Paid</option>
            </select>
	    
            
          </p>
          <p class="cf">
            <label>3. Plan Amount:</label>
            <input type="text" class="textBox" name="plan_amount" id="plan_amount" value="<?php echo $plan_amount;?>" onkeypress='return isNumberKey(event);'/>
          </p>
          <p class="cf">
            <label>4. Plan Amount-Currency-Type:</label>
	    
	    <select  class="comboBox" name="Plan_currency_type" id="Plan_currancy_Type">
              <option value="">Select Currency Type</option>
	      <option value="$" <?php if($Plan_currency_type=="$") echo "SELECTED";?>>US-Dollar</option>
              <option value="Rs" <?php if($Plan_currency_type=="Rs") echo "SELECTED";?>>Indian-Rupee</option>
            </select>
	    
            
          </p>
          <p class="cf">
            <label>5. Plan Duration:</label>
	    <input type="text" class="textBox" name="plan_duration" id="plan_duration" value="<?php echo $plan_duration;?>" onkeypress='return isNumberKey(event);'/>&nbsp;Days
           
          </p>
         
          <p class="cf">
            <label>6. Allow Contacts:</label>
	    
	    <input type="text" class="textBox" name="plan_contacts" id="plan_contacts" value="<?php echo $plan_contacts;?>" onkeypress='return isNumberKey(event);'/>
	    
	    
	     </p>
          <p class="cf">
            <label>7. Allow Profile:</label>
	    
	    <input type="text" class="textBox" name="profile" id="profile" value="<?php echo $profile;?>" onkeypress='return isNumberKey(event);'/>
	    
	    
           </p>
 <p class="cf">
            <label>8. Allow Messages:</label>
	    
	    <input type="text" class="textBox" name="plan_msg" id="plan_msg" value="<?php echo $plan_msg;?>" onkeypress='return isNumberKey(event);'/>
	    
	    
           </p>	  
          <p class="cf">
            <label>9. Video Upload:</label>
	   <input type="radio"  value="Yes" name="video" id="video"  <?php if($video=='Yes') echo "checked";?>/>
            <span class="radio-btn-text">Yes</span>
            <input type="radio"  value="No" name="video" id="video"  <?php if($video=='No') echo "checked";?>/>
            <span class="radio-btn-text">No</span>
          </p>

          <p class="cf">
            <label>10. Chat:</label>
	    	<input type="radio"  value="Yes" name="chat" id="chat"  <?php if($chat=='Yes') echo "checked";?>/>
            <span class="radio-btn-text">Yes</span>
            <input type="radio"  value="No" name="chat" id="chat"  <?php if($chat=='No') echo "checked";?>/>
            <span class="radio-btn-text">No</span>
           
          </p>
           </p>
 <p class="cf">
            <label>11. Plan Offers:</label>
	    
	    <input type="text" class="input-textbox" name="plan_offers" id="plan_offers" value="<?php echo $plan_offers;?>" />
	    
	    
           </p>
         
                   <p class="cf"> <label>12. status:</label>
            <input type="radio"  value="APPROVED" name="plan_status" id="plan_status"  <?php if($plan_status=='APPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="plan_status" id="plan_status"  <?php if($plan_status=='UNAPPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span> </p>	  	  
	  <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="plan_id" value="<?php echo $plan_id;?>" />	 
	  
          
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
