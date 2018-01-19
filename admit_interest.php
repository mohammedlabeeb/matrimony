<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';

$DatabaseCo = new DatabaseConn();
 	$ExmatriId = isset($_GET['ExmatriId'])?$_GET['ExmatriId']:$_POST['ExmatriId'];
  	$Msg = isset($_GET['exp_interest'])?$_GET['exp_interest']:$_POST['exp_interest'];
 	$mid = $_SESSION['user_id'];

 $sql = "INSERT INTO expressinterest (ei_id,ei_sender,ei_receiver,receiver_response,ei_message,ei_sent_date,status) VALUES ('','$mid','$ExmatriId','Pending','$Msg',now(),'APPROVED')";
$result = mysql_query($sql);

echo "<script language=\"javascript\">alert('You have successfully expressed the interest.');window.location=\"../my-interest.php\";</script>";

?>
