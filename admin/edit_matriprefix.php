<?php
session_start();
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
			
	if(isset($_REQUEST['prefix']))
	{
		$mid=$_POST['mid'];
		
		$up="update register set prefix='$mid'"; 
		$o=mysql_query($up);
		$STATUS_MESSAGE='Changes have been done.';
		$save=$STATUS_MESSAGE;		
	}
	
	$result=mysql_query("select * from register");	
	$res1=mysql_fetch_array($result);
	
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | site-settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>

<script type="text/javascript">
	setPageContext("site-settings","matri-prefix");
	$(document).ready(function()
	 {
	    var formId = "#prefix_setting";
	    var rules = {
                mid: { required: true, minlength: 1, maxlength: 200 },
                
				
				
            };
	    var messages = {
				mid: {required:"Matrimony Prefix is required."},
               
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
	
	<h4>Edit Matrimony Id Prefix</h4>
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
	<form action="" method="POST" class="form-data" id="prefix_setting">
		<p class="cf">
	      <label> MatriId Prefix:</label>
	      <input type="text" class="input-textbox" name="mid" value="<?php echo $res1['prefix']; ?>" id="mid" title="Matrimony Prefix"/>
	    </p>
	    
	    <p class="cf">
         <label>&nbsp;</label>
	      <input type="submit" name="prefix"  class="save-btn" value="Save" title="Save"/>
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
