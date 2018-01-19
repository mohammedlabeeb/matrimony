  <?php
	error_reporting(0);
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './class/Config.class.php';
	include_once 'lib/requestHandler.php';
	include_once './lib/pagination.php';
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$matid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
	unset($_SESSION['user_file_ext']);
	unset($_SESSION['random_key']);
	
                    $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$matid'";
                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
                   
	if(isset($_REQUEST['del']))
	{
		$delete=$_REQUEST['del'];
		$image_name=$_REQUEST['image'];
		unlink("photos/".$image_name);
		unlink("photos_big/".$image_name);
		$upd="update register set photo".$delete."='' where matri_id='$matid'";
		$exe=mysql_query($upd) or die(mysql_error());
                
                $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$matid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Deleted your photo";	
                    
                    $message = "
                    <html>
                    <head>
                    <title>You have Delete your Photo </title>
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
                                    Matri-id : $matid <br/>
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
		header("location:modify-photo.php");
	}
	if(isset($_REQUEST['protect_photo']))
	{
		$photo=	$_REQUEST['photo_password'];
		$upd="update register set photo_protect='Yes',photo_pswd='$photo' where matri_id='$matid'";
		$exe=mysql_query($upd) or die(mysql_error());
                
                $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$matid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Photo Protect Password";	
                    
                    $message = "
                    <html>
                    <head>
                    <title>You have Updated your Photo Protect Password </title>
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
                                    Matri-id : $matid <br/>
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
		header("location:modify-photo.php");
	}
		if(isset($_REQUEST['photo_protect']))
	{
		$photo_protect=	$_REQUEST['photo_protect'];
		$upd="update register set photo_protect='No',photo_pswd='' where matri_id='$matid'";
		$exe=mysql_query($upd) or die(mysql_error());
                
                $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$matid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Removed your Photo Protect Password";	
                    
                    $message = "
                    <html>
                    <head>
                    <title>You have Removed your Photo Protect Password </title>
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
                                    Matri-id : $matid <br/>
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
		header("location:modify-photo.php");
	}

			
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link type="text/css" rel="stylesheet" href="css/crop/croppic.css" />
<link type="text/css" rel="stylesheet" href="css/crop/main.css" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>  
<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".f_drop_item .f_parent a").click(function() {				
			var toggleId = "#" + this.id.replace(/^link/,"ul"); 	
			$(".f_drop_item .f_child ul").not(toggleId).hide();		 
			$(".f_drop_item .f_parent a").removeClass("selected");
			$(toggleId).toggle();								    
			if($(toggleId).css("display") == "none"){ $(this).removeClass("selected"); }
			else{ $(this).addClass("selected"); }		
		});
		$(".f_drop_item .f_child ul li a").click(function() {				
	 		var text = $(this).html();
	 		$(".f_drop_item .f_parent a span").html(text);			
	 		$(".f_drop_item .f_child ul").hide();				
		});
		$(document).bind('click', function(e) {				 		
		 var $clicked = $(e.target);
		 if (! $clicked.parents().hasClass("f_drop_item")){
			 $(".f_drop_item .f_child ul").hide();			
					$(".f_drop_item .f_parent a").removeClass("selected");}				
			});			
			$('.f_drop_item .f_child ul').bind('click', function(e) {				 		
		 		$(".f_drop_item .f_parent a").removeClass("selected");
			});			
		});
		
		function Protectphoto(toid)
{
	$("#myModal").html("Please wait...");
			$.get("./web-services/upload_photo.php?toid="+toid,
			function(data){
				$("#myModal").html(data);
			});
}
		
</script>
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
                       	
                        
                            <div class="gradient-rev block-level" style="margin-top:20px">
                  <h3>Manage Photos</h3>   
                         
                      
                        <div class="">   
                        
                        <?php
						if($DatabaseCo->dbRow->photo_pswd!='')
						{?>               	
                            <div class="col-sm-12">
                                <div class="col-sm-7">
                          <h4 style="color:green;"> Your Photo is Protected now.</h4></div>
                                <div class="col-sm-5">
            	 <a href="modify-photo.php?photo_protect='remove'" class="btn btn-primary" style="color:white;">Remove Photo Password</a> </div>
                            </div>
                            <?php
						}
						else
						{
						?>
                        <div class="col-sm-12">
                                <div class="col-sm-7">
                           <h5 style="color:red;">Your Photo is Not Protected, please put password to protect it.</h5></div>
                            <div class="col-sm-5 col-xs-12">
              <button class="btn btn-primary btn-m col-xs-12 col-sm-6" data-toggle="modal" data-target="#myModal" 
              onclick="Protectphoto('<?php echo $matid; ?>')">Protect Photo</button> </div>
                            </div>
                         <?php
						}
						?>
                            
                            
                            <div class="row well well-sm" style="margin-top:50px;">                                
                                <div class="col-sm-4 col-xs-12">  
                                <?php if($DatabaseCo->dbRow->photo1=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12"/>
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                <a id="linkg1" style="cursor:pointer;padding-left:18px;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Profile Photo</a> </div>
									  <div class="f_child">
										<ul id="ulg1">
										   <li><a href="modify-photo.php?del=1&image=<?php echo $DatabaseCo->dbRow->photo1;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
                                           <?php if($DatabaseCo->dbRow->photo1=='')
										   {?>
										  <li><a href="crop-photo.php?id=1" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=1" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                                <div class="col-sm-4">                                    
                                 <?php if($DatabaseCo->dbRow->photo2=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12" />
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo2; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                                                                              <a id="linkg2" style="cursor:pointer;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Photo2</a> </div>
									  <div class="f_child">
										<ul id="ulg2">
										   <li><a href="modify-photo.php?del=2&image=<?php echo $DatabaseCo->dbRow->photo2;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
                                             <?php if($DatabaseCo->dbRow->photo2=='')
										   {?>
										  <li><a href="crop-photo.php?id=2" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=2" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										  
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                               <div class="col-sm-4">                                    
                                   <?php if($DatabaseCo->dbRow->photo3=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12" />
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo3; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                                                                              <a id="linkg3" style="cursor:pointer;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Photo3</a> </div>
									  <div class="f_child">
										<ul id="ulg3">
										   <li><a href="modify-photo.php?del=3&image=<?php echo $DatabaseCo->dbRow->photo3;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
                                            <?php if($DatabaseCo->dbRow->photo3=='')
										   {?>
										  <li><a href="crop-photo.php?id=3" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=3" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										  
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                                
                            </div>
                            <div class="clearfix"></div>
                            <div class="row well well-sm">
                                <div class="col-sm-4">
                                                                    
                                   <?php if($DatabaseCo->dbRow->photo4=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12" />
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo4; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                                                                              <a id="linkg4" style="cursor:pointer;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Photo4</a> </div>
									  <div class="f_child">
										<ul id="ulg4">
										   <li><a href="modify-photo.php?del=4&image=<?php echo $DatabaseCo->dbRow->photo4;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
										   <?php if($DatabaseCo->dbRow->photo4=='')
										   {?>
										  <li><a href="crop-photo.php?id=4" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=4" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                                <div class="col-sm-4">                                    
                                  <?php if($DatabaseCo->dbRow->photo5=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12" />
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo5; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                                                                              <a id="linkg5" style="cursor:pointer;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Photo5</a> </div>
									  <div class="f_child">
										<ul id="ulg5">
										   <li><a href="modify-photo.php?del=5&image=<?php echo $DatabaseCo->dbRow->photo5;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
                                            <?php if($DatabaseCo->dbRow->photo5=='')
										   {?>
										  <li><a href="crop-photo.php?id=5" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=5" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										  
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                               <div class="col-sm-4">                                    
                                    <?php if($DatabaseCo->dbRow->photo6=='')
								{?>                                  
                                  <img src="images/nophoto.jpg" class="img-thumbnail col-xs-12 col-sm-12" />
                                <?php
								}
								else
								{?>
        <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo6; ?>&watermark=watermark.png" class="img-thumbnail col-xs-12 col-sm-12" />
								<?php	
								}
								?>
                                    <div class="f_drop_panel">
									<div style="" class="f_drop_item">
									  <div class="f_parent">
                                                                              <a id="linkg6" style="cursor:pointer;"><i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;  Manage Photo6</a> </div>
									  <div class="f_child">
										<ul id="ulg6">
										   <li><a href="modify-photo.php?del=6&image=<?php echo $DatabaseCo->dbRow->photo6;?>"><i class="glyphicon glyphicon-trash"></i> Delete Photo</a></li>
                                            <?php if($DatabaseCo->dbRow->photo6=='')
										   {?>
										  <li><a href="crop-photo.php?id=6" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Upload Photo</a></li>
                                          <?php
										   }
										  else
										  {?>
											  <li><a href="crop-photo.php?id=6" data-toggle="modal"><i class="glyphicon glyphicon-upload"></i> Edit Photo</a></li>
										 <?php }
										  ?>
										  
										</ul>
									  </div>
									</div>
								</div>
                                </div>
                            </div>
                            
                        </div>
                      </div>        
                    </div>
                    </div>
                    </div>
                    </article>
                   
                   
                    </div>
                <!-----------------------top part end-------------------------->
                <?php include "page-part/footer.php";?>
                <?php 	require_once 'chat.php';	?>
        </div>
   
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          
        </div>
   
    
  
    <script src="js/bootstrap.min.js"></script>
   
 </body>
</html>
