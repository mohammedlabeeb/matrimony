<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();

$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();
$from = $configObj->getConfigFrom();
$subject="Matching Alert";
$sql="select * from register_view where status='Paid' order by rand() limit 0,50";
$r=mysql_query($sql);

while($ff=mysql_fetch_array($r))
{ 
	if ($ff['gender']=="Male")
	{	
	ob_start();	
	include ("crone_female.php");
	$message = ob_get_clean();		
	}
	else
	{
	ob_start();		
	include ("crone_male.php");
	$message = ob_get_clean();			
	}
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
		
		$to=$ff['email'];
		if(mysql_fetch_array($result45)>0)
		{
		mail($to,$subject, $message, $headers); 
		}
}
echo "Mail sent successfully...";