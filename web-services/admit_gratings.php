<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$DatabaseCo = new DatabaseConn();


 $receiver = $_POST['txtTo'];
 $song = $_POST['song'];
 $message = $_POST['message'];
 $sender = $_SESSION['user_id'];

$sql = "INSERT INTO gratings (sender,receiver,song,type,message,date) VALUES ('$sender','$receiver','$song','Mp3','$message',now())";
$result = mysql_query($sql) or die(mysql_error());


$result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$receiver'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['username'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];                    
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                    $from = $rowcc['from_email'];
                    $to = $rowcc['email'];
                    
                   
            

                $subject = "A greeting received.";	
                $message = '<table style="margin: auto; border: 5px solid #43609c; font-family: Arial,Helvetica,sans-serif; font-size: 12px; padding: 0px; width: 710px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="float: left; min-height: auto; border-bottom: 5px solid #43609c;">
<table style="margin: 0px; padding: 0px; width: 710px;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="background: #f9f9f9;">
<td style="float: left; margin-top: 5px; color: #048c2e; font-size: 26px; padding-left: 15px;">webfriendlyname</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="float: left; width: 710px; min-height: auto;">
<h6 style="float: left; clear: both; width: 500px; font-size: 13px; margin: 10px 0 0 15px;">Hello, Dear</h6>
<p style="float: left; clear: both; width: 500px; font-size: 13px; margin: 10px 0 0 15px; color: #494949;">You have recived a greeting from someone. Please Log on to <a href="website">webfriendlyname</a> now.</p>
<p style="float: left; clear: both; width: 500px; font-size: 13px; margin: 10px 0 0 15px; color: #494949;">Thank you for helping us reach you better,</p>
<p style="float: left; clear: both; width: 500px; font-size: 13px; margin: 10px 0 5px 15px; color: #494949;">Thanks &amp; Regards ,<br />Team webfriendlyname</p>
</td>
</tr>
</tbody>
</table>';
				
                $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
                $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"Dear"=>$name);

                $email_template = strtr($email_template, $trans);
				
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
				$headers .= 'From:'.$from."\r\n";


mail($to,$subject,$email_template,$headers);


echo "Your greeting has been submitted successfully.";

?>
