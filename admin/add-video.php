<?php
	include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
	include("../BusinessLogic/class.advertise.php");
	$id=isset($_GET['index_id']) ? $_GET['index_id'] :"" ;	
	$select=mysql_query("select * from register_view where index_id='$id'");
	$row=mysql_fetch_array($select);
		
	if(isset($_REQUEST['update_video']))
	{	
		$id=$_GET['index_id'];
		$file=$_FILES['file']['name'];	
		$youtube_link=$_POST['youtube_link'];
		if($file!="")
		{
			$d=explode(".",$file);
		    $p=count($d);
		    $chk_ext=$d[$p-1];		
	  	    if(($chk_ext=="flv") && ($file_size<10480000))
			{
			$p="";
			move_uploaded_file($_FILES['file']['tmp_name'],"../video/".$_FILES['file']['name']);			
			echo $h="UPDATE register SET video='$file',video_url='$p' WHERE index_id='$id'";											
			$update1=mysql_query($h) or die(mysql_error());	
			header("location:video_approve.php?success='Yes'");
			}
			else
			{
				echo "<script laguage=\"javascript\">alert(\"Only .flv   Extention Video File and Maximum 10 MB Size Allow \");window.location=\"video_approve.php\";</script>";
			}		
		}
		else if($youtube_link!="")
		{
			$k1=$youtube_link;
			$j1="";
			echo $j="UPDATE register SET video_url='$youtube_link',video='$j1' WHERE index_id='$id'";
																			
			$update2=mysql_query($j) or die(mysql_error());		
			header("location:video_approve.php?success='Yes'");				
		}				
		else if($file=="")
		{
		$r=mysql_query("SELECT * FROM register WHERE index_id='$id'");
		$f=mysql_fetch_array($r);
		$j=$f['video'];
		echo $hh="UPDATE register SET video='$j',video_url='' WHERE matri_id='$id'";						
		$update4=mysql_query($hh) or die(mysql_error());		
		header("location:video_approve.php?success='Yes'");			
		}
						
					
		
  	}	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Video</title>
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
<script src="../js/swfobject.js" type="text/javascript"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
	setPageContext("approve","video-appprove");
</script>
<style type="text/css">
iframe
{
width:300px !important;
height:180px !important;
}
</style>
 <script language="JavaScript">
function setVisibility(id, visibility)
 {
document.getElementById(id).style.display = visibility;
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
      <div class="breadcum-wide"><a href="#" title="Add New Advertisement">Manage Video</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Advertisement" onclick="window.location='advertise.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Video</a>
	 		
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Video</h4>
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
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_video">
		
		<p class="cf">
	      <label>Video:</label>
<?php 
			if($row['video']!='')
			{
			?>
           <div id="flvplayer" style="margin-left:230px; margin-top:-30px;"></div>    
			<script language="javascript">
            var so = new SWFObject("../mpw_player.swf", "swfplayer", "300", "180", "5", "#000000"); 
            so.addVariable("flv", "video/<?php echo $row['video'];?>","swfplayer", "300", "180", "5", "#000000"); // File Name
         	so.addVariable("autoplay","false"); // Autoplay, make true to autoplay
            so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
            so.addVariable("backcolor","000000"); // Background color of controls in html color code
            so.addVariable("frontcolor","ffffff"); // Foreground color of controls in html color code
            so.write("flvplayer"); // This needs to be the name of the div id
			</script>
            
            <?php
			}
			else
			{
				echo $row['video_url'];
			}
			?>
	    </p>
	   <p class="cf">
       
    <label>Upload Video from</label>
   <input type="radio" class="textbox" name="v_type" id="v_type"  value="Computer" onclick="setVisibility('comp', 'inline');setVisibility('youtube', 'none');" <?php if($row['video']!=''){?> checked="checked" <?php } ?>/>&nbsp;&nbsp;Computer
   <input type="radio" class="textbox" name="v_type" id="youtube_type" value="Youtube" onclick="setVisibility('comp', 'none');setVisibility('youtube', 'inline');" <?php if($row['video_url']!=''){?> checked="checked" <?php } ?> />&nbsp;&nbsp;Youtube
   
   
     <p class="cf">
      
      <div id="comp" style="display:none;">
         <label>Computer Video:</label>
         <input type="file" name="file" id="file" data-validation-engine="validate[required]">
      </div>
      </p>
       
      <p class="cf">
	<div id="youtube" style="display:none;">
	<label>Video Link:</label>
    <textarea name="youtube_link" id="youtube_link" style="width:297px; height:80px;" data-validation-engine="validate[required]"/><?php echo $row['video_url'];?></textarea>
     <p style="margin-left:216px; margin-top:1px;">(Add Your Youtube video Embeded code Here.)</p>
	</div>
        </p>
        	 
    
    	    <p class="submit-btn cf">
       
         <input type="submit"  class="save-btn" value="Update" name="update_video" title="Update"/>
         <input type="hidden" name="update_video" value="submit" />
              
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
