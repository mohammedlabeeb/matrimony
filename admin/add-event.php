<?php
	include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.events.php");
		
	$id = isset($_GET['id']) ? $_GET['id'] :"" ;
	$ob=new event();
	$mtongueres=$ob->get_event_by_id($id);
	$row=mysql_fetch_array($mtongueres);
		
	if(isset($_REQUEST['add_event']))
	{	
		$name=mysql_real_escape_string(ucwords($_POST['name']));
		$date=$_POST['datepicker'];
		$time=$_POST['event_time'];
		$venue=$_POST['venue'];
		$image=$_FILES['image']['name'];
		$limit=$_POST['limited'];
		$ticket=$_POST['ticket'];
		$description=$_POST['description'];
		$status=$_POST['status'];
		
	move_uploaded_file($_FILES['image']['tmp_name'],"../events-list/".$_FILES['image']['name']);
	$insert="insert into events (name,event_date,event_time,venue,image,limited,ticket,description ,status) values
	('$name','$date','$time','$venue','$image','$limit','$ticket','$description','$status')";
	$exe=mysql_query($insert) or die(mysql_error());
	header("location:event-list.php?success='Yes'");
  	}
	
	if(isset($_POST['update_event']))
	{
		$name=mysql_real_escape_string($_POST['name']);
		$date=$_POST['datepicker'];
		$time=$_POST['event_time'];
		$venue=$_POST['venue'];
		if(@is_uploaded_file($_FILES["image"]["tmp_name"]))
		{
			copy($_FILES['image']['tmp_name'],"../events-list/".$_FILES['image']['name']);
			$image=$_FILES['image']['name'];
		}
		else
		{
			$image=$row['image'];
		}
		$limit=$_POST['limited'];
		$ticket=$_POST['ticket'];
		$description=$_POST['description'];
		$status=$_POST['status'];
		
			
		$ob->update_event($id,$name,$date,$time,$venue,$image,$limit,$ticket,$description,$status);
		header("location:event-list.php?success='Yes'");
		
	}
		
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Event</title>
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
	setPageContext("add-new","events");
	$(document).ready(function()
	 {
	    var formId = "#add_event";
	    var rules = {
                name: { required: true,minlength: 4, maxlength: 200 },
                datepicker: { required: true, minlength: 5, maxlength: 100 },
				event_time: { required:true},
                venue:{ required: true, minlength: 5, maxlength: 500 },
				ticket:{ required: true},
				limited:{ required: true},
				description:{ required: true, minlength: 5, maxlength: 500 },
				status:{ required: true },
			
				
            };
	    var messages = {
				name: {required:"Event Name is required."},
                datepicker: {required:"Event date is required."},
				event_time: {required:"Event time is required."},
                venue:{required:"Event venue is required."},
				ticket:{required:"Event ticket is required."},
				limited:{required:"Event limited is required."},
				description:{required:"Event description is required."},
				status:{required:"Event status is required."},
				
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
      <div class="breadcum-wide"><a href="#" title="Add New Detail">Add New Detail</a> / <a href="#" title="Event">Event</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Events" onclick="window.location='event-list.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Events</a>
	  <a href="javascript:;" title="Add New Event" onclick="window.location='add-event.php'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Event</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Event</h4>
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
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_event">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Event Name:</label>
<input type="text" class="input-textbox" name="name" value="<?php echo $row['name'];?>" id="name" title="name"/>
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Event Date:</label>
	      <input type="text" class="input-textbox"  name="datepicker" value="<?php echo $row['event_date'];?>" id="datepicker"/>
	    </p>
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Event Time:</label>
	      <input type="text" class="input-textbox"  name="event_time" value="<?php echo $row['event_time'];?>" id="event_time"/>
	    </p>
	  <p class="cf">
	      <label><font id="star">*</font>&nbsp;Venue:</label>
	      <textarea cols="40" rows="4" class="text-area" name="venue" id="venue"><?php echo $row['venue'];?></textarea>
	</p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Image</label>
          <input type="file" name="image" id="image" size="8" />
	       <input type="hidden" name="siteconfig" id="siteconfig" value="<?php echo $row['image']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../events-list/<?php echo $row['image']; ?>" style="border:solid 0px #7e0000;" width="80px" height="60px" />
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Ticket:</label>
	      <input type="text" class="input-textbox" name="ticket" value="<?php echo $row['ticket'];?>" id="ticket"/>
	    </p>
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Limited:</label>
	      <input type="text" class="input-textbox"  name="limited" id="limited" value="<?php echo $row['limited'];?>"/>
	</p>
    
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;Descriptions:</label>
	      <textarea cols="40" rows="4" class="text-area" name="description" id="description"><?php echo $row['description'];?></textarea>
	</p>
     <p class="cf"> <label class="popup-label">Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status"<?php if($row['status']=='APPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($row['status']=='UNAPPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_event" title="Update"/>
         <input type="hidden" name="update_event" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_event" title="Add"/>
          <input type="hidden" name="add_event" value="submit" />
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
