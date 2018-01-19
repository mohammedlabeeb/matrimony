<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();


$invoiceid = $_GET['id'];

$chk = mysql_query("SELECT * FROM payments where payid = '$invoiceid' order by payid DESC");
						
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

<body style="background:#ffffff">

<table width="83%" border="0" align="center" cellpadding="5" cellspacing="1" class="text">

  <tr>
    <td colspan="5"><div align="center"><img src="images/<?php echo $configObj->getConfigLogo();?>" /></div></td>
  </tr>
  
  <tr>
    <td colspan="5"><div align="center"><h2>Invoice</div></h2></td>
  </tr> 
   <tr>
    <td colspan="5"><hr /></td>
  </tr>
    <?php 
	while($rowpay = mysql_fetch_array($chk))
	{ 
	?>
  <tr>
    <td width="12%" valign="top" class="red_text">Bill To : </td>
    <td width="41%"><span  style="color:#0066CC; font-weight:bold;"><?php  echo $rowpay['pname']?></span>
      <br /> 
      <?php  echo $rowpay['pemail']?><br />
      <?php  echo $rowpay['paddress']?>
    </span>
    </td>
    <td width="15%" valign="top" class="red_text">Bill From : 
    
    </td>
    <td width="41%" valign="top" class="green_text"><?php echo $configObj->getConfigFname(); ?>
    </span>
    </td>
  </tr>
  
  <tr>
    <td colspan="2" class="greentext"><b>Payment mode : <?php  echo $rowpay['paymode']?></b></td>
    <td colspan="3" class="welcome_content"><div align="right">Date :<?php  echo $rowpay['pactive_dt']?></div></td>
  </tr>
   <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr style="color:white;">
    <td height="23" bgcolor="#ed1c24"><div align="left"><strong>Matri-Id</strong></div></td>
    <td height="23" bgcolor="#ed1c24"><div align="center"><strong>Item</strong></div></td>
    <td width="10%" height="23" bgcolor="#ed1c24"><div align="center"><strong>Qty</strong></div></td>
    <td width="19%" bgcolor="#ed1c24"><div align="center"><strong>Unit Price</strong></div></td>
    <td width="21%" height="23" bgcolor="#ed1c24"><div align="center"><strong>Price</strong></div></td>
  </tr>


  
  <tr>
    <td><?php  echo $rowpay['pmatri_id']?></td>
    <td><?php  echo $rowpay['p_plan']?> Membership for <?php  echo $rowpay['plan_duration']?> days</td>
    <td><div align="center">1</div></td>
    <td><div align="center"><?php  echo $rowpay['p_amount']?></div></td>
    <td><div align="center"><?php  echo $rowpay['p_amount']?> <input type="hidden" name="pamt" value="<?php  echo $rowpay['p_amount']?>" /></div></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr style="color:white; text-align:center;">
    <td>&nbsp;</td>
   <td>&nbsp;</td>
     <td>&nbsp;</td>
    <td bgcolor="#ed1c24"><div align="center"><strong>Total</strong></div></td>
    <td bgcolor="#ed1c24"><div align="center"><span class="Partext1">
      <?php   echo $rowpay['p_amount'];?>
    </span></div></td>
  </tr>
   <?php } ?>
  
 
</table>

<div align="center">
<table width="97%" border="0" cellspacing="1" cellpadding="1">
<tr>
<td><div align="center">
<FORM>
<input class="btn btn-primary" type="button" class="Alert" onClick="window.print()" value="Print Invoice">
</FORM>  
</div></td>
</tr>
</table>

  
</div>
 </center>
</body>
</html>
