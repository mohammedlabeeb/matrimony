<?php
ob_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './class/Location.class.php';
include_once './class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();

if(isset($_POST['inbox_mes_id']))
		{
		  		$inbox_mes_id = $_POST['inbox_mes_id'];
			    $SQL_STATEMENT = "DELETE FROM messages WHERE mes_id=$inbox_mes_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
if(isset($_POST['sent_mes_id']))
		{
		  		$sent_mes_id = $_POST['sent_mes_id'];
			    $SQL_STATEMENT = "DELETE FROM messages WHERE mes_id=$sent_mes_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
		
		
if(isset($_POST['grating_id']))
		{
		  		$gra_id = $_POST['grating_id'];
			    $SQL_STATEMENT = "DELETE FROM gratings WHERE g_id=$gra_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
if(isset($_POST['del_photo_req']))
		{
		  		$del_photo = $_POST['del_photo_req'];
			    $SQL_STATEMENT = "DELETE FROM photoprotect_request WHERE ph_reqid=$del_photo";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
ob_flush();	
?>