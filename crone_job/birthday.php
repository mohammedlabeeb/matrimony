<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
    

$from = $configObj->getConfigFrom();
$webfriendlyname = $configObj->getConfigFname();

$subject="Many Many Happy Return of The Day";
$sql="SELECT * FROM register WHERE DAY(birthdate) = DAY(CURDATE()) AND  MONTH(birthdate) = MONTH(CURDATE())"; 
$r = mysql_query($sql);

while ($row = mysql_fetch_array($r)) {
     $matri_id = $row['matri_id'];
     $fname = $row['firstname'];
     $lname = $row['lastname'];
     $email.= $row['email'].",";   
}
$to=$email;


$subject = "Many Many Happy Return of The Day";	
$message = '<table style="margin: auto; border: 5px solid #43609c; font-family: Arial,Helvetica,sans-serif; font-size: 12px; padding: 0px; width: 710px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="float: left; min-height: auto; border-bottom: 5px solid #43609c;">
<table style="margin: 0px; padding: 0px; width: 710px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="background: #f9f9f9;">
<td style="float: right; font-size: 13px; padding: 10px 15px 0 0; color: #494949;">&nbsp;</td>
<td style="float: left; margin-top: 5px; color: #048c2e; font-size: 26px; padding-left: 15px;">webfriendlyname</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="float: left; width: 710px; min-height: auto;">
<h6 style="float: left; clear: both; width: 680px; font-size: 13px; margin: 10px 0 0 15px;">Hello Dear,</h6>
<p style="float: left; clear: both; width: 680px; font-size: 13px; margin: 10px 0 0 15px; color: #494949;">Happy birthday to you.</p>
<br />
<p style="float: left; clear: both; width: 680px; font-size: 13px; margin: 10px 0 5px 15px; color: #494949;">&nbsp;</p>
<p style="float: left; clear: both; width: 680px; font-size: 13px; margin: 10px 0 0 15px; color: #494949;">Thank you for helping us reach you better,</p>
<p style="float: left; clear: both; width: 680px; font-size: 13px; margin: 10px 0 5px 15px; color: #494949;">Thanks &amp; Regards ,<br />Team webfriendlyname</p>
</td>
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

if($sent)
 
 {
	 echo "Birthday celebrated successfully";
 }
 
 else
 
 {
	 echo "email is not sent, there is some error!";
 }