<?php
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();	
	
		
		$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		 
if(isset($_POST['upload']))
{
		
        if($_FILES['horscope']['name']!='' && $_FILES['horscope']['size']<2097152)
		{
	
		copy($_FILES['horscope']['tmp_name'],"horoscope-list/".$_FILES['horscope']['name']);	
			$p2=$_FILES['horscope']['name'];
			
			
			$update1 =mysql_query("update register set hor_photo='$p2', hor_check='UNAPPROVED' where matri_id='$mid'");
       
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
                    $subject = "You Just Uploded horoscope";	
                    
                    $message = "
                    <html>
                   
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
       
       print "<script>alert('Horscope uploaded Successfully.')</script>";
       print "<script>window.location='horoscope.php'</script>";
		}
		else
		{
			
			print "<script>alert('Upload proper image file within 2 MB.')</script>";
					
			 
		}
       
	 
}

	
	 $hchk = mysql_query("SELECT * FROM register where matri_id='$mid'");
?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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

                    

                   

                       

                    

                       <div class="gradient-rev block-level" style="margin-top:20px">
              <h3 class="">Upload Horoscope</h3>             
          
            <div class="">                   	
                <div class="col-sm-12 padding-left-right-zero-small">                   
               <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <div class="col-sm-7 col-xs-12">
                    <p style="font-weight:bold;"> Add Horoscope / Change your Horoscope here.</p>  
                    </div>
                 </div>                          
           		<div class="form-group">
               		<label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">Upload Horoscope Image :</label>
                  		<div class="col-sm-4 col-xs-12">
         				<input type="file" name="horscope" id="horscope" data-validation-engine="validate[required]">
                  		</div>
           		</div>           
           		<div class="clearfix">&nbsp;</div>
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-7">
                    <input type="submit" name="upload" value="Upload" class="btn btn-success col-sm-4 col-xs-12">
                            </div>
                          </div>
                        </form>                  
                    
                    <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-7">
                  			&nbsp;
                            </div>
                          </div>
                     <div class="form-group">
                     	<div class="col-sm-offset-1 col-sm-10">
                     <?php  while($rowh = mysql_fetch_array($hchk))
		{ ?>
					<?php		
				   if($rowh['hor_photo']!="" && $rowh['hor_check']=='APPROVED')
			        {	
			        ?>	
					<div style="width:620px; height:330px;">
           <img src="horoscope-list/<?php echo $rowh['hor_photo']?>" height="330" width="620" >
            		</div>
                    <?php
					}
					elseif($rowh['hor_photo']!="" && $rowh['hor_check']!=='APPROVED')
					{
					 ?>	
					<div style="width:630px; height:330px;">
           <h4>Your horoscope is in waiting for Admin Approval. It will be online after approval...</h4>
            		</div>
                    <?php		
					}
					else
					{
					?>
                <h4>No horoscope Image available</h4>
                <?php	
					}
		}
					?>
                     </div>
                     </div>
                </div>  
            </div>
          </div>
          
           
          </div>
         
          
	</div>
	</div>
	</article>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>

</div>
  
    
</body>
</html>