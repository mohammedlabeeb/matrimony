<?php
	  	include_once 'databaseConn.php';
			include_once 'lib/requestHandler.php';
			include_once './class/Config.class.php';
			$configObj = new Config();
	    $DatabaseCo = new DatabaseConn();
		
		$is_logout = isset($_GET['action'])?$_GET['action']:""; 
		
 mysql_query("DELETE FROM online_users WHERE index_id='".$_SESSION['uid']."'");
 
			session_destroy();
			$statusObj = new Status();
			$statusObj->setActionSuccess(true);
			$STATUS_MESSAGE="You are successfully logout.";
		
		$username = "";
		$password = "";
		
		echo "<script language='javascript'>window.location='index.php';</script>";
		
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="image/x-icon" href="images/favicon.png" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link href="css/stylenew.css" type="text/css" rel="stylesheet" />
<link href="css/reveal.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/popup/jquery.reveal.js" type="text/javascript"></script>
<!-- LightBox -->
<link href="css/lightBox.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/lightbox/jquery.lightBox.js"></script>
<script type="text/javascript">
function validate_wrt_testimonial()
{
	if(document.getElementById('testimonial_name').value=='')
	{
		alert('Please enter your name');
		document.getElementById('testimonial_name').focus();
		return false;
	}
	if(document.getElementById('place').value=='')
	{
		alert('Please enter your place');
		document.getElementById('place').focus();
		return false;	
	}
	if(document.getElementById('mail_id').value=='')
	{
		alert('Please enter your mail id');
		document.getElementById('mail_id').focus();
		return false;	
	}
	frm_write_testimonial.submit();
	return true;
}
</script>
</head>
<body>
 <div id="SendMessageLightbox_testimonial" class="lightBox-modal">
    <div class="lightBox-content topHead-bg">
    <div class="contactsCount" id="write_testimonial_div"><h2>Write Message</h2></div>
    <div class="getContact-option full-width-content" >
    <form name="frm_write_testimonial" id="frm_write_testimonial" method="post" action="" class="genericForm" >
  	<ul>
     <li>
    <label>Name </label>
    <input type="text" name="testimonial_name" id="testimonial_name" class="textbox-medium" />
    </li>
     <li>
    <label>Place </label>
    <input type="text" name="place" id="place" class="textbox-medium" />
    </li>
     <li>
    <label>Email </label>
    <input type="text" name="mail_id" id="mail_id" class="textbox-medium" />
    </li>
    <li>
    <label>Message</label>
    <textarea name="message" id="message"></textarea>
    </li>
    <li>
    <div class="button-row">
     <input type="button" name="wrt_testimonial" id="wrt_testimonial" value="Submit" onclick="validate_wrt_testimonial();" class="button-common-style submit-button"/> 
      <input type="hidden" name="doaction" id="doaction" value="write_testimonial" />
		 </div>  
    </li>
    </ul> 
 	</form>            
    <a href="testimonials.php" class="close-lightBox" title="close" ></a>
   </div>
    </div>
    </div>
<div id="container">
<div id="content-wrapper">
	<?php 
	require_once 'page-part/header.php';
	?>
    <div id="header">
     <?php 
	require_once 'page-part/logo-part.php';
	?>
    </div>
   <div id="main-nav-outer"> 
    <?php 
	require_once 'page-part/menu.php';
	?>
    </div>
<div class="contentArea">
      <div class="rightWide-column fullWidth-container">
        <div class="seaechResuld-grid rounded-border listBox profilePreview margin-topNone">
          <div class="listBox-head">
            <h1 class="profileName">Logout</h1>
          </div>
          <div class="listBox-content" style="width:958px!important; padding:15px!important; float:left;">
            <div class="membership">
                        <div class="notification success png_bg rounded-border">
                <a href="#" class="close"><img src="images/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    You have successfully logged out...      
                    
                    </div>
            </div>
            
<!--              <p>Listed Below are Received Personalised messages.</p>
              <h2 class="greenText">You have successfully logged out...</h2>
-->             <!-- <a href="#" class="button-common-style writeTestimonial-button" data-lightBox-id="SendMessageLightbox_testimonial" data-animation="fade"></a>
     			<h3>Write your own testimonial</h3>
     			<span>If you would be so kind, please write your testimonial in your own words here:</span>
              	<div class="grid_outer" style="width:958px!important; position:relative;">
                <div class="fb-custom"></div>
                <iframe id="f27405ebf" name="f1da142f1c" scrolling="no" style="border: none!important; overflow: hidden; height: 260px; width: 958px;" class="fb_ltr" src=""></iframe>
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--footer starts-->
<div class="footer-panel">
<?php 
	require_once 'page-part/footer.php';
	?>
<div class="footerLinksArea">
<div class="footerLinksArea-content">
<?php 
	require_once 'page-part/powered.php';
	?>
</div>
</div>
</div>
<!--footer ends-->
</div>
<script src="js/edit-profile/edit-profile.js"  type="text/javascript" ></script>
</body>
</html>

