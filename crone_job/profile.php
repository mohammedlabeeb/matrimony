<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
  $configObj = new Config();
    

$from = $configObj->getConfigFrom();
$webfriendlyname = $configObj->getConfigFname();

$subject="Your Profile is completed less than 70%";
$sql="SELECT * FROM register WHERE profileby='' AND reference='' AND birthtime='' AND birthplace='' AND photo1='' AND emp_in='' AND subcaste='' AND gothra='' AND star='' AND horoscope='' AND manglik='' AND b_group='' AND complexion='' AND bodytype='' AND diet='' AND smoke='' AND drink='' AND residence='' ";
$r=mysql_query($sql);

while ($row = mysql_fetch_array($r)) {
     $matri_id = $row['matri_id'];
     $fname = $row['firstname'];
     $lname = $row['lastname'];
     $email.= $row['email'].",";   
}
$to=$email;



$message = '<table style="width: 650px;">
<tbody>
<tr>
<td colspan="2">Complete your profile &amp; get <strong style="color: #c20;">12 times more response</strong></td>
</tr>
<tr>
<td colspan="2">When it comes to choosing a life partner, getting more information always helps to make a better decision. So make your profile stronger by adding more information about your</td>
</tr>
<tr>
<td><strong style="color: #c20;">Education &amp; college</strong></td>

</tr>
<tr>
<td><strong style="color: #c20;">Occupation &amp; Company</strong></td>

</tr>
<tr>
<td><strong style="color: #c20;">Life Style</strong></td>

</tr>
<tr>
<td><strong style="color: #c20;">Add More Pics</strong></td>

</tr>
<tr>
<td colspan="2">Regards ,<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>webfriendlyname</strong></td>
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
