<?php
	include_once 'databaseConn.php';
	include_once 'lib/requestHandler.php';
	include_once './class/Config.class.php';
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	
	$from=$configObj->getConfigFrom();
	
	$website =  $configObj->getConfigName();
	$webfriendlyname =  $configObj->getConfigFname();
		
	
	if(isset($_REQUEST['enquiry2']))
        {
            $email = isset($_POST['email'])?$_POST['email']:"";
            
	        $SQL_STATEMENT = "select * from register where email='".$email."' AND status!='Suspended'";
	        $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	        $statusObj = handle_post_request("FORGET",$SQL_STATEMENT,$DatabaseCo);
			$STATUS_MESSAGE = $statusObj->getStatusMessage();
			if($statusObj->getActionSuccess())
			{
			$matri_id = $DatabaseCo->dbRow->matri_id; 
			$username = $DatabaseCo->dbRow->username; 
			function RandomPassword() 
				{
					$chars = "abcdefghijkmnopqrstuvwxyz023456789";
					srand((double)microtime()*1000000);
					$i = 0;
					$pass = '' ;
					while ($i <= 7) 
					{
						$num = rand() % 33;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}
				return $pass;
				}
				
				$pswd = RandomPassword();
			    $upasswd=md5($pswd);
				$sql="update register set password='$upasswd' where email='$email'";
				mysql_query($sql) or mysql_error();
			
		 	$to = "$email";
			$subject = "Your new password";
			$message = "
					<html>
					<head>
					<title><h1>Your new password</h1></title>
					</head>
					<body>
<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
  <tbody>
  <tr>
    <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
  	  <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
  		<tbody>
			<tr style='background:#f9f9f9'>
    			<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
					<span tabindex='0' class='aBn' data-term='goog_849968294'>
					<span class='aQJ'>$date</span></span></td>
    <td style='float:left;margin-top:30px;color:#048c2e;font-size:26px;padding-left:15px'>$webfriendlyname</td>
    
  </tr>
  
</tbody></table>
    </td>
  </tr>
  <tr>
    <td style='float:left;width:710px;min-height:auto'>
    
    <h6 style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px'>Hello, $username</h6><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Message : Your forgot password request has been received in our system.Given below is your profile login details,</p>
		<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'><b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>Matri ID : $matri_id (or) <a style='text-decoration:none;color:#096b53;outline:none'>$email</a><br>New Password : $pswd </b></p>
	<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thanks & Regards ,<br>Team At $webfriendlyname</p>
    
    </td>
  </tr>
</tbody></table>
					
					</body>
					</html>
					";

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
					$headers .= 'From:'.$from."\r\n";
		
					mail($to,$subject,$message,$headers);
					
					?>

			<script>alert('New Password has been sent to your email id.');</script>

			<?php
					}
					
					
		else
		{
			?>

			<script>alert('Please enter correct email id');</script>

			<?php
	
		}			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width">
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>

	<script>
		jQuery(document).ready(function()
		{
			jQuery("#adformSearch").validationEngine();
		});
	</script>

</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
 

         <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Forgot Password</li>
        </ol>
 	<div class="row">
   		 
    		<div class="col-xs-6 col-sm-3">
        		 <?php include 'advertise/add_single.php'; ?>
        	</div>
            
           <div class="clearfix visible-xs"></div>
          <div class="col-xs-12 col-sm-9">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Forgot Password</h3>
            </div>
            <div class="panel-body">
            
            <p class="clearfix"></p>
              	<form name="adformSearch" id="adformSearch" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label">Email-Id</label>
    			<div class="col-sm-4">
      			<input type="text"  name="email" id="email" class="form-control" data-validation-engine="validate[required,custom[email]]" >
           
    			</div>
  				</div>
                
  				
  				<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" name="enquiry2" class="btn btn-success"> Submit </button>
    			</div>
  				</div>
				</form>
            </div>
          </div>
          </div>
      	
	</div>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
 </body>
</html>

