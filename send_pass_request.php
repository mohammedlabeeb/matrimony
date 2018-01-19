<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	
	$recever_id = $_GET['id'];
	

if(isset($_REQUEST['req-password']))
{
	$msg=$_REQUEST['msg'];
	$strresponse = "Pending";
	$receiver = $recever_id;
	
	
	$insert = mysql_query("insert into photoprotect_request(ph_requester_id,ph_receiver_id,ph_msg,ph_reqdate,
	receiver_response,status) values ('$mid','$receiver','$msg',now(),'$strresponse','1')")
or die("Could not insert data because ".mysql_error());
	$result="Your Request has been Sent to the member Successful.<br /><br />
 (Note : Your Request password will be sent to your email after your receiver responded.) ";

};
						
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>


</head>

<body >

<table width="83%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">

  <tr>
    <td colspan="5"><div align="left"><img src="images/<?php echo $configObj->getConfigLogo();?>" /></div></td>
  </tr>
  
 <?php
 if(isset($_REQUEST['req-password']))
 {?>
   <tr>
    <td colspan="5" style="color:green;"><h5><?php if(isset($result)){ echo $result; }?></h5></td>
  </tr>
  <?php
 }
 
else
{?>

<tr>
<td>
<form method="post">
<tr>
<td colspan="2">
<input type="radio" checked="checked" value="We found your profile to be a good match. Please send me Photo password to proceed further." name="msg" />We found your profile to be a good match. Please send me Photo password to proceed further.<br /><br />
<input type="radio" value="I am interested in your profile. I would like to view photo now, send me password." name="msg" />I am interested in your profile. I would like to view photo now, send me password.

</td>
</tr>
<tr>
<td colspan="2" align="center" height="20">

</td>
</tr>


<tr>
<td colspan="2" align="center">
<input class="btn btn-primary" type="submit" name="req-password"  value="Send Request">

<a href="viewprotectphotoform.php?id=<?php echo $recever_id;?>"><input class="btn btn-primary" type="button" name="req-password" value="Click here if you have password"></a>
</td>
</tr>
</form>  
</td>
</tr>


<?php
}
?>
</table>
</body>
</html>
