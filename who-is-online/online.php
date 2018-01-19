<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
require "functions.php";

// We don't want web bots scewing our stats:
if(is_bot()) die();

if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$ip = $_SERVER["REMOTE_ADDR"];
}

$indexid = $_SESSION['uid'];
$asset=mysql_fetch_array(mysql_query("SELECT * FROM register where index_id='$indexid'"));
$username=$asset['username'];
$temp_gender=$asset['gender'];

// Checking wheter the visitor is already marked as being online:
$inDB = mysql_query("SELECT * FROM online_users WHERE index_id=".$indexid);

if(mysql_num_rows($inDB)==0)
{
	
	mysql_query("INSERT INTO online_users (ip,username,gender,index_id)
					VALUES('".$ip."','".$username."','".$temp_gender."','".$indexid."')");
}
else
{
	// If the visitor is already online, just update the dt value of the row:
	mysql_query("UPDATE online_users SET dt=NOW() WHERE index_id=".$indexid);
}



	if($_SESSION['gender123'])
	{
			if($_SESSION['gender123']=='Male')
			{
			 $gender="and gender='Female'";
			}
			else
			{
			 $gender="and gender='Male'";	
			}		
	}
	

// Counting all the online visitors:
list($totalOnline) = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM online_users where index_id!='$indexid' $gender"));

// Outputting the number as plain text:
echo $totalOnline;

?>