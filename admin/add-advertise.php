<?php
	include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.advertise.php");
	$adv_id=isset($_GET['id']) ? $_GET['id'] :"" ;	
	$ob=new advertisement();
	$result=$ob->get_adv_by_id($adv_id);
	$row=mysql_fetch_array($result);
		
	if(isset($_REQUEST['add_advertise']))
	{	
		$adv_name=mysql_real_escape_string($_POST['adv_name']);
		$adv_link=$_POST['adv_link'];
		$adv_level=$_POST['adv_level'];
		$adv_img=$_FILES['adv_img']['name'];
		$contact_name=$_POST['contact_name'];
		$phone=$_POST['phone'];
		$datepicker=$_POST['datepicker'];
		$status=$_POST['status'];
				
		
		$ob=new advertisement();
		$ob->add_adv($adv_name,$adv_link,$contact_name,$adv_img,$phone,$datepicker,$status,$adv_level);
		
		move_uploaded_file($_FILES['adv_img']['tmp_name'],"../advertise/".$_FILES['adv_img']['name']);		
			
		header("location:advertise.php?success='Yes'");
  	}
	
	if(isset($_REQUEST['update_advertise']))
	{	
		$adv_id=$_GET['id'];
		$adv_name=mysql_real_escape_string($_POST['adv_name']);
		$adv_link=$_POST['adv_link'];
		$adv_level=$_POST['adv_level'];
		if(@is_uploaded_file($_FILES["adv_img"]["tmp_name"]))
		{
			copy($_FILES['adv_img']['tmp_name'],"../advertise/".$_FILES['adv_img']['name']);
			$adv_img=$_FILES['adv_img']['name'];
		}
		else
		{
			$adv_img=$row['adv_img'];
		}
		$contact_name=$_POST['contact_name'];
		$phone=$_POST['phone'];
		$datepicker=$_POST['datepicker'];
		$status=$_POST['status'];
				
		
		$ob=new advertisement();
		$ob->update_adv($adv_name,$adv_link,$contact_name,$adv_img,$phone,$datepicker,$status,$adv_id,$adv_level);
		move_uploaded_file($_FILES['adv_img']['tmp_name'],"../advertise/".$_FILES['adv_img']['name']);		
			
		header("location:advertise.php?success='Yes'");
  	}
	
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Advertisement</title>
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
	setPageContext("advertisement","advertise");
	$(document).ready(function()
	 {
	    var formId = "#add_advertise";
	    var rules = {
                adv_name: { required: true},
               	adv_link: { required: true,url:true},
				<?php
		if(empty($adv_id))
		{
		?>
				adv_img:{ required: true},
		<?php
		}
		?>
				datepicker: {required: true},
				status:{ required: true },
			
				
            };
	    var messages = {
				adv_name: {required:"Advertise Name is required."},
                adv_link: {required:"Advertise Link is required."},
			<?php	if(empty($adv_id))
		{
		?>
                adv_img:{required:"Advertise Image is required."},
		<?php
		}
		?>
				datepicker: {required:"Advertise registered date is required."},
				status:{required:"Advertise status is required."},
				
		};
            validateForm(formId,rules,messages);	
	 });
	
</script>
<link rel="stylesheet" href="../css/jquery.ui.theme.css">
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.datepicker.js"></script>
 <script>
$(function() {
$( "#datepicker" ).datepicker({
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
      <div class="breadcum-wide"><a href="#" title="Add New Advertisement">Add New Advertisement</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Advertisement" onclick="window.location='advertise.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Advertisement</a>
	  <a href="javascript:;" title="Add New Advertisement" onclick="window.location='add-advertise.php'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Advertisement</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Advertisement</h4>
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
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_advertise">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Advertise Name:</label>
<input type="text" class="input" name="adv_name" value="<?php echo $row['adv_name'];?>" id="adv_name" title="name"/>
	    </p>
        
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Advertise Level:</label>
		<select name="adv_level" id="adv_level">
        <option value="level-1" <?php if ($row['adv_level']=='level-1'){ ?> selected="selected" <?php } ?>>Image size must be 1140*130 </option>
        <option value="level-2" <?php if ($row['adv_level']=='level-2'){ ?> selected="selected" <?php } ?>>Image size must be 230*700</option>
        <option value="level-3" <?php if ($row['adv_level']=='level-3'){ ?> selected="selected" <?php } ?>>Image size must be 230*300</option>
        </select>
	    </p>
	   
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Advertise Link:</label>
	      <input type="text" class="input"  name="adv_link" value="<?php echo $row['adv_link'];?>" id="adv_link"/>
	    </p>
	  <p class="cf">
	      <label>&nbsp;&nbsp;Contact Person:</label>
	     <input type="text" class="input"  name="contact_name" value="<?php echo $row['contact_name'];?>" id="contact_name"/>
	</p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Image</label>
          <input type="file" name="adv_img" id="adv_img" size="8" />
	       <input type="hidden" name="siteconfig" id="siteconfig" value="<?php echo $row['adv_img']; ?>" />
          
           <br /><br />
<img src="../advertise/<?php echo $row['adv_img']; ?>" style="margin-left:215px;" width="170px" height="160px" />
	    </p>
	    <p class="cf">
	      <label>&nbsp;&nbsp;Contact Number:</label>
	      <input type="text" class="input" name="phone" value="<?php echo $row['phone'];?>" id="phone"/>
	    </p>
       
    
	 <p class="cf">
	      <label><font id="star">*</font>&nbsp;Advertise Date:</label>
	      <input type="text" class="input"  name="datepicker" value="<?php echo $row['adv_date'];?>" id="datepicker"/>
	    </p>
     <p class="cf"> <label class="popup-label">Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status" <?php if($row['status']=="APPROVED") {?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($row['status']=="UNAPPROVED") {?> checked="checked" <?php } ?> />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($adv_id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_advertise" title="Update"/>
         <input type="hidden" name="update_advertise" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_advertise" title="Add"/>
          <input type="hidden" name="add_advertise" value="submit" />
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
