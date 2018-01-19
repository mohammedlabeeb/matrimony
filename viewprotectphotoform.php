<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	
	$recever_id = $_GET['id'];
	

if(isset($_REQUEST['submit']))
{
	
	$receiver = $recever_id;
	$pass = $_REQUEST['pass'];
	
	
	$sel = mysql_query("select * from register where matri_id='$recever_id' and photo_pswd='$pass'")
or die("Could not insert data because ".mysql_error());
	$num=mysql_num_rows($sel);
	if($num>0)
	{
		 header("location:view_photo_album.php?matri_id=$receiver");
	}
	else
	{
		$result="Given Passowrd is wrong.";
	}

};
						
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>  
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>


</head>

<body bgcolor="#FCECD6">

<table width="83%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">
  <tr>
    <td colspan="5"><div align="left"><img src="images/<?php echo $configObj->getConfigLogo();?>" /></div></td>
  </tr>
  
  <tr>
    <td colspan="5"><div align="left"><h4>View Protected Photo</h4></div></td>
  </tr>
  
  
 <?php
 if(isset($result))
 {?>
   <tr>
    <td colspan="5" style="color:green;"><h5><?php if(isset($result)){ echo $result; }?></h5></td>
  </tr>
  <?php
 }
 ?>
<tr>
<td colspan="2">
The Photo has been protected by the owner of this profile. Members are given the feature to protect their Photo from viewing by anyone. If the Photo is protected, then you need a Photo Password to view it. 
</td>
</tr>
<tr>
<td>
<form method="post">
<tr>
<td colspan="2">
Enter Password
<input type="text"  name="pass" id="pass" />

</td>
</tr>
<tr>
<td colspan="2" align="center" height="20">

</td>
</tr>


<tr>
<td colspan="2" align="left">
<input class="btn btn-primary" type="submit" name="submit"  value="Submit">

<a href="send_pass_request.php?id=<?php echo $recever_id;?>"><input class="btn btn-primary" type="button" name="req-password" value="Don't have password"></a>
</td>
</tr>
</form>  
</td>
</tr>


</table>
</body>
</html>
