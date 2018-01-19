<?php	
	session_start();
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.adminuser.php");
	$username='admin1';
	
	
	if(isset($_REQUEST['change_password']))
	{
		$pswd = trim(md5($_POST['oldpswd']));
		$newpswd = trim(md5($_POST['newpswd']));		
		$sql = "SELECT * FROM admin_users";
		$qsql=mysql_query($sql) or die(mysql_error());
		$fet=mysql_fetch_array($qsql);
		if($pswd==$fet['pswd'])
		{ 		
			$sql="UPDATE admin_users SET pswd='$newpswd' where pswd='$pswd'";
			mysql_query($sql) or die(mysql_error());
			$STATUS_MESSAGE="Your Password Has Been Changed.";
			$save=$STATUS_MESSAGE;		
		}
		else
		{
			$STATUS_MESSAGE="Please Enter Correct Old Password.";	
		}
		
	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | site-settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>

<script type="text/javascript">
	setPageContext("site-settings","change-password");
	$(document).ready(function()
	 {
	    var formId = "#change_password";
	    var rules = {
                oldpswd: { required: true, minlength: 5, maxlength: 200 },
                newpswd: { required: true, minlength: 5, maxlength: 100 },
				conpswd: { required: true, equalTo: "#newpswd", minlength: 5, maxlength: 100 },		
				
            };
	    var messages = {
				oldpswd: {required:"Old Password is required."},
                newpswd: {required:"New Password is required."},
				conpswd: {required:"Confirm Password is required.",equalTo:"Please enter the same password"},
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
	<div class="breadcum-wide"><a href="#" title="Site Settings">Site Settings </a>/ <a href="#" title="Site Global Settings">Site Global Settings</a></div>
    <div class="widecolumn-inner">
	
	<h4>Change Password</h4>
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
						echo "<div class='error-msg' id='validationSummary'>
						<h4>".$STATUS_MESSAGE."</h4></div>";						
					}
				?>	
	<form action=""  method="post" class="form-data" id="change_password">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Old Password:</label>
<input type="password" class="input-textbox" name="oldpswd" id="oldpswd" title="old password"/>
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;New Password:</label>
	      <input type="password" class="input-textbox"  name="newpswd" id="newpswd"/>
	    </p>
	  
	   
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Confirm Password:</label>
	      <input type="password" class="input-textbox" name="conpswd" id="conpswd"/>
	    </p>
	
   
    
	    <p class="submit-btn cf">
	      <input type="submit"  class="save-btn" value="Submit" name="change_password" title="Change Password"/>
          <input type="hidden" name="change_password" value="submit" />
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
