<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
	
	if(isset($_REQUEST['edit-profile-desc']))
	{
		$p_text=htmlspecialchars($_REQUEST['p_text'],ENT_QUOTES);
		$update = mysql_query("update register set profile_text='$p_text' where matri_id='$mid'");
		
                    
                    $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Profile Desciption";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                    header("location:edit-profile.php?success-desc#profile-desc");
	}
	if(isset($_REQUEST['edit-basic-detail']))
	{
		$fname = htmlspecialchars($_REQUEST['fname'],ENT_QUOTES);
		$lname = htmlspecialchars($_REQUEST['lname'],ENT_QUOTES);
		$MaritalStatus = $_REQUEST['m_status'];
		$Profileby = $_REQUEST['profileby'];
		$m_tongue = implode(',',$_REQUEST['mtongue']);
		$reference = $_REQUEST['reference'];
		$birth_place =$_REQUEST['birthplace'];
		$birth_time = htmlspecialchars($_REQUEST['birthtime'],ENT_QUOTES);
		
		$update = mysql_query("UPDATE register set username='$fname $lname',firstname='$fname',lastname='$lname',m_status='$MaritalStatus',profileby='$Profileby',m_tongue='$m_tongue',reference='$reference',birthtime='$birth_time',birthplace='$birth_place' where matri_id='$mid'");
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Basic Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-basic#basic-details");		
	}
	if(isset($_REQUEST['edit-social-detail']))
	{
		$religion_id =$_REQUEST['religion_id'];
		$caste =$_REQUEST['caste_id'];
		$subcaste = htmlspecialchars($_REQUEST['subcaste'],ENT_QUOTES);
		$horoscope = $_REQUEST['horoscope'];
		$manglik =$_REQUEST['manglik'];
		$star = $_REQUEST['star'];
		$gothra = htmlspecialchars($_REQUEST['gothra'],ENT_QUOTES);
		$moonsign =$_REQUEST['moonsign'];
		
		$update = mysql_query("UPDATE register set religion='$religion_id',caste='$caste',subcaste='$subcaste',gothra='$gothra',star='$star',moonsign='$moonsign',horoscope='$horoscope',manglik='$manglik' WHERE matri_id='$mid'");
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Social Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not updated your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-social#social-details");		
	}
	if(isset($_REQUEST['edit-edu-detail']))
	{
		$edu = implode(',',$_POST['txtEducation']);
		$occ = $_POST['txtOccupation'];
		$emp = $_POST['txtempin'];
		$inc = $_POST['txtAnnualincome'];
		
		$update = mysql_query("UPDATE register set edu_detail='$edu',occupation='$occ',emp_in='$emp',
		income='$inc' WHERE matri_id='$mid'");
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Education Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-edu#edu-details");		
	}
	if(isset($_REQUEST['edit-physical-detail']))
	{
		$hieght = $_POST['txtHeight'];
		$weight = $_POST['txtWeight'];
		$complexion = $_POST['txtComplexion'];
		$body = $_POST['txtBody'];
		$b_group = $_POST['txtBlood'];
		$diet = $_POST['txtDiet'];
		$drink = $_POST['drink'];
		$smoke = $_POST['smoke'];
		
		$update = mysql_query("UPDATE register set height='$hieght',weight='$weight',b_group='$b_group',
		complexion ='$complexion',bodytype='$body',diet='$diet',smoke='$smoke',drink='$drink' WHERE 
		(matri_id='$mid')") or die(mysql_error());
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Physical Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-phy#phy-details");	
	}
	if(isset($_REQUEST['edit-contact-detail']))
	{
		$address = htmlspecialchars($_POST['txtFullAddress']);
		$country = $_POST['txtCountry'];
		$state = $_POST['cbo1State'];
		$city = $_POST['cbo1City'];
		$mobile = $_POST['txtMobile'];
		$phone = $_POST['phone'];
		$residence = $_POST['residence'];
		$time_to_call = $_POST['time_to_call'];
		
		$update = mysql_query("UPDATE register set address='$address',country_id='$country',
		state_id='$state',city ='$city',phone='$phone',mobile='$mobile',
		time_to_call='$time_to_call',residence='$residence' WHERE (matri_id='$mid')") or die(mysql_error());
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Contact Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-contact#contact-details");	
	}
	if(isset($_REQUEST['edit-family-detail']))
	{
		$fdetail =htmlspecialchars($_POST['txtFamilyDetails']);
		$ftype = htmlspecialchars($_POST['txtFamilyType']);
		$fstatus = $_POST['txtFamilyStatus'];
		$nob =$_POST['txtNoBrothers'];
		$nomb = $_POST['nbm'];
		$nos = $_POST['txtnoofsisters'];
		$noms = $_POST['nsm'];
		$fname = htmlspecialchars($_POST['txtFathername']);
		$focc = htmlspecialchars($_POST['txtFathersoccupation']);
		$mname = htmlspecialchars($_POST['txtMothername']);
		$mocc = htmlspecialchars($_POST['txtMothersoccupation']);
		$family_origin = htmlspecialchars($_POST['family_origin']);
		
		$update = mysql_query("UPDATE register set family_details='$fdetail',family_type='$ftype',
		family_status='$fstatus',family_origin='$family_origin',no_of_brothers ='$nob',no_of_sisters='$nos',no_marri_brother='$nomb',
		no_marri_sister='$noms',father_name='$fname',mother_name='$mname',father_occupation='$focc',
		mother_occupation='$mocc' WHERE (matri_id='$mid')") or die(mysql_error());
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your family Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-family#family-details");	
	}
	if(isset($_REQUEST['edit-partner-detail']))
	{
		$Fromage = $_POST['Fromage'];
		$ToAge = $_POST['ToAge'];
		$txtlooking = implode(', ',$_POST['txtlooking']);
		$txtPPE = htmlspecialchars($_POST['txtPPE']);
		$txtPcountry = implode(',',$_POST['txtPcountry']);
		$txtPHeight =$_POST['txtPHeight'];
		$txtPReS = $_POST['txtPReS'];
		$txtComplexion = implode(', ',$_POST['txtComplexion']);
		$txtEducation = implode(',',$_POST['txtEducation']);
		$txtreligion = implode(',',$_POST['txtreligion']);
		$caste_id = implode(',',$_POST['part_caste_id']);
		$part_m_tongue = implode(',',$_POST['part_m_tongue']);
		$residence = $_POST['residence'];
		$part_income = $_POST['part_income'];
		
		$update = mysql_query("UPDATE register set part_frm_age='$Fromage',part_to_age='$ToAge',
		looking_for='$txtlooking',part_expect='$txtPPE',part_height='$txtPHeight',part_height_to='$txtPReS',
		part_complexation='$txtComplexion',part_edu='$txtEducation',part_religion='$txtreligion',
		part_caste='$caste_id',part_resi_status='$residence',part_country_living='$txtPcountry',part_income='$part_income',part_mtongue='$part_m_tongue '
		WHERE (matri_id='".$mid."')") or die(mysql_error());
		
                 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Partner Preference";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                header("location:edit-profile.php?success-partner-details#partner-details");
	}
	if(isset($_REQUEST['edit-hobby-desc']))
	{
		$hobby=htmlspecialchars($_REQUEST['hobby']);
		$update = mysql_query("update register set hobby='$hobby' where matri_id='$mid'");
		 $result3 = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid'");
                    $rowcc = mysql_fetch_array($result3);
                    $name = $rowcc['firstname']." ".$rowcc['lastname'];
                    $matriid = $rowcc['matri_id'];
                    $cpass = $rowcc['cpassword'];
                    $website = $rowcc['web_name'];
                    $webfriendlyname = $rowcc['web_frienly_name'];
                     $from = $rowcc['from_email'];
                     $to = $rowcc['email'];
                     $name = $rowcc['username'];
                    $subject = "You Just Updated your Hobby and Interest Details";	
                    
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
                            You have updated your $webfriendlyname site profile, Below is your details.
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Dear, $name <br/>
                                    Matri-id : $mid <br/>
                                    Email-ID : $to <br/>                                    
                                    </b></p>
                           <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>If you did not update your profile then go to your account and change password immediately,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'></p>
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
                
                header("location:edit-profile.php?success-hobby#hobby-details");
	}

	?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<?php include "page-part/head.php";?>
</head>
<body>	
<div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>		

		
<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						<?php include('page-part/accountsidebar.php'); ?>
						<?php
			$SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
			$DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
				?>	
						
						<div class="main-area gradient-rev">
								<div class="panel panel-success">
                <div class="panel-heading">
                <i class="glyphicon glyphicon-share"></i> Entering your contact details on public profile fields like 'Name', 'Profile Description', 'City', etc.. is not allowed in Our Matrimonial Site, Request you to do not initiate proposals with members who breaks our rule. </div>
     		</div> 
								<div class="myaccount profile" style="margin-top:0px;">
									<div class="left">
										<div class="avathar">
											 <?php
                  if($DatabaseCo->dbRow->photo1!="")
                     {
               ?>
               <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" />
               <?php 
					}												 
				 else
					{   
                 if($DatabaseCo->dbRow->gender=='Male')
                    {
                ?>
                <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" />
                <?php 
				    }
			    else
				    { 
			    ?>
                <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" />
                 <?php
				    } 
					}
				 ?>  
										</div>
										<div class="contact-details">
											<button class="mail"><i class="ion-android-mail"></i><?php echo $DatabaseCo->dbRow->email; ?></button>
											<button class="call"><i class="ion-android-call"></i><?php echo $DatabaseCo->dbRow->phone; ?></button>
											<button class="address"><i class="ion-android-location"></i><?php echo $DatabaseCo->dbRow->city_name; ?>, <?php echo $DatabaseCo->dbRow->state_name; ?></button>
										</div>
									</div>
									<div class="right">
										<div class="top">
											<table class="profile-details">
												<tbody>
													<tr><td><label>Profile ID</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->matri_id; ?></td></tr>
													<tr><td><label>Name</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->username; ?></td></tr>
													<tr><td><label>Membership</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->status; ?>(<?php $exe=$DatabaseCo->dbRow->matri_id;
        $select=mysql_query("select * from payment_view where pmatri_id='$exe'") or die(mysql_error());
                     $fet=mysql_fetch_array($select); echo $fet['p_plan']; ?>)</td></tr>
													<tr><td><label>Looking</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->looking_for; ?></td></tr>
													<tr><td><label>Posted by</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->profileby; ?></td></tr>
													<tr><td><label>Created</label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->reg_date)); ?></td></tr>
													<tr><td><label>Last Login</label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->last_login)); ?></td></tr>
												</tbody>
											</table>
										</div>
										<div class="bottom">
										<p><?php echo $DatabaseCo->dbRow->profile_text; ?></p>
										</div>
									</div>
								</div>
								
							</div><!-- Main Area -->
							<div class="clear:both"></div>
							<div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id='basic-details'>  
            <div class="panel-heading">
              <h3 class="panel-title col-sm-8 col-xs-8">Profile Description &nbsp;&nbsp;&nbsp;
                 <?php if(isset($_GET['success-desc'])){?>
                   <span style="color:green;">Profile Edited Successfully...</span>
				 <?php } ?>
              </h3>
              <a data-toggle="modal" class="pull-right text-right col-sm-4 col-xs-4" title="Profile Details" data-target="#myModal1" onclick="getprofileDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')">
                   <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
              </a>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
              <p class="text-left"> <?php echo $DatabaseCo->dbRow->profile_text; ?></p> 
            </div>            
            
          </div>          
         <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id='social-details'>           
            <div class="panel-heading">
              <h3 class="panel-title col-sm-8 col-xs-8">Basic Information&nbsp;&nbsp;&nbsp;
                <?php if(isset($_GET['success-basic'])){?><span style="color:green;">
                  Profile Edited Successfully...</span><?php } ?>
              </h3>
              <a data-toggle="modal" title="Basic Details" data-target="#myModal2" onclick="getBasicDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-sm-4 col-xs-4 text-right ">
		         <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
              </a>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">
                      <span class="col-sm-5 col-xs-6 line-break">Name</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				         <?php echo $DatabaseCo->dbRow->username; ?>
                      </span>
                  </div>
                  <div class="row margin-top-5px">
                      <span class="col-sm-5 col-xs-6 line-break">Marital Status</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php echo $DatabaseCo->dbRow->m_status; ?>
                      </span>
                  </div>
                  <div class="row margin-top-5px">
                      <span class="col-sm-5 col-xs-6 line-break">Mother Tongue</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php $B=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS mtongue_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.m_tongue) >0 WHERE a.matri_id = '$mid'  GROUP BY a.m_tongue"));
				echo $B['mtongue_name']; ?>
                      </span>
                  </div>
                  <div class="row margin-top-5px">
                      <span class="col-sm-5 col-xs-6 line-break">Birth Place</span>  
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php if($DatabaseCo->dbRow->birthplace==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->birthplace;} ?>
                      </span>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                   <div class="row margin-top-5px">	
                      <span class="col-sm-5 col-xs-6 line-break">Age</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php echo floor((time() - strtotime($DatabaseCo->dbRow->birthdate))/31556926); ?> Years
                      </span>
                   </div>
                   <div class="row margin-top-5px">	
                      <span class="col-sm-5 col-xs-6 line-break">Reference By</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php echo $DatabaseCo->dbRow->reference; ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">	
                   	  <span class="col-sm-5 col-xs-6 line-break">Profile Created By</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php echo $DatabaseCo->dbRow->profileby; ?>
                      </span>
                   </div>
                   <div class="row margin-top-5px">	
					  <span class="col-sm-5 col-xs-6 line-break">Birth Time</span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php if($DatabaseCo->dbRow->birthtime==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->birthtime;} ?>
                      </span>
                   </div>                  
                </div>
             </div>
          </div>
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="edu-details">
            <div class="panel-heading">
               <h3 class="panel-title col-sm-8 col-xs-8">Socio Religious Attributes&nbsp;&nbsp;&nbsp;
			       <?php if(isset($_GET['success-social'])){?>
                   <span style="color:green;">
                      Profile Edited Successfully...
                   </span>
				   <?php } ?>
               </h3>
               <a data-toggle="modal" title="Socio Religious Details" data-target="#myModal3" onclick="getsocialDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-4 col-sm-4 pull-right text-right">
		          <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
               </a>
               <div class="clearfix"></div>
           </div>
           <div class="panel-body">             	
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">	
                     <span class="col-sm-5 col-xs-6 line-break">Religion</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php echo $DatabaseCo->dbRow->religion_name; ?>
                     </span>
                  </div>
                  
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Caste</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php echo $DatabaseCo->dbRow->caste_name; ?>
                     </span>
                  </div>
                  
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Horoscope</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php echo $DatabaseCo->dbRow->horoscope; ?>
                     </span>
                  </div>
                  
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Manglik</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php echo $DatabaseCo->dbRow->manglik; ?>
                     </span>
                  </div>
                  
                 </div>
                 <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                   <div class="row margin-top-5px">	
                    <span class="col-sm-5 col-xs-6 line-break">Sub caste</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php if($DatabaseCo->dbRow->subcaste==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->subcaste;} ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">	
                     <span class="col-sm-5 col-xs-6 line-break">Gothra</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php if($DatabaseCo->dbRow->gothra==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->gothra;} ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">	
                     <span class="col-sm-5 col-xs-6 line-break">Star</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php echo $DatabaseCo->dbRow->star; ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">	
                     <span class="col-sm-5 col-xs-6 line-break">Moonsign</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					   <?php echo $DatabaseCo->dbRow->moonsign; ?>
                     </span>
                   </div>                  
                 </div>
                
            </div>
          </div>
          
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="phy-details">
            <div class="panel-heading">
              <h3 class="panel-title col-sm-8 col-xs-8">Education and Occupation&nbsp;&nbsp;&nbsp;
			    <?php if(isset($_GET['success-edu'])){?>
                  <span style="color:green;">
                    Profile Edited Successfully...
                  </span>
				<?php } ?>
             </h3>
             <a data-toggle="modal" title="Education Details" data-target="#myModal4" onclick="getEduDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-4 col-sm-4 pull-right text-right">
             	<button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
             </a>
             <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Education </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php $c=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '$mid'  GROUP BY a.edu_detail"));
				echo $c['edu_name']; ?>
                     </span>
                  </div>
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Occupation</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					   <?php echo $DatabaseCo->dbRow->ocp_name; ?>
                     </span>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">	
                	<span class="col-sm-5 col-xs-6 line-break">Annual income</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					   <?php if($DatabaseCo->dbRow->income==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->income;} ?>
                    </span>
                  </div>
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Employed In</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					   <?php if($DatabaseCo->dbRow->emp_in==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->emp_in;} ?>
                    </span>
                  </div>
               </div>
             </div>
          </div>
          
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="contact-details">
            <div class="panel-heading">
              <h3 class="panel-title col-xs-9 col-sm-8">Physical Attributes&nbsp;&nbsp;&nbsp;
			    <?php if(isset($_GET['success-phy'])){?>
                   <span style="color:green;">
                     Profile Edited Successfully...
                   </span>
			    <?php } ?>
             </h3>
             <a data-toggle="modal" title="Physical Details" data-target="#myModal5" onclick="getPhyDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-3 col-sm-4 pull-right text-right">
		        <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
             </a>
             <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Height</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				      <?php echo $DatabaseCo->dbRow->height; ?>
                   </span>
                 </div>
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Complexion  </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php echo $DatabaseCo->dbRow->complexion; ?>
                   </span>
                 </div>
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Blood Group </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php echo $DatabaseCo->dbRow->b_group; ?>
                   </span>
                 </div>
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Smoke</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php echo $DatabaseCo->dbRow->smoke; ?>
                   </span>
                 </div>
               </div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Weight </span>
                   <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php echo $DatabaseCo->dbRow->weight; ?>Kgs
                   </span>
                 </div>
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Body type</span>
                   <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php echo $DatabaseCo->dbRow->bodytype; ?>
                   </span>
                 </div>
                 <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Diet</span>
                   <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				     <?php if($DatabaseCo->dbRow->diet==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->diet;} ?>
                   </span>
                </div>
                <div class="row margin-top-5px">
                   <span class="col-sm-5 col-xs-6 line-break">Drink </span>
                   <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				      <?php echo $DatabaseCo->dbRow->drink; ?>
                   </span>                  
                </div>
              </div>
            </div>
          </div>
        
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="family-details">
           <div class="panel-heading">
              <h3 class="panel-title col-xs-8 col-sm-8">Contact Details&nbsp;&nbsp;&nbsp;
			   <?php if(isset($_GET['success-contact'])){?>
                 <span style="color:green;">Profile Edited Successfully...</span>
		       <?php } ?>
              </h3>
              <a data-toggle="modal" title="Contact Details" data-target="#myModal6" onclick="getConDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-3 col-sm-4 pull-right text-right">
		        <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
              </a> 
              <div class="clearfix"></div>            
           </div>
           <div class="panel-body">             	
                <div class="col-xs-12">
                    <span class="col-sm-2 col-xs-5 line-break text-left pull-left" style="padding-left:0;  width: 19.5%;">Address</span>  
                    <span class="col-sm-6 col-xs-7 padding-left-right-zero-small line-break">
					   <?php echo $DatabaseCo->dbRow->address; ?>
                    </span>                                          
               	</div>
                <div class="clearfix"></div>
                <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                    <div class="row margin-top-5px">             
                       <span class="col-sm-5 col-xs-6 line-break">Country</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php echo $DatabaseCo->dbRow->country_name; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">  
                       <span class="col-sm-5 col-xs-6 line-break">State </span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php echo $DatabaseCo->dbRow->state_name; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">City</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php echo $DatabaseCo->dbRow->city_name; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Residence Status</span> 
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php if($DatabaseCo->dbRow->residence==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->residence;} ?>
                       </span>                  
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                      <div class="row margin-top-5px">	
                        <span class="col-sm-5 col-xs-6 line-break">Mobile</span>
                        <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
						   <?php echo $DatabaseCo->dbRow->mobile; ?>
                        </span>
                      </div>
                      <div class="row margin-top-5px">
                        <span class="col-sm-5 col-xs-6 line-break">Phone</span>
                        <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
						   <?php if($DatabaseCo->dbRow->phone==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->phone;} ?>
                        </span>
                      </div>
                      <div class="row margin-top-5px">
                        <span class="col-sm-5 col-xs-6 line-break">Time to call</span>
                        <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
						<?php echo $DatabaseCo->dbRow->time_to_call; ?>
                        </span>
                      </div>
                   </div>
                </div>
          </div>          
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="partner-details">
            <div class="panel-heading">
                <h3 class="panel-title col-xs-8 col-sm-8">Family Details&nbsp;&nbsp;&nbsp;
				   <?php if(isset($_GET['success-family'])){?>
                    <span style="color:green;">
                       Profile Edited Successfully...
                    </span>
			      <?php } ?>
               </h3>
               <a data-toggle="modal" title="Family Details" data-target="#myModal7" onclick="getFamDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-3 col-sm-4 pull-right text-right" >
		           <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
               </a>
               <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
               <div class="col-xs-12">
                 <span class="col-sm-2 col-xs-6 line-break text-left pull-left" style="padding-left:0;  width: 19.5%;">Family Details </span>  
                 <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break"><?php if($DatabaseCo->dbRow->family_details==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_details;} ?>
                  </span>        
               </div>
               <div class="clearfix visible-xs"></div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Father Name  </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->father_name==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->father_name;} ?>
                    </span>
                  </div>
                  <div class="clearfix visible-xs"></div>
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Father Occupation </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->father_occupation==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->father_occupation;} ?>
                    </span>
                  </div>
                  <div class="clearfix visible-xs"></div>
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Mother Name </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->mother_name==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->mother_name;} ?>
                    </span>
                  </div>
                  <div class="clearfix visible-xs"></div>
                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Mother Occupation </span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->mother_occupation==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->mother_occupation;} ?>
                    </span>
                  </div>                  

                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Total Sisters</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php echo $DatabaseCo->dbRow->no_of_sisters; ?>
                    </span>                  </div>

                  <div class="row margin-top-5px">
                    <span class="col-sm-5 col-xs-6 line-break">Family Origin</span>
                    <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->family_origin==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_origin;} ?>
                    </span>
                  </div> 
                </div>
                <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                   <div class="row margin-top-5px">	
                	 <span class="col-sm-5 col-xs-6 line-break">Family Type </span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php if($DatabaseCo->dbRow->family_type==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_type;} ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">	
                     <span class="col-sm-5 col-xs-6 line-break">Family Status</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					   <?php if($DatabaseCo->dbRow->family_status==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_status;} ?>
                      </span>
                    </div>
                    <div class="row margin-top-5px">	
                      <span class="col-sm-5 col-xs-6 line-break">Total Brothers </span>
                      <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php echo $DatabaseCo->dbRow->no_of_brothers; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Married Brothers</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					     <?php if($DatabaseCo->dbRow->no_marri_brother==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->no_marri_brother;} ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Married Sisiters</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					  <?php if($DatabaseCo->dbRow->no_marri_sister==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->no_marri_sister;} ?>
                       </span>
                    </div>
                </div>
            </div>
          </div>
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px"  id="hobby-details">
            <div class="panel-heading">
              <h3 class="panel-title col-sm-8 col-xs-7">Partner Preference&nbsp;&nbsp;&nbsp;
			     <?php if(isset($_GET['success-partner-details'])){?>
                    <span style="color:green;">
                      Profile Edited Successfully...
                    </span>
			     <?php } ?>
             </h3>
             <a data-toggle="modal" title="Partner Details" data-target="#myModal8" onclick="getPartDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-3 col-sm-4 pull-right text-right">
		        <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
             </a>
             <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
               <div class="col-xs-12">
                 <span class="col-sm-3 col-xs-6 line-break" style="padding-left:0;  width: 19.5%;">Expectations</span>
                 <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
			        <?php if($DatabaseCo->dbRow->part_expect==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_expect;} ?>
                 </span>
               </div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Looking for</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				        <?php echo $DatabaseCo->dbRow->looking_for; ?>
                     </span>
                  </div>
                  <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Age Preference</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				        <?php echo $DatabaseCo->dbRow->part_frm_age; ?>to
					    <?php echo $DatabaseCo->dbRow->part_to_age; ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Country Living in </span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php $d=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.matri_id = '$mid'  GROUP BY a.part_country_living"));
				echo $d['part_country'];?>
                      </span>
                   </div>
                   <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Resident Status</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				        <?php if($DatabaseCo->dbRow->part_resi_status==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_resi_status;} ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Education</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				       <?php $e=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.matri_id = '$mid'  GROUP BY a.edu_detail"));
				echo $e['edu_name']; ?>
                     </span>
                   </div>
                   <div class="row margin-top-5px">
                     <span class="col-sm-5 col-xs-6 line-break">Income</span>
                     <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
				        <?php echo $DatabaseCo->dbRow->part_income; ?>
                     </span>
                   </div>
                </div>
               <div class="col-sm-6 col-xs-12 padding-left-right-zero-small">
                    <div class="row margin-top-5px">	
                	   <span class="col-sm-5 col-xs-6 line-break">Height</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					       <?php echo $DatabaseCo->dbRow->part_height; ?> to
                           <?php echo $DatabaseCo->dbRow->part_height_to; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Complexion</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					       <?php echo $DatabaseCo->dbRow->part_complexation; ?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Religion</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					      <?php $f=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.matri_id = '$mid'  GROUP BY a.part_religion"));
				echo $f['part_religion'];?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Caste</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					      <?php $g=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_sect  FROM   register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0 where a.matri_id = '$mid'  GROUP BY a.part_caste"));
				echo $g['part_sect'];?>
                       </span>
                    </div>
                    <div class="row margin-top-5px">
                       <span class="col-sm-5 col-xs-6 line-break">Mother Tongue</span>
                       <span class="col-sm-6 col-xs-6 padding-left-right-zero-small line-break">
					    <?php $h=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS part_mtongue  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where a.matri_id = '$mid'  GROUP BY a.part_mtongue"));
				echo $h['part_mtongue'];?>
                       </span>
                    </div>
                 </div>
            </div>
          </div>
          
          <div class="panel main-area gradient-rev block-level" style="margin-top:20px" >
            <div class="panel-heading">
              <h3 class="panel-title col-xs-7 col-sm-8">Hobbies and Interests&nbsp;&nbsp;&nbsp;
			     <?php if(isset($_GET['success-hobby'])){?>
                   <span style="color:green;">
                         Profile Edited Successfully...
                   </span>
				 <?php } ?>
              </h3>
              <a data-toggle="modal" title="Hobby Details" data-target="#myModal9" onclick="getHobbyDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="col-xs-3 col-sm-4 pull-right text-right">
		        <button class="btn btn-success"  type="submit" style="padding: 0px 12px;">Edit</button>
              </a>
              <div class="clearfix"></div>
            </div>
            <div class="panel-body">             	
              <div class="col-xs-12">
                   <span class="col-sm-5 col-xs-8 line-break" style="padding-left:0;  width: 25%;">Hobbies & Interests </span>
                   <span class="col-sm-6 col-xs-4 padding-left-right-zero-small line-break">
				     <?php if($DatabaseCo->dbRow->hobby==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->hobby;} ?>            
                   </span>                   
              </div>
            
          </div>
          </div>
							
							
							
							
					</div>
			</div>
	</article>
			

<?php include "page-part/footer.php";?>

</div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">

	
	function getprofileDetail(sid)
	{
			
			$("#myModal1").show();
			$("#myModal1").html("Please wait...");
			$.get("./web-services/edit-profile/edit-profile-desc.php?sid="+sid,
			function(data){
				$("#myModal1").html(data);
			});
	}

	function getBasicDetail(sid)
	{
			$("#myModal2").html("Please wait...");
			$.get("./web-services/edit-profile/edit-basic-detail.php?sid="+sid,
			function(data){
				$("#myModal2").html(data);
			});
	}
	function getsocialDetail(sid)
	{
			$("#myModal3").html("Please wait...");
			$.get("./web-services/edit-profile/edit-social-detail.php?sid="+sid,
			function(data){
				$("#myModal3").html(data);
			});
	}
	function getEduDetail(sid)
	{
			$("#myModal4").html("Please wait...");
			$.get("./web-services/edit-profile/edit-edu-detail.php?sid="+sid,
			function(data){
				$("#myModal4").html(data);
			});
	}
	function getPhyDetail(sid)
	{
			$("#myModal5").html("Please wait...");
			$.get("./web-services/edit-profile/edit-physical-detail.php?sid="+sid,
			function(data){
				$("#myModal5").html(data);
			});
	}
	function getConDetail(sid)
	{
			$("#myModal6").html("Please wait...");
			$.get("./web-services/edit-profile/edit-contact-detail.php?sid="+sid,
			function(data){
				$("#myModal6").html(data);
			});
	}
	function getFamDetail(sid)
	{
			$("#myModal7").html("Please wait...");
			$.get("./web-services/edit-profile/edit-family-detail.php?sid="+sid,
			function(data){
				$("#myModal7").html(data);
			});
	}
	function getPartDetail(sid)
	{
			$("#myModal8").html("Please wait...");
			$.get("./web-services/edit-profile/edit-partner-detail.php?sid="+sid,
			function(data){
				$("#myModal8").html(data);
			});
	}
	function getHobbyDetail(sid)
	{
			$("#myModal9").html("Please wait...");
			$.get("./web-services/edit-profile/edit-hobby-detail.php?sid="+sid,
			function(data){
				$("#myModal9").html(data);
			});
	}
</script>
<div id="pop1" style="display:block;position:fixed;z-index:99999;top:20%;left:40%;"></div>

<div class="modal fade" id="myModal1"></div>
<div class="modal fade" id="myModal2"></div>
<div class="modal fade" id="myModal3"></div>
<div class="modal fade" id="myModal4"></div>
<div class="modal fade" id="myModal5"></div>
<div class="modal fade" id="myModal6"></div>
<div class="modal fade" id="myModal7"></div>
<div class="modal fade" id="myModal8"></div>
<div class="modal fade" id="myModal9"></div>

<?php include"function.php";?>