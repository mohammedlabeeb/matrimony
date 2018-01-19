<?php

	session_start();
	require_once('dbConf.php');
	class DatabaseConn
	{
		var $dbLink;
		var $sqlQuery;
		var $dbResult;
		var $dbRow;
		
		
		function __construct()
		{
			$this->dbLink = '';
			$this->sqlQuery = '';
			$this->dbResult = '';
			$this->dbRow = '';
			
			/**************
			* End databse parameter
			*****************/
			
			
			$this->dbLink = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			mysql_select_db(DB_DATABASE, $this->dbLink);
			mysql_query("set names 'utf8'",$this->dbLink);
		}
		function convertToLocalHtml($localHtmlEquivalent)
		{
			$localHtmlEquivalent = mb_convert_encoding($localHtmlEquivalent,"HTML-ENTITIES","UTF-8");
			return $localHtmlEquivalent;
		}

		function getSelectQueryResult($selectQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $selectQuery;
			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			return $this->dbResult;
		}
		function updateData($updateQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $updateQuery;

			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			
			if($this->dbResult)
				return true;
			else
				return false;
		}
	}
    include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	require_once("../BusinessLogic/class.adminuser.php");
	
	require_once("../class/Config.class.php");
	$configObj = new Config();
	$ans="";
    
	if(isset($_POST['submit']))
	{		
		$email=$_POST['forgotlogid'];		
		$sql="select * from admin_users where email='$email' and status='1'";
		$res=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($res);
		if(mysql_num_rows($res)>0)
		{
			
			$email=$row['email'];
			$uname=$row['uname'];
			$passwd=rand(1111111111,9999999999);
			$upasswd=md5($passwd);
			$sql="update admin_users set pswd='$upasswd' where email='$email'";
			mysql_query($sql) or mysql_error();
			
		

$from = $configObj->getConfigFrom();
$ToSubject = "Password Recovery from Matrimonial Site";



$message =  "<html>
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

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>Change password request</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                            Your password has been changed.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, Admin <br/>
									
									Username is : $uname <br/>
                                    
                                    New Password is : $passwd <br/>                                    
                                    </b></p>
                         
                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
		
		
		
	    $sentmail=mail($email,$ToSubject,$message,$headers);
	
					if(isset($sentmail))
							{
						      $ans= "Your Password Has Been Sent to Your Email ID";								
								
                            }
							else
							{
                              $ans= "Cannot send password to your e-mail address";   
							   
                            }		
	}	
	
							
	else
	{
	 $ans= "Provided email id is wrong, Please enter correct email id.";	
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Password Recovery Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
 <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.horizontal.scroll.css" />
		<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
		<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />
<script language="Javascript">
function Validatemail(frm2)
{ 

var expression=/^([a-zA-Z0-9\-\._]+)@(([a-zA-Z0-9\-_]+\.)+)([a-z]{2,5})$/;

if(document.forms.frm2.forgotlogid.value=="")
{
alert("Please enter your email address.");
document.forms.frm2.forgotlogid.focus();
return false;
}
if (!expression.test(document.forms.frm2.forgotlogid.value))
{
      alert("Invalid email address.");
      document.forms.frm2.forgotlogid.focus();
      return false;
 }

 	
 return true;		
}
</script>	
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
</head>
<body id="login-body">
 	<div id="logo-wrapper">
    	<h2 class="logo">Forget Login Details</h2>
    
    	<div class="login-box cf">
    		<h4>
            Kindly provide your Email ID to get your password. Your new password will be sent to your email. </h4>
           <form name="frm2" method="post" action="" onSubmit="return Validatemail(frm2);">
             
            	<p class="error-msg-text">
            	
            	 <?php
					if(!empty($ans))
					{	
					
							echo  $ans;
					}
			?>
            	</p>
                <p><label  class="email-label">Email</label></p>
                <p><input type="text" class="email-desc" name="forgotlogid" id="forgotlogid"/></p>
               
                <p><input type="submit" name="submit" value="Submit" class="login-btn"/>
                <input type="submit" name="submit" value="Cancle" class="login-btn" onclick="window.location='index.php'"/>
               
                </p>
            </form>
    	</div>
    </div>
</body>
</html>
