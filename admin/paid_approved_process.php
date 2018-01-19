<?php
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  include("../BusinessLogic/class.payments.php");

$pmatri_id = $_POST['mid'];
$pname = $_POST['name'];
$pemail = $_POST['email'];
$paddress = $_POST['address'];
$paymode = $_POST['pmode'];
$pactive_dt = $_POST['activedt'];
$p_plan = $_POST['plan'];
$plan_duration = $_POST['duration'];
$profile = $_POST['profile'];
$chat = $_POST['chat'];
$video = $_POST['video'];
$p_no_contacts = $_POST['pcontact'];
$p_amount = $_POST['pamount'];
$p_bank_detail = $_POST['bankdet'];
$p_msg = $_POST['plan_free_msg'];

$delete=mysql_query("delete from payments where pmatri_id='$pmatri_id'");

$date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
$exp_date=date('Y-m-d', $date);
$ob=new payments();
$obb=$ob->add_payment($pmatri_id,$pname,$pemail,$paddress,$paymode,$pactive_dt,$p_plan,$plan_duration,$profile,$video,$chat,$p_no_contacts,$p_amount,$p_bank_detail,$p_msg,$exp_date);

?>
<?php

$mid = $_POST['mid'];

$update=mysql_query("Update register set status='Paid' where matri_id = '$mid' ")or die(mysql_error());

//mail sent to paid member
$result = mysql_query("SELECT * FROM register,site_config where matri_id = '$mid' ");
while($row = mysql_fetch_array($result))
	{
	
		$name  = $row['username']; 
		$to  = $row['email'];
		$matriid  = $row['matri_id'];
		$email  = $row['email'];
		$pass = $row['password'];
		$website = $row['web_name'];
		$webfriendlyname = $row['web_frienly_name'];
		$webtomail = $row['to_mail'];
		$webfrommail = $row['from_email'];
		
		$from =  $row['from_email']; 
		
$result45 = mysql_query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Paid Member'");
$rowcs5 = mysql_fetch_array($result45);

$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("webfriendlyname" =>$webfriendlyname,"name"=>$name,"matriid"=>$matriid,"email_id"=>$to);

$email_template = strtr($email_template, $trans);


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
	
	mail($to, $subject, $email_template, $headers);
}
header("location:member-list.php?success=paid");
?>
