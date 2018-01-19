<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
  $configObj = new Config();
    

$from = $configObj->getConfigFrom();
$webfriendlyname = $configObj->getConfigFname();
$year=date('Y');
$month=date('m');


$sql="SELECT * FROM expressinterest WHERE DAY(ei_sent_date) = DAY(NOW()-INTERVAL 1 DAY) and Year(ei_sent_date)='$year' and Month(ei_sent_date)='$month' AND receiver_response='Pending'";
$r1=mysql_query($sql);

while($r=  mysql_fetch_array($r1))
{
 $id.=$r['ei_receiver'].",";
}
$id1=str_replace(",","','",$id);
$query=  mysql_query("SELECT * FROM register WHERE matri_id IN ('$id1')");
while ($row = mysql_fetch_array($query)) {
    $matri_id = $row['matri_id'];
     $email.= $row['email'].",";   
    $name = $row['username'];
}
$to=$email;


$subject = "You have received Express Interest Yesterday please respond";	
$message = '<table>
<tbody>
<tr>
<td>
<p>Dear Member, <br /><br />We are glad to inform you that from webfriendlyname someone has liked and shown interest in your profile. Do not keep him/her waiting. She/he could be the one for you to whom you were waiting for the long time</p>
</td>
</tr>
<tr>
<td>

</td>
</tr>
<tr>
Thank you for choosing us to reach you better, <br /> Regards ,<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;webfriendlyname</td>
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
