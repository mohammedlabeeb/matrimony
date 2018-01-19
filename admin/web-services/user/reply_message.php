<?php
session_start(); 
include_once '../../databaseConn.php';

$DatabaseCo = new DatabaseConn();
 $totheid = $_POST['matri_id'];
 $message = $_POST['message'];
 $subject = "Reply Of your Message";
 //$mid = $_SESSION['user_id'];

$sql = "INSERT INTO messages (to_id,from_id,subject,message,sent_date,status) VALUES ('$totheid','admin','$subject','$message',now(),'Unread')";
$result = mysql_query($sql) or die(mysql_error());
echo "Reply has been sent";