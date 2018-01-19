<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
  $configObj = new Config();
    

$from = $configObj->getConfigFrom();
$webfriendlyname=$configObj->getConfigFname();

$today=date('Y-m-d', strtotime("+1 days"));
$subject="Your Paid membership will expired tomorrow";
$sql="SELECT * FROM payments WHERE exp_date='$today'";
$r=mysql_query($sql);
while ($row = mysql_fetch_array($r)) {
      $matri_id = $row['pmatri_id'];
      $name = $row['pname'];
      $exp_date = $row['exp_date'];
      $email.= $row['pemail'].",";      
}
$to=$email;

$subject = 'Paid Member Expiry';	
$message = '<table style="width: 100%; border: 0;">
<tbody>

<tr>
<td>
<p>Dear Member, <br /><br /> As a token of appreciation for being a loyal member of our website, we would like to inform you that your paid subscription is going to expire in this month. you may avail this service till .......... please renew your membership by visiting our paid membership page or email us.</strong> <br /><br />To avail uninterrupted service Do not miss it </p>
</td>
</tr>
<tr>
<td>Regards ,<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>webfriendlyname </strong></td>
</tr>
</tbody>
</table>';
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("webfriendlyname" =>$webfriendlyname);

$email_template = strtr($email_template, $trans);

		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
		$headers .= "BCC: " . $to . "\r\n";



if($to!='')
{
$sent = mail('', $subject, $email_template, $headers);
}


echo '<br>';


if($sent)
 
 {
	 echo "sent";
 }
 
 else
 
 {
	 echo "Not sent";
 }
