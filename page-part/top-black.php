<?php
error_reporting(1);
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP()
{ //fuction to return the xml http object
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
}
function Getlogin(strURL) 
{
		var req4 = getXMLHTTP();		
		if (req4) 
		{
			req4.onreadystatechange = function() 
			{
					if (req4.readyState == 4) 
					{
						if(req4.status == 200) 
						{	
						if(req4.responseText=='1'){
							window.location="myhome.php";
						} else {
							document.getElementById('loginError').innerHTML=req4.responseText;	
							}
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req4.statusText);
						}
					}				
			}			
			req4.open("GET", strURL, true);
			req4.send(null);
		}				
}
jQuery(document).ready(function($) {
	$('#loginForm').submit(function() {
		var username=$('#username').val();
		var password=$('#password').val();
		Getlogin('login_ajax.php?username='+username+'&password='+password);
		
		return false;
	});
});
</script>
<div id='preloader'><div id='status'>&nbsp;</div></div>
<!-- Login Popup -->
		<div class="modal fade loginpopup" id="popupLogin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Log into - <a href="#">peoplematrimony.com</a></h4>
					</div>
					<div class="modal-body">
						<div class="row">
							
								<div class="col-md-7" style="border-right: 1px dotted #C2C2C2; padding-right: 20px;">
								<form class="col-lg-12 padding-left-zero padding-right-zero padding-left-right-zero-small" id="loginForm" method="post">
									<div class="form-row">
										<div class="form-label"><label>Username</label></div>
										<div class="form-fields">
											<input type="text" name="username" id="username" placeholder="Enter your username">
										</div>
									</div>
									<div class="form-row">
										<div class="form-label"><label>Password</label></div>
										<div class="form-fields">
											<input type="password" name="password" id="password" placeholder="Enter password">
										</div>
									</div>
									<input type="submit" id="member_login" name="member_login"  value="Login" class="login-btn btn btn-success" style="margin-top:18px; margin-right:8px" />
									
									<a href="forgot-password.php" style="font-size:14px;">Forgot your password?</a>
									
									<div id="OR" class="hidden-xs">OR</div>
									</form>
									<span id="loginError"></span>
								</div>
							
							<div class="col-md-5">
								<div class="row text-center sign-with">
									<div class="col-md-12">
										<h3>Sign in with</h3>
									</div>
									<div class="col-md-12">
										<div class="btn-group btn-group-justified">
											<a href="#" class="btn btn-primary">Facebook</a>
											<a href="#" class="btn btn-danger">Google</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br/>
					</div>
				</div>
			</div>
		</div>
<div class="top gradient-rev">
						<div class="top-inner">
						 <script type="text/javascript">  
							function submitOnEnter(inputElement, event) {  
								
								if (event.keyCode == 13) { // No need to do browser specific checks. It is always 13.  		
								//alert('ok');
									$('#member_login').click();  
								}  
							}  
						</script> 
							<div class="inner">
								<a href="index.php" class="logo"><img src="images/<?php echo $configObj->getConfigLogo();?>">
      </a>
								<div class="top-menus">
									<div class="userlogin">
										<?php  if(!isset($_SESSION['user_id'])) { ?>
										<a href="#" data-toggle="modal" data-target="#popupLogin"><i class="ion-android-contact"></i> User Login</a>
										<?php  } else { ?>
										<a href="logout.php?action=logout" title="Logout">Logout</a>
										<?php } ?>
									</div>
									
									<div class="blackmenu">
										<span class="welcome-link">
											Welcome <?php  if(isset($_SESSION['user_id'])) { ?> : <span class="name"><?php echo $_SESSION['uname'] ;?></span><?php } ?>
											<button><i class="ion-chatbubble-working"></i> Live Chat</button>
										</span>
									</div>
									
								</div>
								<nav>
									<ul class="navigation">
										<li><a href="#">About Us</a></li>
										<li><a href="#">Free Register</a></li>
										<li><a href="#">Reseller Program</a></li>
										<li><a href="#">Service Provider</a></li>
										<li><a href="#">Contact Us</a></li>
										<?php if(basename($_SERVER['PHP_SELF']) != 'index.php') {
												if(!isset($_SESSION['user_id'])) {?>
											<li><a href="register.php" class="btn">Free Registration</a></li>
										<?php } else { ?>
											<li><a href="myhome.php" class="btn">My Home</a></li>
										<?php } } ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>