<?php
	include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.story.php");
	$story_id=isset($_GET['story_id']) ? $_GET['story_id'] :"" ;	
	$ob=new story();
	$result=$ob->get_story_by_id($story_id);
	$row=mysql_fetch_array($result);
		
	if(isset($_REQUEST['add_story']))
	{	
		$brideid=mysql_real_escape_string($_POST['brideid']);
		$bridename=mysql_real_escape_string($_POST['bridename']);
		$groomid=mysql_real_escape_string($_POST['groomid']);
		$groomname=mysql_real_escape_string($_POST['groomname']);
		$marriagedate=$_POST['datepicker'];
		$successmessage=mysql_real_escape_string($_POST['successmessage']);
		$status=$_POST['status'];
		
		$sgg="select * from register where matri_id='$brideid'";
		$rrr=mysql_query($sgg);
		$num_row11 = mysql_num_rows($rrr); 
		
		$sgg2="select * from register where matri_id='$groomid'";
		$rrr2=mysql_query($sgg2);
		$num_row22 = mysql_num_rows($rrr2); 
		
		
			if ($num_row11 == 0) 
			{ 
				
				$msg1="Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.";
			} 

			else if ($num_row22 == 0) 
			{ 
				
				$msg2="Your Groom MatriId Not Found in Our Database.Please, Enter Valid Groom MatriId.";
			} 
		
			else
			{ 
			         move_uploaded_file($_FILES['file']['tmp_name'],"../SuccessStory/".$_FILES['file']['name']);
					 $weddingphoto=$_FILES['file']['name'];
					 
					  $ob=new story();
					  $ob->add_story($weddingphoto,$bridename,$brideid,$groomname,$groomid,$marriagedate,$successmessage,$status);
					 header("location:success_approve.php?success='Yes'");
					
			}			
			
		header("location:success_approve.php?success='Yes'");
  	}
	
	if(isset($_REQUEST['update_story']))
	{	
		if($_FILES['file']['name']=='')
			$weddingphoto=$_POST['file_post'];
		else
			$weddingphoto=$_FILES['file']['name'];
			
		$brideid=mysql_real_escape_string($_POST['brideid']);
		$bridename=mysql_real_escape_string($_POST['bridename']);
		
		$groomid=mysql_real_escape_string($_POST['groomid']);
		$groomname=mysql_real_escape_string($_POST['groomname']);
		
		$marriagedate=$_POST['datepicker'];
		$successmessage=mysql_real_escape_string($_POST['successmessage']);
		$status=$_POST['status'];
		
		$sgg="select * from register where matri_id='$brideid'";
		$rrr=mysql_query($sgg);
		$num_row11 = mysql_num_rows($rrr); 
		
		$sgg2="select * from register where matri_id='$groomid'";
		$rrr2=mysql_query($sgg2);
		$num_row22 = mysql_num_rows($rrr2); 
		
		
			if ($num_row11 == 0) 
			{ 
				$msg1="Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.";
			} 

			else if ($num_row22 == 0) 
			{ 
		
				$msg2="Your Groom MatriId Not Found in Our Database.Please, Enter Valid Groom MatriId.";
			} 
		
			else
			{ 
		
				$ob->update_story($story_id,$weddingphoto,$bridename,$brideid,$groomname,$groomid,$marriagedate,$successmessage,$status);
				move_uploaded_file($_FILES['file']['tmp_name'],"../SuccessStory/".$_FILES['file']['name']);
				header("location:success_approve.php?success='Yes'");
			}		
			
		header("location:success_approve.php?success='Yes'");
  	}
	
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Success Story</title>
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
	setPageContext("approve","success-appprove");
	$(document).ready(function()
	 {
	    var formId = "#add_advertise";
	    var rules = {
                brideid: { required: true},
               	bridename: { required: true},
				groomid: { required: true},
               	groomname: { required: true},
				<?php
		if(empty($story_id))
		{
		?>
				file:{ required: true},
		<?php
		}
		?>
				datepicker: {required: true},
				successmessage: {required: true},
				status:{ required: true },
			
				
            };
	    var messages = {
				brideid: {required:"Bride Id is required."},
                bridename: {required:"Bride Name is required."},
				groomid: {required:"Groom Id is required."},
                groomname: {required:"Groom Name is required."},
			<?php	if(empty($story_id))
		{
		?>
                file:{required:"Wedding Photo is required."},
		<?php
		}
		?>
				datepicker: {required:"Marriage Date is required."},
				successmessage: {required:"Success Message is required."},
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
<script type="text/javascript">
function checkbride(str)
{
if (str=="")
  {
  document.getElementById("bridename").value="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("bridename").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkbride.php?q="+str,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
function checkgroom(str)
{
if (str=="")
  {
  document.getElementById("groomname").value="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("groomname").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checkgroom.php?q="+str,true);
xmlhttp.send();
}

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
      <div class="breadcum-wide"><a href="#" title="Add New Success Story">Add New Success Story</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Success Story" onclick="window.location='success_approve.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Success Story</a>
	  <a href="javascript:;" title="Add New Success Story" onclick="window.location='add-success-story.php'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Success Story</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Success Story</h4>
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
	      <label><font id="star">*</font>&nbsp;Bride Id:</label>
<input type="text" class="input" name="brideid" value="<?php echo $row['brideid'];?>" id="brideid" onblur="return checkbride(this.value)"/>
	    </p>
	   
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Bride Name:</label>
	      <input type="text" class="input"  name="bridename" readonly="readonly" value="<?php echo $row['bridename'];?>" id="bridename"/>
	    </p>
	  <p class="cf">
	      <label>&nbsp;&nbsp;Groom Id:</label>
	     <input type="text" class="input"  name="groomid" onblur="return checkgroom(this.value)" value="<?php echo $row['groomid'];?>" id="groomid"/>
	</p>
     <p class="cf">
	      <label>&nbsp;&nbsp;Groom Name:</label>
	     <input type="text" class="input"  name="groomname" readonly="readonly" value="<?php echo $row['groomname'];?>" id="groomname"/>
	</p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Wedding Photo</label>
          <input type="file" name="file" id="file" size="8" />
	       <input type="hidden" name="file_post" id="file_post" value="<?php echo $row['weddingphoto']; ?>" />
           <br /><br />
<img src="../SuccessStory/<?php echo $row['weddingphoto']; ?>" style="margin-left:215px;" width="170px" height="160px" />
	    </p>
	         
    
	 <p class="cf">
	      <label><font id="star">*</font>&nbsp;Marriage Date:</label>
	      <input type="text" class="input"  name="datepicker" value="<?php echo $row['marriagedate'];?>" id="datepicker"/>
	    </p>
        
        <p class="cf">
	      <label><font id="star">*</font>&nbsp;Success Message:</label>
	    <textarea rows="3" cols="17" name="successmessage" id="successmessage"><?php echo $row['successmessage'];?></textarea>
	    </p>
     <p class="cf"> <label class="popup-label"><font id="star">*</font>&nbsp;Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status" <?php if($row['status']=="APPROVED") {?> checked="checked" <?php } ?> />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($row['status']=="UNAPPROVED") {?> checked="checked" <?php } ?>/>
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($story_id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_story" title="Update"/>
         <input type="hidden" name="update_story" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_story" title="Add"/>
          <input type="hidden" name="add_story" value="submit" />
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
