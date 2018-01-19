<?php
	include_once 'databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.socialicon.php");
	$ob=new socialicon();
	$sid=isset($_GET['id']) ? $_GET['id'] :"" ;	
	$fetch=$ob->get_icon_by_id($sid);
	$row=mysql_fetch_array($fetch);	
		
	if(isset($_REQUEST['add_icon']))
	{	
		$name=mysql_real_escape_string($_POST['name']);
		$slink=$_POST['slink'];
		$status=$_POST['status'];
		$ob=new socialicon();
		$ob->add_icon($name,$slink,$status);		
		header("location:social_neticon.php?success=icon");		
  	}
	
	if(isset($_REQUEST['update_icon']))
	{	
		$sid=$_GET['id'];
		$name=mysql_real_escape_string($_POST['name']);
		$slink=$_POST['slink'];
		$status=$_POST['status'];
	
		$ob->update_icon($name,$slink,$status,$sid);		
		header("location:social_neticon.php?success=icon");		
  	}
		
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Social Networking</title>
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
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
	setPageContext("site-settings","social_neticon");
	$(document).ready(function()
	 {
	    var formId = "#add_icon";
	    var rules = {
                name: { required: true },
                slink: { required: true},
				status:{ required: true },
			
				
            };
	    var messages = {
				name: {required:"Iocn name is required."},
                slink: {required:"Icon link Name is required."},
				status:{required:"Status is required."},
				
		};
            validateForm(formId,rules,messages);	
	 });
	
</script>
<style type="text/css">
textarea
{
	width:400px !important;
	 height:250px !important;
}


</style>
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Site Settings</a> / <a href="#" title="Site Global Settings">Manage Social Networking</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Events" onclick="window.location='social_neticon.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Social Networking</a>
			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Social Networking</h4>
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
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_icon">
		
		
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Icon Name:</label>
	      <input type="text" class="input" size="32"  name="name" value="<?php echo $row['sname'];?>" id="name" readonly="readonly"/>
	    </p>
         <p class="cf">
	      <label><font id="star">*</font>&nbsp;Icon Link:</label>
	       <textarea  class="input"  name="slink" id="slink"/><?php echo $row['slink'];?></textarea>
	</p>
       
	
     <p class="cf"> <label><font id="star">*</font>&nbsp;Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status" <?php if($row['status']=="APPROVED"){ ?> checked="checked" <?php } ?> />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($row['status']=="UNAPPROVED"){ ?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($sid))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_icon" title="Update"/>
         <input type="hidden" name="update_icon" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_icon" title="Add"/>
          <input type="hidden" name="add_icon" value="submit" />
        <?php
		}
		?>
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
