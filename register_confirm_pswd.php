<?php
ob_start();
error_reporting(0);
include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();

$email=$_GET['email'];

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
	

$up = mysql_query("update register set matri_id=concat(prefix,index_id),cpassword='$pswd' where email='$email'")or die("Could not update data because ".mysql_error());
	

$result3 = mysql_query("SELECT * FROM register,site_config where email = '$email'");
$rowcc = mysql_fetch_array($result3);

$name = $rowcc['firstname']." ".$rowcc['lastname'];
$matriid = $rowcc['matri_id'];
$cpass = $rowcc['cpassword'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];
$from = $rowcc['from_email'];

$to = $_GET['email'];

$result45 = mysql_query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Registration'");
$rowcs5 = mysql_fetch_array($result45);

$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("your site name" =>$webfriendlyname,"name"=>$name,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"site domain name"=>$website);

$email_template = strtr($email_template, $trans);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";


mail($to,$subject,$email_template,$headers);
ob_end_clean();
	 print "<script>";
	  print " self.location='register_confirm_pswd2.php?email=$email';"; 
	 print "</script>"; 
	
?>
