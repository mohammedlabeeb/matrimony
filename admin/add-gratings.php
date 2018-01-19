<?php
session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.advertise.php");
	
	$grt_id=isset($_GET['id']) ? $_GET['id'] :"" ;
	$select=mysql_query("select * from gratings_setting where g_id='$grt_id'");
	$row=mysql_fetch_array($select);
	
		
	if(isset($_REQUEST['add_gratings']))
	{	
		$g_song=$_FILES['g_song']['name'];			
		$ext = pathinfo($g_song, PATHINFO_EXTENSION);		
		$fname=str_ireplace(" ", "-", $g_song);		
		$g_type=$_FILES['g_song']['type'];
		$g_message=$_POST['g_message'];
		$datepicker=$_POST['datepicker'];
		$status=$_POST['status'];
		
		if($ext=='mp3')
		{
		move_uploaded_file($_FILES['g_song']['tmp_name'],"../gratingsong/".$fname);
			
		$insert=mysql_query("insert into gratings_setting (g_song,g_type,g_message,g_date,status) values ('$fname','$g_type','$g_message','$datepicker','$status')");
		header("location:gratings-list.php?success='Yes'");
		}
		else
		{
			header("location:gratings-list.php?Error='Yes'");	
		}
				
			
		
  	}
	
	if(isset($_REQUEST['update_gratings']))
	{	
		$grt_id=$_GET['id'];
		if(@is_uploaded_file($_FILES["g_song"]["tmp_name"]))
		{
			$g_song=$_FILES['g_song']['name'];
			echo $ext = pathinfo($g_song, PATHINFO_EXTENSION);	
			if($ext =='mp3')
			{
				
				$g_song=$_FILES['g_song']['name'];
				$fname=str_ireplace(" ", "-", $g_song);
		
			copy($_FILES['g_song']['tmp_name'],"../gratingsong/".$fname);
		
			$g_type=$_FILES['g_song']['type'];
			$g_message=$_POST['g_message'];
			$datepicker=$_POST['datepicker'];
			$status=$_POST['status'];
			
			$update=mysql_query("update gratings_setting set g_song='$fname',g_type='$g_type',
			g_message='$g_message',g_date='$datepicker',status='$status' where g_id='$grt_id'");	
			header("location:gratings-list.php?success='Yes'");
			}
			else
			{
			header("location:gratings-list.php?Error='Yes'");	
			}
		}
		else
		{
			$g_song=$_POST['song'];
			$g_type=$_POST['type'];
			$g_message=$_POST['g_message'];
			$datepicker=$_POST['datepicker'];
			$status=$_POST['status'];
			
			$update=mysql_query("update gratings_setting set g_song='$g_song',g_type='$g_type',
			g_message='$g_message',g_date='$datepicker',status='$status' where g_id='$grt_id'");	
			header("location:gratings-list.php?success='Yes'");
		}
		
		
  	}
	
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Greetings</title>
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
	setPageContext("gratings","gratings-detail");
	$(document).ready(function()
	 {
	    var formId = "#add_gratings";
	    var rules = {
			 <?php
		if(empty($grt_id))
		{
		?>
                g_song: { required: true},
		<?php
		}
		?>
               	g_message: { required: true},
				datepicker: {required: true},
				status:{ required: true },
			
				
            };
	    var messages = {
			<?php
		if(empty($grt_id))
		{
		?>
				g_song: {required:"Greetings song is required."},
				<?php
		}
		?>
                g_message: {required:"Greetings Message is required."},
				datepicker: {required:"Greetings registered date is required."},
				status:{required:"Greetings status is required."},
				
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
      <div class="breadcum-wide"><a href="#" title="Add New Greetings">Add New Greetings</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Greetings" onclick="window.location='gratings-list.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Greetings</a>
	  <a href="javascript:;" title="Add New Greetings" onclick="window.location='add-gratings.php'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Greetings</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Greetings</h4>
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
      <span class="field_marked">Only MP3 file is allowed.</span>
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_gratings">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Greeting Song:</label>
<input type="file" name="g_song" value="<?php echo $row['g_song'];?>" id="g_song" title="Grating Song"/>
<input type="hidden" name="song" id="song" value="<?php echo $row['g_song']; ?>" />
<input type="hidden" name="type" id="type" value="<?php echo $row['g_type']; ?>" />
<br />
 <?php
if(!empty($grt_id))
{
	?>		
			<audio controls="controls" style="width:300px;">
            <source src="../gratingsong/<?php echo $row['g_song']; ?>" 
            type="audio/mpeg" title="<?php echo $DatabaseCo->dbRow->g_song;?>" />
            </audio>           
            
 <?php
}
?>
	    </p>
	   
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Greeting Message:</label>
          <textarea name="g_message" id="g_message" rows="3" cols="30"><?php echo $row['g_message'];?></textarea>
	    </p>
	 
	 <p class="cf">
	      <label><font id="star">*</font>&nbsp;Date:</label>
	      <input type="text" class="input"  name="datepicker" value="<?php echo $row['g_date'];?>" id="datepicker"/>
	    </p>
     <p class="cf"> <label><font id="star">*</font>&nbsp;Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status" <?php if($row['status']=="APPROVED") {?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($row['status']=="UNAPPROVED") {?> checked="checked" <?php } ?> />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($grt_id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_gratings" title="Update"/>
         <input type="hidden" name="update_gratings" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_gratings" title="Add"/>
          <input type="hidden" name="add_gratings" value="submit" />
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
