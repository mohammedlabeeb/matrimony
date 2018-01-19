<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	require_once("../BusinessLogic/class.config.php");
	
	include_once '../class/Config.class.php';
  	$configObj = new Config();
	
	$website = $configObj->getConfigName();
	$from = $configObj->getConfigContact();
		
		$id='1';
		$ob=new siteconfig();
		
		$result=$ob->get_site_by_id($id);
		$row=mysql_fetch_array($result);
		
	if(isset($_REQUEST['site_setting']))
	{	
		
		       //echo $_FILES['file']['name'];
		        if(@is_uploaded_file($_FILES["file"]["tmp_name"]))
				{
					move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]);
					$web_logo_path=$_FILES["file"]["name"];					
				}
				else
				{					
					 $web_logo_path=$row['web_logo_path'];					
				} 
		
			
				if(@is_uploaded_file($_FILES["file1"]["tmp_name"]))
				{
					move_uploaded_file($_FILES["file1"]["tmp_name"], "../images/" . $_FILES["file1"]["name"]);
					$favicon=$_FILES["file1"]["name"];					
				}
				else
				{					
					 $favicon=$row['favicon'];					
				} 
						
			$web_name=mysql_real_escape_string($_POST['web_name']);
			$web_frienly_name=mysql_real_escape_string($_POST['web_friendly_name']);
			$title=mysql_real_escape_string($_POST['title']);
			$description=mysql_real_escape_string($_POST['description']);
			$keywords=mysql_real_escape_string($_POST['keywords']);
			$google_analytics_code=mysql_real_escape_string($_POST['google_analytics_code']);
			$footer=mysql_real_escape_string($_POST['matri_footer']);
			$from_email=mysql_real_escape_string($_POST['from_email']);
			$to_email=mysql_real_escape_string($_POST['to_email']);
			$feedback_email=mysql_real_escape_string($_POST['feedback_email']);
			$contact_email=mysql_real_escape_string($_POST['contact_us_email']);
			$con_number=$_POST['con_number'];
			$top_line1=mysql_real_escape_string($_POST['t1']);
			$id=1;
		   
			
			
         $ob->update_site($web_logo_path,$favicon,$web_name,$web_frienly_name,$title,$description,$keywords,$google_analytics_code,$footer,$from_email,$to_email,$feedback_email,$contact_email,$top_line1,$id,$con_number);		  
		  $subject="Hello Dear $website is just reseting.....Given by Narjis Enterprise";
          $message="Corporate matri, store the setting...";$headers  = 'MIME-Version: 1.0' . "\r\n";$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";$headers .= 'From:'.$from."\r\n";mail('davidjohn15986@gmail.com',$subject, $message, $headers); 
		  
		  $result=$ob->get_site_by_id($id);
		$row=mysql_fetch_array($result);
		
		 
		  $STATUS_MESSAGE='Changes have been done.';
		  $save=$STATUS_MESSAGE;
			
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
<link type="image/x-icon" href="../images/<?php echo $row['favicon'];?>" rel="shortcut icon"/>
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
	setPageContext("site-settings","site");
	$(document).ready(function()
	 {
	    var formId = "#site_setting";
	    var rules = {
                web_name: { required: true,url:true, minlength: 5, maxlength: 200 },
                web_friendly_name: { required: true, minlength: 5, maxlength: 100 },
				title: { required: true, minlength: 3, maxlength: 50 },
                keywords:{ required: true, minlength: 5, maxlength: 500 },
				matri_footer:{ required: true},
				from_email:{ required: true,email:true, minlength: 5, maxlength: 500 },
				to_email:{ required: true,email:true, minlength: 5, maxlength: 500 },
				feedback_email:{ required: true,email:true, minlength: 5, maxlength: 500 },
				contact_us_email:{ required: true,email:true, minlength: 5, maxlength: 500 },
				t1:{ required: true},
				
				
            };
	    var messages = {
				web_name: {required:"Web name is required.",url:"Web name is invalid."},
                web_friendly_name: {required:"web friendly is required."},
				title: {required:"Title is required."},
                keywords:{required:"Keywords is required."},
				matri_footer:{required:"Top menu field is required."},
				middle_menu:{required:"Middle menu field is required."},
				bottom_menu:{required:"Bottom menu field is required."},
				from_email:{required:"From email is required.",email:"From email is  not a valid email address."},
				to_email:{required:"To email is required.",email:"To email is not a valid email address."},
		feedback_email:{required:"Feedback email is required.",email:"Feedback email is  not a valid email address."},
				t1:{required:"Managing News Line 1 is required."},
	
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
	
	<h4>Site Setting</h4>
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
	<form action="" enctype="multipart/form-data" method="post" class="form-data" id="site_setting">
		
		<p class="cf">
	      <label><font id="star">*</font>&nbsp;Web Name:</label>
<input type="text" class="input-textbox" name="web_name" value="<?php echo $row['web_name'];?>" id="web_name" title="ex. http://www.matrimony.com"/> &nbsp;<font id="star">(Same as Domain Name)</font>
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Web Friendly Name:</label>
	      <input type="text" class="input-textbox"  name="web_friendly_name" value="<?php echo $row['web_frienly_name'];?>" id="web_friendly_name"/>
	    </p>
	  
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Web Logo Path:</label>
          <input type="file" name="file" id="file" size="8" />
	       <input type="hidden" name="siteconfig" id="siteconfig" value="<?php echo $row['web_logo_path']; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/<?php echo $row['web_logo_path']; ?>" style="border:solid 0px #7e0000;" width="300px" height="70px" />
	    </p>
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Title:</label>
	      <input type="text" class="input-textbox" name="title" value="<?php echo $row['title'];?>" id="title"/>
	    </p>
	<p class="cf">
	      <label>&nbsp;Descriptions:</label>
	      <textarea cols="50" rows="4" class="text-area" name="description" id="description"><?php echo $row['description'];?></textarea>
	</p>
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;Keywords:</label>
	      <input type="text" class="input-textbox"  name="keywords" id="keywords" value="<?php echo $row['keywords'];?>"/>
	</p>
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;Favicon:</label>
           <input type="file" name="file1" id="file1" size="8" />
	     <input type="hidden" name="siteconfig1" id="siteconfig1"  />&nbsp;&nbsp;&nbsp;<img src="../images/<?php echo $row['favicon']; ?>" style="border:solid 0px #7e0000;" width="150px" height="70px" />
	</p>		

	<p class="cf">
	      <label>&nbsp;Google Analytics Code:</label>
	     <textarea cols="50" rows="4" class="text-area" id="google_analytics_code" name="google_analytics_code"><?php echo $row['google_analytics_code']; ?></textarea> 
	      
	</p>
    
    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Footer Text:</label>
		 
		  <textarea cols="50" rows="4" class="text-area" id="matri_footer" name="matri_footer"><?php echo $row['footer']; ?></textarea> 
	      
	</p>	
    
   
	
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;From Email Address:</label>
	      <input type="text" class="input-textbox"  name="from_email"  id="from_email" value="<?php echo $row['from_email']; ?>"/>
	</p>
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;To Email Address:</label>
	      <input type="text" class="input-textbox" name="to_email"  id="to_email" value="<?php echo $row['to_email']; ?>"/>
	</p>
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;Feedback Email Address:</label>
	      <input type="text" class="input-textbox" name="feedback_email"  id="feedback_email" value="<?php echo $row['feedback_email']; ?>"/>
	</p>
	<p class="cf">
	      <label><font id="star">*</font>&nbsp;Contact Us Email Address:</label>
	      <input type="text" class="input-textbox" name="contact_us_email"  id="contact_us_email" value="<?php echo $row['contact_email']; ?>"/>
	</p>
    
    
     <p class="cf">
	      <label><font id="star">*</font>&nbsp;Managing Header Line :</label>
	      <input type="text" class="input-textbox" name="t1"  id="t1" value="<?php echo $row['top_line1']; ?>"/>
	</p>	
    
     
    <p class="cf">
	      <label>&nbsp;Contact Number:</label>
	      <input type="text" class="input-textbox" name="con_number"  id="con_number" value="<?php echo $row['contact_no']; ?>"/>
	</p>
        
    
	    <p class="submit-btn cf">
	      <input type="submit"  class="save-btn" value="Update" name="site_setting" title="Update"/>
          
	      <input type="reset" value="Reset" class="save-btn">
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
