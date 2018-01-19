<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
  $configObj = new Config();
    

$from = $configObj->getConfigFrom();
$webfriendlyname=$configObj->getConfigFname();
$year=date('Y');
$month=date('m');

echo $sql="SELECT * FROM register WHERE DAY(reg_date) = DAY(NOW()-INTERVAL 1 DAY) and Year(reg_date)='$year' and Month(reg_date)='$month'";
$r=mysql_query($sql);

while ($row = mysql_fetch_array($r)) {
     $matri_id = $row['matri_id'];
     $fname = $row['firstname'];
     $lname = $row['lastname'];
    $email.= $row['email'].",";   
} 
$to=$email;


$subject = "Benefits Of Paid Members";	
$message = '<p><span><strong>Dear Member,</strong></span></p>
<p><span>To avail paid membership will increase your chances of finding the right match &amp; will allow you to connect with your future partner&nbsp; through the medium of your choice - Phone, E-mail, and Chat. You can view verified phone numbers, send personalized messages, and initiate unlimited chats. Members who had previously expressed interest in contacting you and are still awaiting your response. So, don\'t delay your decisions anymore.</span></p>
<p><span>To see contact details of profile(s) you like, and avail other benefits of paid membership</span></p>
<p><span>&nbsp;</span></p>
<ul>
<li style="text-align: justify;"><span style="color: #ff0000; font-size: medium;">See Phone numbers and Email Ids</span> &nbsp;&nbsp; </li>
<li><span style="color: #ff0000; font-size: medium;">Initiate Chats On website </span>&nbsp;&nbsp; </li>
<li><span style="color: #ff0000; font-size: medium;">Send Personalised Messages</span> &nbsp;&nbsp; </li>
</ul>';
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
