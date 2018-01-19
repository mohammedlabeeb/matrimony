<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
	
	if(isset($_POST['submit']))
	{		
		$uname=$_SESSION['user_id'];
		$pswd = trim(md5($_POST['old_pass']));
		$newpswd = trim(md5($_POST['new_pass']));		
		$mes="";
			$sql="select * from register where matri_id='$uname' and password='$pswd'";
			$result=mysql_query($sql) or die(mysql_error());
			
			if(mysql_num_rows($result)==1)
			{
				$sql="update register set password='$newpswd' where matri_id='$uname' and password='$pswd'";
				mysql_query($sql) or die(mysql_error());
				$mes="Your Password Has Been Changed.";
                                
                                $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "Your Password Has Been Changed.";	
                    
                    $message = "
                    <html>
                    <head>
                    <title>Your Password Has Been Changed.</title>
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

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                            You have update your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

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
			}
			else
			{
				$mes="Given Current Password is not Correct.";
			}
	    
	}

	?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<?php include "page-part/head.php";?>
</head>
<body>		
<div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev">
							
								 <?php
		if(isset($mes))
		{
			?>
            <div class="panel panel-warning"><div class="panel-heading">
     	<i class="glyphicon glyphicon-share"></i> <?php echo $mes;?></div></div> 
		
       <?php
		}
		?>
          <div class="">
            <div class="" style="">
              <h3 class="panel-title" style="">Change Password </h3>
            </div>
          <div class="">
            <div class="col-xs-12">
               <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
          <div class="form-group">
               <label for="inputEmail1" class="col-sm-4 col-xs-12 text-center control-label">Old Password</label>
                  <div class="col-sm-4 col-xs-12">
                  <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Type Old password" data-validation-engine="validate[required]">
                  </div>
          </div>
          <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">New Password</label>
                  <div class="col-sm-4 col-xs-12">
                  <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Type New password" data-validation-engine="validate[required]">
                  </div>
          </div>
          <div class="form-group">
               <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">Confirm New Password</label>
                  <div class="col-sm-4 col-xs-12">
                  <input type="password" class="form-control" id="cnfm_pass" name="cnfm_pass" placeholder="Type confirm New password" data-validation-engine="validate[required,equals[new_pass]]">
                  </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
             <div class="col-sm-offset-4 col-sm-7 col-xs-12 col-xs-offset-0">
                 <input style="width: auto;" type="submit" name="submit" value="Change Password" class="btn btn-success col-sm-4 col-xs-12">
             </div>
          </div>
       </form>
    </div>
  </div> 

								
							</div>
						</div>
					</div>
				</div>
	</article>
 	
               <?php
	             $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
	             $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	             $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	           ?>
        
          </div>
      
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

	<script>
		jQuery(document).ready(function()
		{
			//alert("hi");
			jQuery("#MatriForm").validationEngine();
		});
	</script>  
</body>
</html>


