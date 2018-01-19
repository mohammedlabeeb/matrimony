<?php
error_reporting(0);
session_start(); 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';

$DatabaseCo = new DatabaseConn();
 $totheid = $_POST['txtTo'];
 $message = $_POST['txtmsg'];
 $subject = "Reply Of your Message";
 $mid = $_SESSION['user_id'];

 $sql = "INSERT INTO messages (mes_id,to_id,from_id,subject,message,sent_date,status) VALUES ('','$totheid','$mid','$subject','$message',now(),'Unread')";
$result = mysql_query($sql);

$sel=mysql_query("SELECT * FROM payments where pmatri_id='$mid'"); 
					$fet=mysql_fetch_array($sel);
					$tot_sms=$fet['p_msg'];
					$use_sms=$fet['r_sms'];
					$use_sms=$use_sms+1;
					if($tot_sms>=$use_sms)
					{
				$update="UPDATE payments SET r_sms='$use_sms' WHERE pmatri_id='$mid' ";
						$d=mysql_query($update);
					}
$result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$totheid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                    $name = $rowcc['username'];                     
                    $subject = "New Message received";	                    
                    $message = "
                    <html>
                   
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

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                            You have received new message in $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $totheid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";

                          $headers  = 'MIME-Version: 1.0' . "\r\n";
                          $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                          $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);

echo "Your message has been sent successfully.";					
										

?>
