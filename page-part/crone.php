<?php
     function RandomPassword() 
	 {
				$chars = "abcdefghijkmnopqrstuvwxyz023456789";
				srand((double)microtime()*1000000);
				$i = 0;
				$pass = '' ;
				
				while ($i <= 7) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
				}
	   return $pass;
	}
	
$pswd = RandomPassword();
$from = 'narjisenterprise@gmail.com';
$to = 'maysamali09@gmail.com';
$subject = "Your Confirm Password For Registration in to our website  ";	
$message = "
<html>
<head>
<title>You have just Logged In </title>
</head>
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
	<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>You have registered our $webfriendlyname site,Below is the login detail please confirm your email id by clicking the following link...
			</p>
		<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
		<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
		Dear, $name<br/>
		Matri-id : $matriid <br/>
		Email-ID : $email <br/>
		Confirmation Link : $website?confirm_id=$cpass&email=$to
		</b></p>
	<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>
    
    </td>
  </tr>
</tbody></table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers  = "From: $from\r\n"; 
mail($to,$subject,$message,$headers);	
?>
